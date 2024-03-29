<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true && $_SESSION['is_office'] == true){
    $wAccount = $_SESSION['login_id'];
}else{
    $_SESSION['is_login'] = false;
    header('Location: ../login.php?msg=請再次登入');
}

$id = $_GET['id'];
$pId = $_GET['pId'];
$sId = $_GET['sId'];
$amount = $_GET['amount'];


//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();
//查oId
$search_sName = $pdo->prepare("SELECT `oId` FROM `prize` WHERE `pId` = '$pId'");
$search_sName->execute();
$sNamefetch = $search_sName->fetch(PDO::FETCH_ASSOC);
$oId = $sNamefetch['oId'];
//查當前時間
$transactionTime = date("Y-m-d H:i:s");
//流水號id
$sql = "SELECT COUNT(id) FROM `uselogs`;";
$res = $pdo->query($sql);
$id = $res->fetchColumn();
// echo "pId=";
// echo $pId;
// echo "sId=";
// echo $sId;
// echo "amount=";
// echo $amount;
// echo "id=";
// echo $id;
// echo "transactionTime=";
// echo $transactionTime;
// echo "oId=";
// echo $oId;

    //查學生持有的獎品數量
    $query=$pdo->prepare("SELECT * FROM student_prize WHERE (sId = :sId AND pId = :pId)");
        $query->execute(array(
            ':sId'         => "$sId",
            ':pId'          => "$pId",
        ));
        $student_prize = $query->fetch();
    $newAmount=$student_prize['amount']-$amount;
    if($newAmount<0){
        exit('學生沒有足夠的獎品!');
    }
//新增uselogs
try{
    $stmt = $pdo->prepare("INSERT INTO `uselogs`(`id`, `transactionTime`, `pId`, `sId`, `amount`, `oId`) VALUES (:id, :transactionTime, :pId, :sId, :amount, :oId)");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':transactionTime', $transactionTime, PDO::PARAM_STR);
        $stmt->bindParam(':pId', $pId, PDO::PARAM_INT);
        $stmt->bindParam(':sId', $sId, PDO::PARAM_STR);
        $stmt->bindParam(':oId', $oId, PDO::PARAM_INT);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);

        $stmt->execute();
        echo "傳送完畢";

        // echo '<script type ="text/JavaScript">';
        //echo 'alert("使用成功，將回到首頁。"); window.location.href = "../index.php";';
        // echo '</script>';
}catch (PDOException $e){
    $messege = $e->getMessage();
    $pdo = null;
    echo "alert('{$messege}');";
    echo '<script type ="text/JavaScript">';
    echo '</script>';
}

//減少student_prize
try{

    $query=$pdo->prepare("UPDATE `student_prize` SET `amount`={$newAmount} WHERE (sId = :sId AND pId = :pId)");
    $query->execute(array(
    ':sId'         => "$sId",
    ':pId'          => "$pId",
    )
    );
        echo "更新完畢";

        // echo '<script type ="text/JavaScript">';
        // echo 'alert("更新成功，將回到首頁。"); window.location.href = "../index.php";';
        // echo '</script>';
}catch (PDOException $e){
    $messege = $e->getMessage();
    $pdo = null;
    echo "alert('{$messege}');";
    echo '<script type ="text/JavaScript">';
    echo '</script>';
}
//顯示成功訊息
$pdo = null;
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type ="text/JavaScript">
Swal.fire(
    '成功使用!',
    '已上傳使用紀錄',
     'success'
).then(function(){
    window.location.href = "../index.php";
});

</script>