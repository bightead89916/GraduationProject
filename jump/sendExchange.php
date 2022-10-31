<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $id = $_SESSION['login_id'];
}else{
    header('Location: login.php?msg=請再次登入');
}

$selectRp = $_POST['rp'];
$selectNum = $_POST['num'];

if($selectRp==0){
    header('Location: exchange_point.php?msg=請選擇要兌換的獎懲種類');
}

//連線資料庫
try{
    $pdo = new PDO('mysql:host=localhost:3307;dbname=graduation_project',"root","466110");
    //echo "成功連線";
}catch (PDOException $e){
    echo $e->getMessage();
}

//查詢舊資料
try{
    $sql = "SELECT * FROM `student` WHERE `stu_id`='{$id}';";
    $user_array = $pdo->query($sql);
    $sql = "SELECT * FROM `rp` WHERE `stu_id`='{$id}';";
    $rp_array = $pdo->query($sql);

    $user = $user_array->fetch();
    $rp = $rp_array->fetch();
}catch (PDOException $e){
    echo $e->getMessage();
}

switch($selectRp){
    case "1000":
        $newPoint = $user['point'] + $selectNum * 1000;
        $selectRp = "com";
        break;
    case "3000":
        $newPoint = $user['point'] + $selectNum * 3000;
        $selectRp = "mime";
        break;
    case "9000":
        $newPoint = $user['point'] + $selectNum * 9000;
        $selectRp = "mame";
        break;
}
if($rp[$selectRp] >= $selectNum){
    //更新資料
    $newRp = $rp[$selectRp] - $selectNum;
    try{
        $sql = "UPDATE `rp` SET `{$selectRp}`= {$newRp} WHERE `stu_id`='{$id}';";
        $pdo->query($sql);
        $sql = "UPDATE `student` SET `point`= {$newPoint} WHERE `stu_id`='{$id}';";
        $pdo->query($sql);
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}else{
    header('Location: exchange_point.php?msg=請選擇正確的數量');
}

//關閉連接
$pdo = null;

header('Location: exchange_point.php');
?>