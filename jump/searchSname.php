<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $id = $_SESSION['login_id'];
}else{
    header('Location: ../login.php?msg=請再次登入');
}

$pdo = null;
//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();
//搜sName並回傳
$sId = $_POST['sId'];
$search_sName = $pdo->prepare("SELECT `sName` FROM `student` WHERE `sId` = '$sId'");
$search_sName->execute();
$sName = $search_sName->fetch(PDO::FETCH_ASSOC);
echo json_encode($sName,JSON_UNESCAPED_UNICODE);
        
die();
exit();//停止php
?>
