<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $sId = $_SESSION['login_id'];
}else{
    header('Location: ../login.php?msg=請再次登入');
}

$pdo = null;
//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();

//if篩選回傳
if(isset($_POST["act"]) && $_POST["act"]=="postsomething") {
    $option = $_POST["option"];

    $sql = "SELECT `blockHeight`,`uploadTime` FROM `blockchainlogs` WHERE `type` = {$option} ORDER BY `uploadTime` DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $output[0] = $data['blockHeight'];
    $output[1] = $data['uploadTime'];
        
    echo json_encode($output,JSON_UNESCAPED_UNICODE);
}

die();
exit();//停止php
