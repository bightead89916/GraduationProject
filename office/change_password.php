<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true && $_SESSION['is_office'] == true){
    $id = $_SESSION['login_id'];
}else{
    $_SESSION['is_login'] = false;
    header('Location: ../login.php?msg=請再次登入');
}

//連線資料庫
require_once('../connectDB.php');
$pdo = connectDB();
//管理員資訊
try{
    $sql = "SELECT * FROM `worker` WHERE `wAccount`='{$id}';";
    $user_array = $pdo->query($sql);

    $user = $user_array->fetch();
    //查oName
    $oId=$user['oId'];
    $sql = "SELECT * FROM `office` WHERE `oId`='{$oId}';";
    $office_array = $pdo->query($sql);
    $office = $office_array->fetch();
    $oName=$office['oName'];
}catch (PDOException $e){
    echo $e->getMessage();
}

//關閉連接
$pdo = null;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>屏科學生獎勵兌換系統</title>

    <style>
              * {
            margin: 0;
            padding: 0;
        }
        
        .main-footer {
            background-color: rgb(150, 150, 150);
        }
        
        .carousel {
            margin-bottom: 10px;
        }
        
        .container .leftNav {
            width: 20%;
            float: left;
            padding-right: 10px;
        }
        
        .container .rightDiv {
            width: 80%;
            float: right;
        }
        
        .leftNav ul li {
            font-size: large;
            background: url('../images/leftNav_bg.jpg') repeat-x;
            list-style: none;
            border-bottom: 1px solid #c5c5c5;
            line-height: 40px;
        }
        
        .leftNav ul li a {
            color: #494949;
            display: block;
            text-decoration: none;
            background: rgb(255, 255, 255);
            /* Old browsers */
            background: url('../images/topNav_left.jpg') repeat-x;
        }
        
        .leftNav ul li a:hover {
            color: #494949;
            /*background: #fef68b url('../images/leftNav_bg_hover.jpg') repeat-x;*/
            background: url('../images/topNav_left_h.jpg') repeat-x;
            text-decoration: none;
        }
        
        .table,
        td,
        th {
            padding: 5px;
            text-align: center;
        }
        
        .rightDiv table td {
            font-size: large;
            font-family: verdana;
            border: 1px solid #290023;
        }
        
        .rightDiv table th {
            font-size: large;
            border: 1px solid #290023;
            background: rgb(235, 234, 234);
        }
        
        .rightDiv table thead {
            font-weight: bold;
            font-size: x-large;
        }
        
        .dropdown {
            display: none;
        }
        
        @media (max-width: 768px) {
            .leftNav {
                display: none;
            }
            .container .rightDiv {
                width: 100%;
            }
            .dropdown {
                display: contents;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
                    <img src="https://cop.npust.edu.tw/wp-content/uploads/2021/04/NPUSTLogo.svg-1024x564.png" alt="" width="45" height="24" class="d-inline-block align-text-top"> 屏科大學生獎勵兌換系統
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    </ul>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="portal_login_button"><?php echo $oName.' '.$user['wName'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--
    要有的功能；修改密碼，修改MetaMask地址，展示有的點數，展示買過的獎品
    -->
    <div class="container">
        <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="http://picsum.photos/1200/200?random=21" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://picsum.photos/1200/200?random=22" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="http://picsum.photos/1200/200?random=23" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div> -->
        <!--左邊的清單-->
        <div class="navbar-collapse ui-layout-west ui-layout-resizer-west-closed">
            <div class="leftNav">
                <ul class="jd_menu_vertical" style="margin-left: 0; padding-left:0;">
                    <li><a href="office_info.php"><span class="min-i-arrow"></span><?php echo $oName?>已上架商品</a></li>
                    <li><a href="prize_upload.php"><span class="min-i-arrow"></span>商品上架頁面</a></li>
                    <!-- <li><a href="give_reward_consent.html"><span class="min-i-arrow"></span>獎懲申請書</a></li> -->
                    <li><a href="give_reward_form.php"><span class="min-i-arrow"></span>給予獎懲</a></li>
                    <li><a href="uploadBlockchain.php"><span class="min-i-arrow"></span>上傳區塊鏈</a></li>
                </ul>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                管理員介面
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                <ul class="jd_menu_vertical" aria-labelledby="dropdownMenu" style="margin-left: 0; padding-left:0;">
                <li><a class="dropdown-item" href="office_info.php"><span class="min-i-arrow"></span><?php echo $oName?>已上架商品</a></li>
                    <li><a class="dropdown-item" href="prize_upload.php"><span class="min-i-arrow"></span>商品上架頁面</a></li>
                    <!-- <li><a class="dropdown-item" href="give_reward_consent.html"><span class="min-i-arrow"></span>獎懲申請書</a></li> -->
                    <li><a class="dropdown-item" href="give_reward_form.php"><span class="min-i-arrow"></span>給予獎懲</a></li>
                    <li><a class="dropdown-item" href="uploadBlockchain.php"><span class="min-i-arrow"></span>上傳區塊鏈</a></li>
                </ul>
            </ul>
        </div>
        <div class="rightDiv">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php">首頁</a></li>
                    <li class="breadcrumb-item active" aria-current="page">管理員介面</li>
                </ol>
            </nav>
            <div><form action="../jump/change_Wpassword_send.php" method="POST" enctype="multipart/form-data" id="form">
		<legend class="">更改密碼</legend>
		<div class="">
		<div id="username" class="input_password" ><legend>帳號:<?php echo $id?></legend></div><div class="felement fstatic" data-fieldtype="static"></div></div>
        
		<div id="password" class="input_password" ><label for="id_password">請輸入現在的密碼<span class="req"></label><div class="" data-fieldtype="password"><input required="required" autocomplete="off" name="password" type="password" id="id_password" /></div></div>
		<div id="newpassword1" class="input_password" ><label for="id_newpassword1">請輸入新密碼<span class="req"></label><div class="" data-fieldtype="password"><input required="required" autocomplete="off" name="newpassword1" type="password" id="id_newpassword1" /></div></div>
		<div id="newpassword2" class="input_password" ><label for="id_newpassword2">請輸入新密碼 (再次)<span class="req"></label><div class="" data-fieldtype="password"><input required="required" autocomplete="off" name="newpassword2" type="password" id="id_newpassword2" /></div></div>
		</div>
        <input type="hidden" id="wAccount" name="wAccount" value="<?php echo $id?>">
        <input type="submit" class="btn btn-primary" value="確定送出">
    </form>
        </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>