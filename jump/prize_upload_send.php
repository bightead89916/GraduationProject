<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $id = $_SESSION['login_id'];
}else{
    header('Location: ../login.php?msg=請再次登入');
}
//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();
$sId = $_SESSION['login_id'];
//將圖片存入本機硬碟---------------------------------------------------------
$target_dir = "uploads/";
$target_file = $target_dir . time() . "." . basename($_FILES["picture"]["type"]);
$uploadOk = 1;
$imageFileType = basename($_FILES["picture"]["type"]);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["picture"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    echo "<button><a href='prize_upload.php' style='text-decoration:none;color:red;'>返回</a></button>";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    //取得變數
    $comName = $_POST['comName'];
    $comText = $_POST['comText'];
    $comNum = $_POST['comNum'];
    $comPrice = $_POST['comPrice'];
    $expiryDate = $_POST['expiryDate'];
    $wAccount = $_SESSION['login_id'];
    //轉換日期時間成ymd格式
    $middle = strtotime($expiryDate); // returns bool(false)
    $expiryDate = date('Y-m-d H:i:s', $middle);

    //取得Worker資料
    try{
        $sql = "SELECT * FROM `worker` WHERE `wAccount`='{$wAccount}';";
        $user_array = $pdo->query($sql);
        $user = $user_array->fetch();
        $oId = $user['oId'];
    }catch (PDOException $e){
        unlink($target_file);
        $messege = $e->getMessage();
        
        echo '<script type ="text/JavaScript">';
        echo "alert('{$messege}');";
        echo 'alert("資料庫連線發生錯誤，將回到商品上架頁面。"); window.location.href = "../office/prize_upload.php";';
    }
//搜尋pId
$sql = "SELECT COUNT(pId) FROM `prize`;";
$res = $pdo->query($sql);
$pId = $res->fetchColumn();
    //傳送要求
    try{
        echo "開始傳送...";
        $stmt = $pdo->prepare("INSERT INTO `prize`(`pId`, `pictureAddress`, `pName`, `content`, `stock`, `price`, `oId`, `wAccount`, `expiryDate`) VALUES (:pId, :picture, :com_name, :introdu, :com_num, :price, :oId, :wAccount, :expiryDate)");
        $stmt->bindParam(':picture', $target_file, PDO::PARAM_STR);
        $stmt->bindParam(':com_name', $comName, PDO::PARAM_STR);
        $stmt->bindParam(':introdu', $comText, PDO::PARAM_STR);
        $stmt->bindParam(':wAccount', $wAccount, PDO::PARAM_STR);
        $stmt->bindParam(':pId', $pId, PDO::PARAM_INT);
        $stmt->bindParam(':com_num', $comNum, PDO::PARAM_INT);
        $stmt->bindParam(':price', $comPrice, PDO::PARAM_INT);
        $stmt->bindParam(':oId', $oId, PDO::PARAM_INT);
        $stmt->bindParam(':expiryDate', $expiryDate, PDO::PARAM_STR);

        $stmt->execute();
        
        echo "傳送完畢";

        echo '<script type ="text/JavaScript">';
        echo 'alert("新增成功，將回到商品上架頁面。"); window.location.href = "../office/prize_upload.php";';
        echo '</script>';
    }catch (PDOException $e){
        unlink($target_file);
        $messege = $e->getMessage();
        
        // echo '<script type ="text/JavaScript">';
        echo "alert('{$messege}');";
        // echo 'alert("要求傳送發生錯誤，將回到商品上架頁面。"); window.location.href = "prize_upload.php";';
        // echo '</script>';
    }
    $pdo=null;
}

?>