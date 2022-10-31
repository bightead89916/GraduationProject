<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    header('Location: index.php');
}

$username = $_POST['username'];
$password = $_POST['password'];

$pdo = null;
//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();

//取得帳號密碼
try{
    $sql = "SELECT * FROM `student` WHERE `sId`='{$username}';";
    $user_array = $pdo->query($sql);
}catch (PDOException $e){
    echo $e->getMessage();
}
$user = $user_array->fetch();

if(!empty($user) && $user['sPassword'] == $password){
    //登入成功
    $_SESSION['is_login'] = TRUE;
    $_SESSION['login_id'] = $user['sId'];
    
    header('Location: ../index.php');
}else{
    try{
        $sql = "SELECT * FROM `worker` WHERE `wAccount`='{$username}';";
        $user_array = $pdo->query($sql);
    }catch (PDOException $e){
        echo $e->getMessage();
    }
    $user = $user_array->fetch();
    if(!empty($user) && $user['wPassword'] == $password){
        //登入成功
        $_SESSION['is_login'] = TRUE;
        $_SESSION['is_office'] = TRUE;
        $_SESSION['login_id'] = $user['wAccount'];
        header('Location: ../index.php');
    }else{
    //登入失敗
    header('Location: ../login.php?msg=帳號或密碼錯誤');
    }
}

//關閉連接
$pdo = null;

?>