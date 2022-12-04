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

$nameData=array();

//取得office名稱
$sql = "SELECT DISTINCT `oName`,`oId`s FROM `office` ORDER BY `oId`" ;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nameData['office'] = array_column($rows, 'oName', 'oId');

//取得prize名稱
$sql = "SELECT DISTINCT `pName`,`pId` FROM `prize`";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nameData['prize'] = array_column($rows, 'pName', 'pId');

//取得教師名稱
$sql = "SELECT DISTINCT `wName`,`wAccount` FROM `worker`";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$nameData['woker'] = array_column($rows, 'wName', 'wAccount');

echo json_encode($nameData,JSON_UNESCAPED_UNICODE);

die();
exit();//停止php
