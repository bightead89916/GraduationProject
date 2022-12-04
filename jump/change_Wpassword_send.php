<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $id = $_SESSION['login_id'];
}else{
    header('Location: ../login.php?msg=請再次登入');
}

//取得輸入的資訊
$wAccount = $_POST['wAccount'];
$password = $_POST['password'];
$newpassword1 = $_POST['newpassword1'];
$newpassword2 = $_POST['newpassword2'];


//連線資料庫
try{
    require_once('../connectDB.php');
    $pdo = connectDB();
}catch (PDOException $e){
    echo $e->getMessage();
}

//搜尋舊密碼
    $search_sPassword = $pdo->prepare("SELECT `wPassword` FROM `worker` WHERE `wAccount`='{$wAccount}';");
    $search_sPassword->execute();
    $sPasswordfetch = $search_sPassword->fetch(PDO::FETCH_ASSOC);
    $oldpassword = $sPasswordfetch['wPassword'];

try{//更新密碼
    if($oldpassword==$password){
        if($newpassword1==$newpassword2){
                $sql = "UPDATE `worker` SET `wPassword`={$newpassword1} WHERE `wAccount`='{$wAccount}' ;";
                $pdo->query($sql);
                echo '<script type ="text/JavaScript">';
                echo 'alert("更新密碼成功，將回到首頁。"); window.location.href = "../jump/logout.php";';
                echo '</script>';
        }else{//新密碼兩次輸入不一樣
        echo '<script type ="text/JavaScript">';
        echo 'alert("新密碼兩次輸入不一樣!。");window.history.back(-1);';//回到上一頁
        echo '</script>';
        }
    }else{//舊密碼輸入錯誤
        echo '<script type ="text/JavaScript">';
        echo 'alert("舊密碼輸入錯誤!。");window.history.back(-1);';//回到上一頁
        echo '</script>';
    }
}catch (PDOException $e){
    echo $e->getMessage();
}
//確認密碼是否跟之前一樣
//修改密碼
// try{
//     $sql = "UPDATE `student` SET `sPassword`={$newpassword1} WHERE `sId`='{$sId}' ;";
//     $pdo->query($sql);
//     echo '<script type ="text/JavaScript">';
//         echo 'alert("更新密碼成功，將回到首頁。"); window.location.href = "../index.php";';
//         echo '</script>';
// }catch (PDOException $e){
//     echo $e->getMessage();
// }
//關閉連接
$pdo = null;
?>