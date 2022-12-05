<?php
session_start();

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == true && $_SESSION['is_office'] == true) {
    $wAccount = $_SESSION['login_id'];
} else {
    $_SESSION['is_login'] = false;
    header('Location: ../login.php?msg=請再次登入');
}
$pId = $_GET['pId'];
//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();

//減少庫存至0
try {
    $query = $pdo->prepare("UPDATE `prize` SET `stock`=0 WHERE `pId` = '$pId'");
    $query->execute();
    echo "更新完畢";
    echo '<script type ="text/JavaScript">';
    echo 'window.location.href = "../office/office_info.php";';
    echo '</script>';
} catch (PDOException $e) {
    $messege = $e->getMessage();
    $pdo = null;
    echo "alert('{$messege}');";
    echo '<script type ="text/JavaScript">';
    echo '</script>';
}

$pdo = null;
