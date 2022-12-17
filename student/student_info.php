<?php
session_start();

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == true) {
    $id = $_SESSION['login_id'];
} else {
    header('Location: ../login.php?msg=請再次登入');
}
$sId = $id;
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
            
        }

        .rightDiv table thead {
            font-weight: bold;
            font-size: x-large;
        }

        .dropdown {
            display: none;
        }

table{
  font-family: 'Oswald', sans-serif;
  border-collapse:collapse;

  overflow:hidden;
  border-radius:10px 10px 0px 0px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);
}

th{
  background-color:#009879;
  color:#ffffff;
  width:25vw;
  height:75px;
}

td{
  background-color:#ffffff;
  width:25vw;
  height:50px;
  text-align:center;
}

tr{
  border-bottom: 1px solid #dddddd;
}

tr:last-of-type{
  border-bottom: 2px solid #009879;
}

tr:nth-of-type(even) td{
  background-color:#f3f3f3;
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
                            <a class="nav-link" href="../jump/logout.php" id="portal_login_button">登出</a>
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
        <div class="leftNav" id="leftNav">
            <div class="ui-layout-west ui-layout-resizer-west-closed">
                <ul class="jd_menu_vertical" aria-labelledby="dropdownMenu" style="margin-left: 0; padding-left:0;">
                    <li><a href="student_info.php"><span class="min-i-arrow"></span>學生資訊</a></li>
                    <li><a href="student_point_history.php"><span class="min-i-arrow"></span>歷史紀錄</a></li>
                    <li><a href="change_password.php"><span class="min-i-arrow"></span>更改密碼</a></li>
                    <!-- <li><a href="forgot_password.php"><span class="min-i-arrow"></span>忘記密碼</a></li> -->
                    <!-- <li><a href="apply_reward_consent.php"><span class="min-i-arrow"></span>申請獎勵</a></li> -->
                </ul>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                學生資訊
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                <ul class="jd_menu_vertical" aria-labelledby="dropdownMenu" style="margin-left: 0; padding-left:0;">
                    <li><a class="dropdown-item" href="student_info.php"><span class="min-i-arrow"></span>學生資訊</a></li>
                    <li><a class="dropdown-item" href="student_point_history.php"><span class="min-i-arrow"></span>歷史紀錄</a></li>
                    <li><a class="dropdown-item" href="change_password.php"><span class="min-i-arrow"></span>更改密碼</a></li>
                    <!-- <li><a class="dropdown-item" href="forgot_password.php"><span class="min-i-arrow"></span>忘記密碼</a></li> -->
                    <!-- <li><a class="dropdown-item" href="apply_reward_consent.php"><span class="min-i-arrow"></span>申請獎勵</a></li> -->
                </ul>
            </ul>
        </div>
        <div class="rightDiv">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.html">首頁</a></li>
                    <li class="breadcrumb-item active" aria-current="page">學生資訊</li>
                </ol>
            </nav>
            <!--sql搜尋-->
            <?php
            require_once('../connectDB.php');
            $pdo = connectDB();
            //查學號姓名
            $search_sName = $pdo->prepare("SELECT `sName` FROM `student` WHERE `sId` = '$sId'");
            $search_sName->execute();
            $sNamefetch = $search_sName->fetch(PDO::FETCH_ASSOC);
            $sName = $sNamefetch['sName'];

            //查出持有點數
            $search_point = $pdo->prepare("SELECT `point` FROM `student` WHERE `sId` = '$sId'");
            $search_point->execute();
            $point = $search_point->fetch(PDO::FETCH_ASSOC);
            //查學生持有獎品，存成array
            $sql = "SELECT * FROM `student_prize` WHERE `sId` = '$sId' AND `amount` != 0";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $userData = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //查出pName
                $pId = $row['pId'];
                $search_pName = $pdo->prepare("SELECT `pName` FROM `prize` WHERE `pId` = '$pId'");
                $search_pName->execute();
                $pName = $search_pName->fetch(PDO::FETCH_ASSOC);

                $userData[] = array(
                    'id' => $row['id'],
                    'amount' => $row['amount'],
                    'pName' => $pName['pName'],
                    'updateTime' => $row['updateTime'],
                    'pId' => $row['pId'],
                    'sId' => $row['sId']
                );
            }
            $count = count($userData); //資料筆數
            $res = json_encode($userData, JSON_UNESCAPED_UNICODE);
            $pdo = null;
            ?>
            <!--sql搜尋結束-->
            <div class="rightTable">
                <h3><?php echo $sId;
                    echo $sName; ?></h3>
                <h3>目前持有點數:<?php echo $point['point'] ?></h3>
                <table name="exportTable" id="exportTable">
                    <!--js輸出table-->
                    <script>
                        //在這輸出學生持有的獎品資料
                        var count = <?php echo $count ?>; //資料個數
                        var res = <?php echo $res ?>; //結果的json
                        var sName = "<?php echo $sName ?>";

                        document.getElementById("exportTable").innerHTML = "";
                        document.getElementById("exportTable").innerHTML += '<table><tr><th scope="col">持有的獎品</th><th scope="col">數量</th><th scope="col">詳情</th><th scope="col">使用</th><th scope="col">最後取得時間</th></tr>';
                        for (var i = 0; i < count; i++) {
                            document.getElementById("exportTable").innerHTML += '<tr><td>' + res[i].pName + '</td><td>' + res[i].amount + '</td><td><a class="btn btn-secondary" href="/GraduationProject/prize_info.php?id=' + res[i].pId + '">詳情</a></td><td><a class="btn btn-primary" href="../jump/QRcode.php?id=' + res[i].id + '&pId=' + res[i].pId + '&pName=' + res[i].pName + '&sName=' + sName + '">使用QRcode</a></td><td>' + res[i].updateTime + '</td></tr>';
                        }
                    </script>
                </table>


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
<?php
$pdo = null;
?>