<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../jquery.qrcode.min.js"></script>
<?php
session_start();
$sId = $_SESSION['login_id'];
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
    $msg = null;
}

//取得商品ID
if(!isset($_GET['id'])){
    header('Location: ../index.php');
}
$sName = $_GET['sName'];
$id = $_GET['id'];
$pId = $_GET['pId'];
$pName = $_GET['pName'];

//session檢查有沒有人改網址，若被改就跳回首頁
if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true){
    if($sId!=$_SESSION['login_id']){
        header('Location: ../index.php?msg=請別改網址!');
    }
}else{
    header('Location: ../login.php?msg=請再次登入');
}

$pdo = null;
//jquery產生QRcode

//連線資料庫
// require_once('../connectDB.php');
// $pdo = connectDB();

// try{//取得商品資訊
//     $sql = "SELECT * FROM `prize` WHERE `pId`={$id};";
//     $commodity_array = $pdo->query($sql);
//     $commodity = $commodity_array->fetch();
//     //取得商品售出數量
//     $sql = "SELECT * FROM `prizelogs` WHERE `pId`={$id};";
//     $resume = $pdo->query($sql);
//     $count = $resume->rowCount();
//     if($count == ""){
//         $count = 0;
//     }
// }catch (PDOException $e){
//     echo $e->getMessage();
// }

//關閉連接
$pdo = null;
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>qrcode</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../jquery-qrcode-0.17.0.min.js"></script>
    <style>
        .center>div {
            display: flex;
            /* 水平置中 */
            justify-content: center;    
            /* 垂直置中 */
            align-content: center;      
            flex-wrap: wrap;
        }
    </style>
</head>

<body>

    <div class="center">
    <div class="font">
        <?php
        echo $sId;
        echo "，";
        echo $sName;
        echo "，";
        echo $pName;
        ?>
    </div>
        <div id="jquery-qrcode-div"></div>
    </div>

    <script>
        $("#jquery-qrcode-div").qrcode({
            render: 'div',
            size: 250,
            text: 'http://localhost/GraduationProject/jump/usePrize.php?id=<?php echo $id?>&pId=<?php echo $pId?>&sId=<?php echo $sId?>"'
        });
    </script>
</body>

</html>