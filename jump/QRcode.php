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
//關閉連接
$pdo = null;
?>
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QRcode</title>
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
        #amount {
            width: 20%;
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
        <div><p>使用數量:</p></div>
        <div class="selsect">
            <select class="form-select form-select-lg mb-3" id="amount" name="amount" aria-label="Default select example" required="required">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <!-- <input type="button" name="Btn" id="Btn" value="使用" onclick="printQRcode()"> -->
        </div>

        <div id="jquery-qrcode-div"></div>
        <center><button type="button" class="btn btn-success" id="backbtn" onclick="history.back()">回到上一頁</button></center>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
        printQRcode();
        var select = document.getElementById("amount");
        select.addEventListener('click', printQRcode);


        function printQRcode(){
            var select = document.getElementById("amount"); //定義select，方便之後取值
            var amount = select.options[select.selectedIndex].value; //將option的值存起來

            document.getElementById("jquery-qrcode-div").innerHTML = "";

            $("#jquery-qrcode-div").qrcode({
                render: 'div',
                size: 250,
                text: 'http://localhost/GraduationProject/jump/QRcodeSend.php?id=<?php echo $id?>&pId=<?php echo $pId?>&amount='+amount+'&sId=<?php echo $sId?>'
            });
        }
    </script>
</body>

</html>