<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $id = $_SESSION['login_id'];
}else{
    header('Location: ../login.php?msg=請再次登入');
}

//取得商品ID
if(!isset($_GET['pId'])){
    header('Location: ../index.php');
}
$pId = $_GET['pId'];
$amount = $_POST['amount'];

//連線資料庫
try{
    require_once('../connectDB.php');
    $pdo = connectDB();
    $sId = $_SESSION['login_id'];
}catch (PDOException $e){
    echo $e->getMessage();
}

//取得商品資訊
try{
    $sql = "SELECT * FROM `prize` WHERE `pId`={$pId};";
    $commodity_array = $pdo->query($sql);
    $commodity = $commodity_array->fetch();
}catch (PDOException $e){
    echo $e->getMessage();
}

//檢查商品是否有庫存
if($commodity['stock']<=0){
    echo "沒有庫存";
    // header("Location:../index.php");
}

//取得學生資訊
try{
    $sql = "SELECT * FROM `student` WHERE `sId`='{$sId}';";
    $student_array = $pdo->query($sql);
    $student = $student_array->fetch();
}catch (PDOException $e){
    echo $e->getMessage();
}
//檢查學生是否有足夠的點數
if($student['point']<$commodity['price']){
    header("Location:../prize_info.php?id={$pId}&msg=沒有足夠的點數");
}
$cost=$commodity['price']*$amount;//價格*購買數量
$transactionTime = date("Y-m-d H:i:s");
//查流水號
$prizelogid = $pdo->query('select count(*) from prizelogs')->fetchColumn(); 
try{//新增prizelogs
    $stmt = $pdo->prepare("INSERT INTO `prizelogs`(`id`, `pId`, `sId`, `amount`, `price`, `point`, `oId`, `transactionTime`) VALUES (:id, :pId, :sId, :amount, :price, :point, :oId, :transactionTime)");
        $stmt->bindParam(':id', $prizelogid, PDO::PARAM_INT);
        $stmt->bindParam(':pId', $pId, PDO::PARAM_INT);
        $stmt->bindParam(':sId', $sId, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindParam(':price', $commodity['price'], PDO::PARAM_INT);
        $stmt->bindParam(':point', $cost, PDO::PARAM_INT);
        $stmt->bindParam(':oId', $commodity['oId'], PDO::PARAM_INT);
        $stmt->bindParam(':transactionTime', $transactionTime, PDO::PARAM_STR);

        $stmt->execute();
    //新增student_prize
    //先查詢學生是否已經有此商品
    $query=$pdo->prepare("SELECT * FROM student_prize WHERE (sId = :sId AND pId = :pId)");
    $query->execute(array(
        ':sId'         => "$sId",
        ':pId'          => "$pId",
        )
    );
    $student_prize_id = $pdo->query('select count(*) from student_prize')->fetchColumn(); 
    $count = $query->rowCount();
    if($count == 0){//insert student_prize
        $stmt = $pdo->prepare("INSERT INTO `student_prize`(`id`, `sId`, `pId`, `amount`, `updateTime`, `oId`) VALUES (:id, :sId, :pId, :amount, :updateTime, :oId)");
        $stmt->bindParam(':id', $student_prize_id, PDO::PARAM_INT);
        $stmt->bindParam(':pId', $pId, PDO::PARAM_INT);
        $stmt->bindParam(':sId', $sId, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindParam(':oId', $commodity['oId'], PDO::PARAM_INT);
        $stmt->bindParam(':updateTime', $transactionTime, PDO::PARAM_STR);
        $stmt->execute();
    }else{          //update student_prize
        //查出學生現有商品數，加上這次新買的數量
        $query=$pdo->prepare("SELECT * FROM student_prize WHERE (sId = :sId AND pId = :pId)");
        $query->execute(array(
            ':sId'         => "$sId",
            ':pId'          => "$pId",
        ));
        $student_prize = $query->fetch();
        $newAmount=$student_prize['amount']+$amount;
        //update student_prize
        $query=$pdo->prepare("UPDATE `student_prize` SET `amount`={$newAmount} WHERE (sId = :sId AND pId = :pId)");
        $query->execute(array(
        ':sId'         => "$sId",
        ':pId'          => "$pId",
        )
    );
    }

    //資料庫商品數量減少
    $newNum = $commodity['stock']-$amount;
    $sql = "UPDATE `prize` SET `stock`={$newNum} WHERE `pId`={$pId} ;";
    $pdo->query($sql);
    //學生點數
    $cost=$commodity['price']*$amount;
    $newPoint = $student['point']-$cost;
    $sql = "UPDATE `student` SET `point`={$newPoint} WHERE `sId`='{$sId}' ;";
    $pdo->query($sql);
    echo '<script type ="text/JavaScript">';
        echo 'alert("購買成功，將回到首頁。"); window.location.href = "../index.php";';
        echo '</script>';
}catch (PDOException $e){
    echo $e->getMessage();
}
//關閉連接
$pdo = null;

//var_dump($student);
// header("Location:../prize_info.php?id={$pId}");
?>