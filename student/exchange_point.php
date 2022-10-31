<?php
session_start();

if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == TRUE){
    $id = $_SESSION['login_id'];
}else{
    header('Location: login.php?msg=請再次登入');
}

//錯誤警告
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

//連線資料庫
try{
    $pdo = new PDO('mysql:host=localhost:3307;dbname=graduation_project',"root","466110");
    //echo "成功連線";
}catch (PDOException $e){
    echo $e->getMessage();
}
//學生資訊
try{
    $sql = "SELECT * FROM `student` WHERE `stu_id`='{$id}';";
    $user_array = $pdo->query($sql);
    $sql = "SELECT * FROM `rp` WHERE `stu_id`='{$id}';";
    $rp_array = $pdo->query($sql);

    $user = $user_array->fetch();
    $rp = $rp_array->fetch();
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
            padding-top: 5px;
            padding-right: 5px;
            padding-bottom: 5px;
        }
        
        .rightDiv table td {
            font-size: large;
            font-family: verdana;
        }
        
        .rightDiv table th {
            font-size: large;
        }
        
        .rightDiv table thead {
            font-weight: bold;
            font-size: x-large;
        }
        
        .rewardInfo .point {
            font-weight: bold;
            font-size: x-large;
        }
        
        .rewardInfo .reward td {
            padding-top: 5px;
            padding-right: 5px;
            padding-bottom: 5px;
            font-size: x-large;
        }
        
        .rightChangeBar .statement {
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: bold;
            font-size: x-large;
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
                    <ul class="navbar-nav">
                    </ul>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="portal_login_button"><?php echo $user['stu_id'].' '.$user['stu_name'] ?></a>
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
        <div class="navbar-collapse ui-layout-west ui-layout-resizer-west-closed">
            <div class="leftNav">
                <ul class="jd_menu_vertical" style="margin-left: 0; padding-left:0;">
                    <li><a href="student_info.php"><span class="min-i-arrow"></span>學生資訊</a></li>
                    <li><a href="exchange_point.php"><span class="min-i-arrow"></span>點數兌換</a></li>
                    <li><a href="student_point_history.html"><span class="min-i-arrow"></span>歷史紀錄</a></li>
                    <li><a href="forgot_password.html"><span class="min-i-arrow"></span>更改密碼</a></li>
                    <li><a href="獎勵申請_同意書.html"><span class="min-i-arrow"></span>申請獎勵</a></li>
                    <li><a href="forgot_metamask.html"><span class="min-i-arrow"></span>更換MetaMask地址</a></li>
                </ul>
            </div>
        </div>
        <div class="rightDiv">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="student_info.html">首頁</a></li>
                    <li class="breadcrumb-item active" aria-current="page">點數兌換</li>
                </ol>
            </nav>
            <!--兌換點數-->
            
            <div class="rightChangeBar">
                <form action="sendExchange.php" method = "POST">
                <div class="select">
                    <div class="rewardInfo">
                        <div class="point">
                            <div>目前持有的點數:<?php echo $user['point']?>
                                <!--在這輸出點數-->
                            </div>
                        </div>
                        <div class="reward">
                            <!--0改成資料庫的數值-->
                            <table>
                                <tr>
                                    <td>嘉獎:<?php echo $rp['com']?></td>
                                    <td>小功:<?php echo $rp['mime']?></td>
                                    <td>大功:<?php echo $rp['mame']?></td>
                                </tr>
                                <tr>
                                    <td>警告:<?php echo $rp['adm']?></td>
                                    <td>小過:<?php echo $rp['mide']?></td>
                                    <td>大過:<?php echo $rp['made']?></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                    <?php if($rp['com']!=0 || $rp['mime']!=0 || $rp['mame']!=0):?><!--判斷是否有獎勵可換成點數-->
                    <div class="col-9">
                        <select id="rewardSelect" class="form-select form-select-lg mb-3" name="rp" aria-label="Default select example" onChange="selectUpdate()">
                            <option selected value="0">獎懲類型</option>
                            <?php
                            if($rp['com']!=0){
                                echo "<option value='1000'>嘉獎</option>";
                            }
                            if($rp['mime']!=0){
                                echo "<option value='3000'>小功</option>";
                            }
                            if($rp['mame']!=0){
                                echo "<option value='9000'>大功</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-9">
                        <select id="countSelect" class="form-select form-select-lg mb-3" name="num" aria-label="Default select example" onChange="selectUpdate()">
                            <option selected value="0">數量</option>
                            <script>
                                var rp_com = <?php echo $rp['com']?>;
                                var rp_mime = <?php echo $rp['mime']?>;
                                var rp_mame = <?php echo $rp['mame']?>;
                                var select = document.getElementById('rewardSelect');
				                var option = select.options[select.selectedIndex];
                                
                                const selectOne = document.querySelector("#rewardSelect");
                                const selectOption = document.getElementById("countSelect");
                                selectOne.addEventListener("change", createElement);
                                function elementFromHtml(html){
                                    const template = document.createElement("template");
                                    template.innerHTML = html.trim();
                                    return template.content.firstElementChild;
                                }
                                function createElement(){
                                    while(selectOption.lastElementChild){
                                        selectOption.removeChild(selectOption.lastElementChild);
                                    }
                                    switch(select.value){
                                        case "0":
                                            var createOption = elementFromHtml(`<option selected value="0">數量</option>`);
                                            selectOption.appendChild(createOption);
                                            break;
                                        case "1000":
                                            for(var i=1; i<=rp_com; i++){
                                                var createOption = elementFromHtml(`<option class="jsCreate" value="${i}">${i}</option>`);
                                                selectOption.appendChild(createOption);
                                            }
                                            break;
                                        case "3000":
                                            for(var i=1; i<=rp_mime; i++){
                                                var createOption = elementFromHtml(`<option class="jsCreate" value="${i}">${i}</option>`);
                                                selectOption.appendChild(createOption);
                                            }
                                            break;
                                        case "9000":
                                            //document.getElementById("countSelect").remove(document.getElementsByClassName("jsCreate"));
                                            for(var i=1; i<=rp_mame; i++){
                                                var createOption = elementFromHtml(`<option class="jsCreate" value="${i}">${i}</option>`);
                                                selectOption.appendChild(createOption);
                                            }
                                            break;
                                    }
                                }
                            </script>
                            <!--
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            -->
                        </select>
                    </div>
                    
                </div>
                <div id="statement" class="statement">
                    兌換的點數為:
                    <!--js取select值，計算後顯示-->
                    <!--判斷有沒有足夠的嘉獎還沒寫-->
                    <script>
                        function selectUpdate() {
                            var rewardSelect = document.getElementById("rewardSelect");
                            var countSelect = document.getElementById("countSelect");
                            var statement = document.getElementById("statement");
                            var rewardValue = rewardSelect.value;
                            var countValue = countSelect.value;
                            if(countValue==0){countValue++;}
                            console.log("rewardValue:"+rewardValue);
                            console.log("countValue:"+countValue);
                            statement.innerHTML = '兌換的點數為:' + rewardValue * countValue;
                        }
                    </script>
                </div>
                <input  class="btn btn-primary" type="submit" name="submit" value="確定兌換"/>
                </form>
                <?php else:?><!--如果沒有的話-->
                    <h1>並沒有獎勵可換成點數</h1>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>