<?php
session_start();

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
    $msg = null;
}

//取得商品ID
if(!isset($_GET['id'])){
    header('Location: index.php');
}
$id = $_GET['id'];

$pdo = null;
//連線資料庫
require_once('connectDB.php');
$pdo = connectDB();

try{//取得商品資訊
    $sql = "SELECT * FROM `prize` WHERE `pId`={$id};";
    $commodity_array = $pdo->query($sql);
    $commodity = $commodity_array->fetch();
    //取得商品售出數量
    $sql = "SELECT * FROM `prizelogs` WHERE `pId`={$id};";
    $resume = $pdo->query($sql);
    $count = $resume->rowCount();
    if($count == ""){
        $count = 0;
    }
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

    <title>屏科學生獎勵兌換系統</title>

    <style>
        .navbar {
            background-color: white;
        }
        
        .main-footer {
            background-color: rgb(150, 150, 150);
        }
        
        .carousel {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="https://cop.npust.edu.tw/wp-content/uploads/2021/04/NPUSTLogo.svg-1024x564.png" alt="" width="45" height="24" class="d-inline-block align-text-top"> 屏科大學生獎勵兌換系統
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <?php if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE):?>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" id="portal_login_button">登出</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li> -->
                        <?php if(isset($_SESSION['is_office']) && $_SESSION['is_office'] == true):?>
                        <li class="nav-item">
                            <a class="nav-link" href="office/office_info.php">個人資訊(Office)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="confirm.php">待確認單</a>
                        </li>
                        <?php else:?>
                        <li class="nav-item">
                            <a class="nav-link" href="apply_reward_consent.html">獎勵申請</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">持有兌換券</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="student/student_info.php">個人資訊(Student)</a>
                        </li>
                        <?php endif;?>
                        <!-- <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li> -->
                    </ul>
                    <?php else:?>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" id="portal_login_button">登入</a>
                        </li>
                    </ul>
                    <?php endif;?>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5">

                    <img src="<?php echo $commodity['pictureAddress']?>"
                        class="img-thumbnail" 
                        alt="<?php echo $commodity['pName'] ?>">
                </div>
                <div class="col-12 col-md-7">
                    <br>
                    <h1><?php echo $commodity['pName'] ?></h1>
                    已售出 <?php echo $count?> <br><br>
                    <h5>兌換點數：<?php echo $commodity['price']?> 點</h5>
                    <h5><?php //echo "商品地點：";echo $commodity['place']?></h5>
                    <h5>商品描述：<br><?php echo $commodity['content']?></h5>
                    <br><br><br><br><br><br>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary" type="button" onClick="location.href='sendBuy.php?id=<?php echo $commodity['pId']?>'">兌換</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="container-fluid main-footer text-center">
            &copy; copyringht by Shantelle
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->
</body>

</html>