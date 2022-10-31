<?php
//連線資料庫，取出全部資料，後面用if篩選
include("../connect.php");
$sId='B10856056';

$sql = "SELECT * FROM `prizelogs` WHERE `sId` = '$sId'";
$prizelogs = $pdo->query($sql);//獎品兌換紀錄

$stmt = $pdo->prepare("SELECT COUNT(*) FROM `prizelogs` WHERE `sId` = '$sId'");
$stmt->execute();
$prizelogsarray = $stmt->fetchAll(PDO::FETCH_ASSOC);//獎品兌換紀錄數量

//------
$sql = "SELECT * FROM `rewardslogs` WHERE `sId` = '$sId'";
$rewardslogs = $pdo->query($sql);//獎懲兌換紀錄

$stmt = $pdo->prepare("SELECT COUNT(*) FROM `rewardslogs` WHERE `sId` = '$sId'");
$stmt->execute();
$rewardslogscount = $stmt->fetchColumn();//獎懲兌換紀錄數量
//------
//關閉資料庫連線
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
                <a class="navbar-brand" href="../index.html">
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
                            <a class="nav-link" href="#" id="portal_login_button">B10856056 羅文佑</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
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
        <!--左邊的清單-->
        <div class="leftNav" id="leftNav">
            <div class="ui-layout-west ui-layout-resizer-west-closed">
                <ul class="jd_menu_vertical" aria-labelledby="dropdownMenu" style="margin-left: 0; padding-left:0;">
                    <li><a href="student_info.html"><span class="min-i-arrow"></span>學生資訊</a></li>
                    <li><a href="exchange_point.html"><span class="min-i-arrow"></span>點數兌換</a></li>
                    <li><a href="student_point_history.html"><span class="min-i-arrow"></span>歷史紀錄</a></li>
                    <li><a href="forgot_password.html"><span class="min-i-arrow"></span>更改密碼</a></li>
                    <li><a href="apply_reward_consent.html"><span class="min-i-arrow"></span>申請獎勵</a></li>
                    <li><a href="forgot_metamask.html"><span class="min-i-arrow"></span>更換MetaMask地址</a></li>
                </ul>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                歷史紀錄
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                <ul class="jd_menu_vertical" aria-labelledby="dropdownMenu" style="margin-left: 0; padding-left:0;">
                    <li><a class="dropdown-item" href="student_info.html"><span class="min-i-arrow"></span>學生資訊</a></li>
                    <li><a class="dropdown-item" href="exchange_point.html"><span class="min-i-arrow"></span>點數兌換</a></li>
                    <li><a class="dropdown-item" href="student_point_history.html"><span class="min-i-arrow"></span>歷史紀錄</a></li>
                    <li><a class="dropdown-item" href="forgot_password.html"><span class="min-i-arrow"></span>更改密碼</a></li>
                    <li><a class="dropdown-item" href="apply_reward_consent.html"><span class="min-i-arrow"></span>申請獎勵</a></li>
                    <li><a class="dropdown-item" href="forgot_metamask.html"><span class="min-i-arrow"></span>更換MetaMask地址</a></li>
                </ul>
            </ul>
        </div>
        <div class="rightDiv">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.html">首頁</a></li>
                    <li class="breadcrumb-item active" aria-current="page">歷史紀錄</li>
                </ol>
            </nav>
            <!--js輸出table-->
            <div class="rightTable">
                <table>
                    <tbody>
                        <tr>
                            <th>學號:</th>
                            <td>B10856056</td>
                            <th>姓名:</th>
                            <td>羅文佑</td>
                            <th>查詢項目:</th>
                            <td class="select">
                                <select class="form-select" name="searchSelect" id="searchSelect">
                                    <option selected value="1">獎品兌換紀錄</option>
                                    <option value="2">獎品使用紀錄</option>
                                    <option value="3">獎懲紀錄</option>
                                </select>
                            </td>
                            <td>
                                <input type="button" name="searchBtn" id="searchBtn" value="查詢" onclick="search()">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="resultTable" name="resultTable" id="resultTable">
                <table class="result" name="exportTable" id="exportTable">
                        <!--按下查詢後輸出資料-->
                        <script>
                            
                            function search(){
                                var select = document.getElementById("searchSelect"); //定義select，方便之後取值
                                var option = select.options[select.selectedIndex].value; //將option的值存起來
                                $.ajax({
                                url: 'student_point_history_send.php',
                                method: 'POST',               
                                dataType: 'json',             
                                data: {"act": "postsomething",
                                    "option": option},    
                                success: function(res){//取得資料的json檔，輸出成表格
                                    if(option==1){//獎品兌換紀錄
                                        var rescount = Object.keys(res).length;//資料個數
                                        document.getElementById("exportTable").innerHTML = "";
                                        document.getElementById("exportTable").innerHTML += '<table><tr><th scope="col">時間</th><th scope="col">處室</th><th scope="col">獎品名稱</th><th scope="col">單價</th><th scope="col">數量</th><th scope="col">點數變化</th></tr>';
                                        for(var i=0;i<rescount;i++){
                                            document.getElementById("exportTable").innerHTML += '<tr><td>' + res[i].transactionTime + '</td><td>' + res[i].oName + '</td><td>' + res[i].pName + '</td><td>' + res[i].price + '</td><td>' + res[i].amount + '</td><td>' + res[i].point + '</td></tr>';
                                        }
                                    }
                                    else if(option==2){
                                        var rescount = Object.keys(res).length;//資料個數
                                        document.getElementById("exportTable").innerHTML = "";
                                        document.getElementById("exportTable").innerHTML += '<table><tr><th scope="col">使用時間</th><th scope="col">處室</th><th scope="col">獎品名稱</th><th scope="col">數量</th></tr>';
                                        for(var i=0;i<rescount;i++){
                                            document.getElementById("exportTable").innerHTML += '<tr><td>' + res[i].transactionTime + '</td><td>' + res[i].oName + '</td><td>' + res[i].pName + '</td><td>' + res[i].amount +'</td></tr>';
                                        }
                                        console.log(res)
                                    }
                                    else if(option==3){
                                        var rescount = Object.keys(res).length;//資料個數
                                        document.getElementById("exportTable").innerHTML = "";
                                        document.getElementById("exportTable").innerHTML += '<table><tr><th scope="col">時間</th><th scope="col">嘉獎</th><th scope="col">小功</th><th scope="col">大功</th><th scope="col">警告</th><th scope="col">小過</th><th scope="col">大過</th><th scope="col">點數變化</th><th scope="col">事由</th></tr>';
                                        for(var i=0;i<rescount;i++){
                                            document.getElementById("exportTable").innerHTML += '<tr><td>' + res[i].updateTime + '</td><td>' + res[i].Commendation + '</td><td>' + res[i].MinorMerit + '</td><td>' + res[i].MajorMerit + '</td><td>' + res[i].Admonition + '</td><td>' + res[i].MinorDemerit +'</td><td>' + res[i].MajorDemerit +'</td><td>' + res[i].point +'</td><td>' + res[i].reason +'</td></tr>';
                                        }
                                    }
                                },
                                error: function (request, status, error) {
                                console.log(request.responseText);
                                }});
                                return false; 
                            }
                            // function search123() {
                            //     var select = document.getElementById("searchSelect"); //定義select，方便之後取值
                            //     var option = select.options[select.selectedIndex].value; //將option的值存起來
                            //     if(option=1){
                            //         document.getElementById("exportTable").innerHTML = ""; //清空div

                            //         var prizelogscount = "";
                            //         var rewardslogscount = "";
                                    
                            //         var searchSelect;
                            //         var pid = 1;
                            //         for (i = 0; i < pid; i++) {
                            //             var time = "123";
                            //             var oName = "教務處";
                            //             var pName = "成績單手續費";
                            //             var price = "10";
                            //             var amount = "10";
                            //             var point = "-100";
                            //             document.getElementById("exportTable").innerHTML += '<table><tr><th scope="col">時間</th><th scope="col">處室</th><th scope="col">獎品名稱</th><th scope="col">單價</th><th scope="col">數量</th><th scope="col">點數變化</th></tr><tr><td>' + time + '</td><td>' + oName + '</td><td>' + pName + '</td><td>' + price + '</td><td>' + amount + '</td><td>' + point + '</td></tr></table>';
                            //     }
                            //     }
                            // }
                        </script>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>