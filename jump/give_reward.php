<?php
session_start();

if(isset($_SESSION['login_id']) && isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $wAccount = $_SESSION['login_id'];
}else{
    header('Location: ../login.php?msg=請再次登入');
}

//登入資料庫
require_once('../connectDB.php');
$pdo = connectDB();
//取得輸入的表單資料
$sId = $_POST['sId'];
$reasonSelect = $_POST['reasonSelect'];
$reason = $_POST['reason'];
$rewardType = $_POST['rewardType'];
$amount = $_POST['amount'];
$wAccount = $_SESSION['login_id'];
$updateTime = date("Y-m-d H:i:s");

// echo "alert('{$wAccount}');";

//判斷是嘉獎還是小功還是大功...給數值，然後把其他的數值設為0
//1~6依序是嘉獎~大過
switch ($rewardType) {
    case "Commendation":
        $amount1 = $amount;
        $amount2 = 0;
        $amount3 = 0;
        $amount4 = 0;
        $amount5 = 0;
        $amount6 = 0;
        break;
    case "MinorMerit":
        $amount1 = 0;
        $amount2 = $amount;
        $amount3 = 0;
        $amount4 = 0;
        $amount5 = 0;
        $amount6 = 0;
        break;
    case "MajorMerit":
        $amount1 = 0;
        $amount2 = 0;
        $amount3 = $amount;
        $amount4 = 0;
        $amount5 = 0;
        $amount6 = 0;
        break;
    case "Admonition":
        $amount1 = 0;
        $amount2 = 0;
        $amount3 = 0;
        $amount4 = $amount;
        $amount5 = 0;
        $amount6 = 0;
        break;
    case "MinorDemerit":
        $amount1 = 0;
        $amount2 = 0;
        $amount3 = 0;
        $amount4 = 0;
        $amount5 = $amount;
        $amount6 = 0;
        break;
    case "MajorDemerit":
        $amount1 = 0;
        $amount2 = 0;
        $amount3 = 0;
        $amount4 = 0;
        $amount5 = 0;
        $amount6 = $amount;
        break;    
}
//計算應該得到的point
if($amount1!=0){
    $point=$amount*1000;
}else if($amount2!=0){
    $point=$amount*3000;
}else if($amount3!=0){
    $point=$amount*9000;
}else{
    $point=0;
}
//查詢學生現有的point，並加上這次新增的point，後面做update
$sql = "SELECT `point` FROM `student`= $sId;";
$res = $pdo->query($sql);
$sPoint = $res->fetchColumn();
$point = $sPoint+$point;

//搜尋rId
$sql = "SELECT COUNT(rId) FROM `rewardslogs`;";
$res = $pdo->query($sql);
$rId = $res->fetchColumn();
//新增到rewardlogs
try{
    $stmt = $pdo->prepare("INSERT INTO `rewardslogs`(`rId`, `sId`, `Commendation`, `MinorMerit`, `MajorMerit`, `Admonition`, `MinorDemerit`, `MajorDemerit`, `updateTime`, `wAccount`, `reason`) VALUES (:rId, :sId, :amount1, :amount2, :amount3, :amount4, :amount5, :amount6, :updateTime, :wAccount, :reason)");
    $stmt->bindParam(':rId', $rId, PDO::PARAM_INT);
    $stmt->bindParam(':sId', $sId, PDO::PARAM_STR);
    $stmt->bindParam(':amount1', $amount1, PDO::PARAM_INT);//1~6分別對應嘉獎~大過
    $stmt->bindParam(':amount2', $amount2, PDO::PARAM_INT);
    $stmt->bindParam(':amount3', $amount3, PDO::PARAM_INT);
    $stmt->bindParam(':amount4', $amount4, PDO::PARAM_INT);
    $stmt->bindParam(':amount5', $amount5, PDO::PARAM_INT);
    $stmt->bindParam(':amount6', $amount6, PDO::PARAM_INT);
    $stmt->bindParam(':updateTime', $updateTime, PDO::PARAM_STR);
    $stmt->bindParam(':wAccount', $wAccount, PDO::PARAM_STR);
    $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);

    $stmt->execute();

    $updatePointSql = "UPDATE student SET point=? WHERE sId=?";
    $stmtUpdate= $pdo->prepare($updatePointSql);
    $stmtUpdate->execute([$point, $sId]);
    echo "傳送完畢";

}catch (PDOException $e){
        $messege = $e->getMessage();
        $pdo = null;
        echo "alert('{$messege}');";
    }
//關閉連接
$pdo = null;
?>
<a href="successAnimation.php" class="btn btn-primary">確定送出</a>