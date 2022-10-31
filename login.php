<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    header('Location: index.php');
}

if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
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
    <title>登入</title>
    <script src="js.js">
    </script>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        
        .navbar {
            background-color: white;
        }
        
        .main-footer {
            background-color: rgb(150, 150, 150);
        }
        
        .h2 {
            text-align: center;
        }
        
        .login-box .login-label {
            width: 33%;
            float: left;
            text-align: right;
        }
        
        .login-box .login-input {
            width: 66%;
            float: right;
        }
        
        .login-box .login-input input {
            width: 50%;
        }
        
        .content-login-box {
            margin: 5px;
            padding: 10px;
            text-align: center;
        }
        
        .clearer {
            background: transparent;
            border-width: 0;
            clear: both;
            display: block;
            height: 1px;
            margin: 0;
            padding: 0;
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
                    <ul class="nav justify-content-end">

                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
    </div>
    <!--登入，form表單post資料，action放網址可以連首頁-->
    <div class="content-login-sub">
        <form action="jump/loginCheck.php" method="post" id="login">
            <h2 class="h2">登入</h2>
            <div class="login-from col-12 justify-content-center">
                <div class="login-box">
                    <div class="login-label col-4 mb-3 mt-1">
                        <label for="username">
                                帳號: 
                        </label>
                    </div>
                    <div class="login-input col-8 mb-3 mt-1">
                        <input type="text" name="username" id="username" placeholder="預設為學號" value="">
                    </div>
                    <div class="login-label col-4">
                        <label class="lb mt-2" for="username">
                                密碼: 
                        </label>
                    </div>
                    <div class="login-input col-8">
                        <input type="password" name="password" id="password" placeholder="預設為身分證字號" value="">
                    </div>
                </div>
            </div>
            <div class="clearer"></div>
            <center><input type="submit" id="loginbtn" class="btn btn-primary mt-3" value="登入" /></center>
            <div class="clearer"></div>
            <center>
                <div class="forgetpass mt-3">
                    <a href="forgot_password.html">忘記密碼?</a>
                </div>
            </center>
        </form>
    </div>


    <div class="clearer"></div>
    <center>
        <div class="info mt-3">
            <h2>
                <font color="#FF0000" size="large">首次登入後請修改密碼!</font>
            </h2>
            <p>教師預設帳號：身份證字號</p>
            <p>教師預設密碼：教師代碼</p>
        </div>
    </center>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>