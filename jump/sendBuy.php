<?php
session_start();

if(isset($_SESSION['login_id']) && isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $stu_id = $_SESSION['login_id'];
}else{
    header('Location: login.php');
}

//取得商品ID
if(!isset($_GET['id'])){
    header('Location: index.php');
}
$com_id = $_GET['id'];

//連線資料庫
try{
    $pdo = new PDO('mysql:host=localhost:3307;dbname=graduation_project',"root","466110");
    //echo "成功連線";
}catch (PDOException $e){
    echo $e->getMessage();
}

//取得商品資訊
try{
    $sql = "SELECT * FROM `commodity` WHERE `com_id`={$com_id};";
    $commodity_array = $pdo->query($sql);
    $commodity = $commodity_array->fetch();
}catch (PDOException $e){
    echo $e->getMessage();
}

//檢查商品是否有庫存
if($commodity['com_num']<=0){
    header("Location:index.php");
}

//取得學生資訊
try{
    $sql = "SELECT * FROM `student` WHERE `stu_id`='{$stu_id}';";
    $student_array = $pdo->query($sql);
    $student = $student_array->fetch();
}catch (PDOException $e){
    echo $e->getMessage();
}
//檢查學生是否有足夠的點數
if($student['point']<$commodity['price']){
    header("Location:com_info.php?id={$com_id}&msg=沒有足夠的點數");
}

try{//產生待確認表單
    $sql = "INSERT INTO `confirm`(`com_id`, `stu_id`, `buyNum`) VALUES ({$com_id}, '{$stu_id}', 1);";
    $pdo->query($sql);
    //資料庫商品數量減一
    $newNum = $commodity['com_num']-1;
    $sql = "UPDATE `commodity` SET `com_num`={$newNum} WHERE `com_id`={$com_id} ;";
    $pdo->query($sql);
    //學生點數
    $newPoint = $student['point']-$commodity['price'];
    $sql = "UPDATE `student` SET `point`={$newPoint} WHERE `stu_id`='{$stu_id}' ;";
    $pdo->query($sql);
}catch (PDOException $e){
    echo $e->getMessage();
}
//關閉連接
$pdo = null;

//var_dump($student);
header("Location:prize_info.php?id={$com_id}");
?>