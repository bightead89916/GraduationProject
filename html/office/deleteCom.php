<?php
$id = $_GET['id'];

//連線資料庫
try{
    $pdo = new PDO('mysql:host=localhost:3307;dbname=graduation_project',"root","466110");
    //echo "成功連線";
}catch (PDOException $e){
    echo $e->getMessage();
}
//取得商品資訊
try{
    $stmt = $pdo->prepare("SELECT * FROM `commodity` WHERE `com_id` = :id");
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $commodity = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch (PDOException $e){
    echo $e->getMessage();
}
//確認商品數量
$com_num = $commodity[0]['com_num'] - 1;
if($commodity[0]['com_num'] > 0){
    //echo "有庫存";
    try{
        $stmt = $pdo->prepare("UPDATE `commodity` SET `com_num`=:newCom_num  WHERE `com_id` = :id");
        $stmt->bindParam(":newCom_num",$com_num,PDO::PARAM_INT);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}
if ($com_num <= 0){
    //沒有庫存就刪除商品
    try{
        unlink($commodity[0]['picture']);
        $stmt = $pdo->prepare("DELETE FROM `commodity` WHERE `com_id` = :id");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}
$pdo = null;
echo '<script type ="text/JavaScript">';
echo 'alert("兌換成功，將回到商品頁面。"); window.location.href = "index.php";';
echo '</script>';
?>