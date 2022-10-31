<?php
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
    echo "<button><a href='insertCom.php' style='text-decoration:none;color:red;'>返回</a></button>";
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
    //連線資料庫
    try{
        $pdo = new PDO('mysql:host=localhost:3307;dbname=graduation_project',"root","466110");
        echo "成功連線";
    }catch (PDOException $e){
        unlink($target_file);
        echo '<script type ="text/JavaScript">';
        echo 'alert($e->getMessage());';
        echo 'alert("資料庫連線發生錯誤，將回到商品上架頁面。"); location.href = "insertCom.php";';
        echo '</script>';
    }
    //傳送要求
    try{
        echo "開始傳送...";
        $stmt = $pdo->prepare("INSERT INTO `commodity`(`picture`, `com_name`, `introdu`, `com_num`, `price`) VALUES (:picture, :com_name, :introdu, :com_num, :price)");
        $stmt->bindParam(':picture', $target_file, PDO::PARAM_STR);
        $stmt->bindParam(':com_name', $comName, PDO::PARAM_STR);
        $stmt->bindParam(':introdu', $comText, PDO::PARAM_STR);
        $stmt->bindParam(':com_num', $comNum, PDO::PARAM_INT);
        $stmt->bindParam(':price', $comPrice, PDO::PARAM_INT);

        $stmt->execute();
        echo "傳送完畢";

        echo '<script type ="text/JavaScript">';
        echo 'alert("新增成功，將回到商品上架頁面。"); window.location.href = "insertCom.php";';
        echo '</script>';
    }catch (PDOException $e){
        unlink($target_file);
        $messege = $e->getMessage();
        echo '<script type ="text/JavaScript">';
        echo "alert('{$messege}');";
        echo 'alert("要求傳送發生錯誤，將回到商品上架頁面。"); window.location.href = "insertCom.php";';
        echo '</script>';
    }
    $pdo = null;
}

?>