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
$wAccount = $_SESSION['login_id'];

//if篩選回傳
if(isset($_POST["act"]) && $_POST["act"]=="postsomething") {
    $sql = "SELECT COUNT(id) FROM `blockchainlogs`;";
    $res = $pdo->query($sql);
    $id = $res->fetchColumn();

    $time = $_POST['time'];
    $blockId = $_POST['blockNum'];
    $option = $_POST['option'];

    $stmt = $pdo->prepare("INSERT INTO `blockchainlogs`(`id`, `type`, `uploadTime`, `blockHeight`) VALUES (:id, :typeOption, :uploadTime, :blockHeight)");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':typeOption', $option, PDO::PARAM_INT);
    $stmt->bindParam(':uploadTime', $time, PDO::PARAM_STR);
    $stmt->bindParam(':blockHeight', $blockId, PDO::PARAM_INT);

    $stmt->execute();
    $pdo = null;
    echo "傳送完畢";
}

die();
exit();//停止php
?>