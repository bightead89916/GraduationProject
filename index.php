<?php
session_start();

$commodity_array = array();
$page = 0;
//取得現在頁數
if(isset($_GET['page'])){
    $page = $_GET['page'];
}

$pdo = null;
//連線資料庫
require_once('connectDB.php');
$pdo = connectDB();


try{//取得商品資訊
    $sql = ("SELECT * FROM `prize` WHERE `stock` != 0");
    $commodity_array = $pdo->query($sql);
    $com_count = $commodity_array->rowCount();
    //$page_count = intval($com_count/6);
    $page_count = $com_count/6;
    //取得商品售出數量
    $sql = "SELECT pId, pName, COUNT(sId) FROM `prizelogs` NATURAL JOIN `prize` GROUP BY `pId` ORDER BY COUNT(sId) DESC;";
    $resumeList = $pdo->query($sql);
    $resumeList = $resumeList->fetchall(PDO::FETCH_ASSOC);
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
                            <a class="nav-link" href="jump/logout.php" id="portal_login_button">登出</a>
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
                        <?php else:?>
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

    </div>

    <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="http://picsum.photos/1200/300?random=21" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="http://picsum.photos/1200/300?random=22" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="http://picsum.photos/1200/300?random=23" class="d-block w-100" alt="...">
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

    <!-- <div class="container">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">首頁</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>
    </div> -->

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="row">
                    <?php $i = 0; foreach($commodity_array as $commodity) : ?>
                    <?php if( $page*6 <= $i && $i < ($page+1)*6 ) : ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card" style="width: 18rem;">
                            <img src="jump/<?php echo $commodity['pictureAddress'] ?>" class="card-img-top" alt="...">
                            <div class="card-body" method="post">
                                <h5 class="card-title"><?php echo $commodity['pName'] ?></h5>
                                <p class="card-text"><?php echo $commodity['content'] ?></p>
                                <!--<a class="btn btn-primary" href="/grdProjectPHP/deleteCom.php?id=<?php echo $commodity['pId'] ?>">我要兌換</a>-->
                                <a class="btn btn-primary" href="/GraduationProject/prize_info.php?id=<?php echo $commodity['pId'] ?>">我要兌換</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; $i++;?>
                    <?php endforeach; ?>

                </div>

                <nav aria-label="...">
                    <ul class="pagination pagination-sm justify-content-center">
                        <?php for($j=0; $j<$page_count; $j++) : ?>
                        <?php if($page == $j) : ?>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link"><?php echo $j+1 ?></span>
                        </li>
                        <?php else : ?>
                        <li class="page-item"><a class="page-link" href="/grdProjectPHP/index.php?page=<?php echo $j ?>"><?php echo $j+1 ?></a></li>
                        <?php endif;?>
                        <?php endfor; ?>
                    </ul>
                </nav>

            </div>
            <div class="col-12 col-md-3">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action active" aria-current="true">
                        兌換排行榜
                    </a>
                    <?php $i=1; foreach($resumeList as $resume):?>
                        <a href="prize_info.php?id=<?php echo $resume['pId'];?>" class="list-group-item list-group-item-action">No.<?php echo $i." ".$resume['pName'];?></a>
                    <?php $i++; endforeach;?>
                </div>
            </div>
        </div>
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