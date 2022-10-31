<?php
include("../connect.php");
$sId='B10856056';
//if篩選回傳
if(isset($_POST["act"]) && $_POST["act"]=="postsomething") {
    $option = $_POST["option"];
    if($option==1){ //1=獎品兌換紀錄
        $sql = "SELECT * FROM `prizelogs` WHERE `sId` = '$sId'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $userData=array(); 
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $oId = $row['oId']; //查出oName
            $search_oName = $pdo->prepare("SELECT `oName` FROM `office` WHERE `oId` = '$oId'");
            $search_oName->execute();
            $oName = $search_oName->fetch(PDO::FETCH_ASSOC);
            
            $userData[]=array(
            'pId'=>$row['pId'],
            'sId'=>$row['sId'],
            'amount'=>$row['amount'],
            'price'=>$row['price'],
            'pName'=>$row['pName'],
            'oName'=>$oName['oName'],
            'point'=>$row['point'],
            'transactionTime'=>$row['transactionTime']
            );
        }
        echo json_encode($userData,JSON_UNESCAPED_UNICODE);
        //在這取出所有需要的值，放入陣列，編輯成json檔，回傳json檔
    }
    else if($option==2){//2=獎品使用紀錄
        $sql = "SELECT * FROM `uselogs` WHERE `sId` = '$sId'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $userData=array(); 

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $pId = $row['pId']; //查出pName
            $search_pName = $pdo->prepare("SELECT `pName` FROM `prize` WHERE `pId` = '$pId'");
            $search_pName->execute();
            $pName = $search_pName->fetch(PDO::FETCH_ASSOC);

            $oId = $row['oId']; //查出oName
            $search_oName = $pdo->prepare("SELECT `oName` FROM `office` WHERE `oId` = '$oId'");
            $search_oName->execute();
            $oName = $search_oName->fetch(PDO::FETCH_ASSOC);
            
            $userData[]=array(
            'sId'=>$row['sId'],
            'amount'=>$row['amount'],
            'pName'=>$pName['pName'],
            'oName'=>$oName['oName'],
            'transactionTime'=>$row['transactionTime']
            );
        }
        echo json_encode($userData,JSON_UNESCAPED_UNICODE);
    }
    else if($option==3){//3=獎懲紀錄
        $sql = "SELECT * FROM `rewardslogs` WHERE `sId` = '$sId'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $userData=array(); 
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $userData[]=array(
            'Commendation'=>$row['Commendation'],
            'MinorMerit'=>$row['MinorMerit'],
            'MajorMerit'=>$row['MajorMerit'],
            'Admonition'=>$row['Admonition'],
            'MinorDemerit'=>$row['MinorDemerit'],
            'MajorDemerit'=>$row['MajorDemerit'],
            'point'=>$row['point'],
            'updateTime'=>$row['updateTime'],
            'reason'=>$row['reason']
            );
        }
        echo json_encode($userData,JSON_UNESCAPED_UNICODE);
    }
}

die();
exit();//停止php
?>
