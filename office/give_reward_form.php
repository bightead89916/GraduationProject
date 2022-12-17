<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>給予獎懲</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    </script>
    <style type="text/css">
        .navbar {
            background-color: white;
        }
        
        .main-footer {
            background-color: rgb(150, 150, 150);
        }
        
        .carousel {
            margin-bottom: 10px;
        }
        
        table tr:hover {
            /*hover=滑鼠指到*/
            background-color: rgba(238, 255, 0, 0.884);
        }
        
        img {
            width: 100px;
            max-width: 100%;
            /*不使用width:100% 是因避免圖片解析度不好，隨父元素被放大時會糊掉*/
            height: auto;
        }
        
        table img:hover {
            /*指到圖片放大*/
            width: 500px;
            height: auto;
        }
        
        .td_content {
            /*讓td不會太寬*/
            width: 500px;
            overflow-wrap: break-word;
        }
    </style>
</head>
<script>
    function update() { //給予獎懲的選單
        var select = document.getElementById("reason"); //定義select，方便之後取值
        var option = select.options[select.selectedIndex].text; //將option的值存起來
        document.getElementById("Textarea1").value += option;
    }

    function deleteSelect() {
        var select = document.getElementById("reason"); //定義select，方便之後取值
        var option = select.options[select.selectedIndex].text; //將option的值存起來
        document.getElementById("Textarea1").value += option;
    }

    function addSelect() {
        var reason = document.getElementById("reason"); //定義select
        var inputSelect = document.getElementById("inputSelect"); //定義input
        var str = "";
        var submitValue = inputSelect.value;
        str = submitValue; //str=input值

        var option = document.createElement("option");
        option.text = str;
        reason.add(option);
    }
</script>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
                    <img src="https://cop.npust.edu.tw/wp-content/uploads/2021/04/NPUSTLogo.svg-1024x564.png" alt="" width="45" height="24" class="d-inline-block align-text-top"> 
                    屏科大學生獎勵兌換系統
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="office_info.php">返回</a> -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <!--給予獎懲ui-->
        <form action="../jump/give_reward.php" method="POST" enctype="multipart/form-data" id="form">
        <div class="row">
            <h2 class="h2">給予獎懲</h2>
            <div class="col-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">學號：</label>
                    <input type="name" class="form-control" id="sId" name="sId" placeholder="請輸入學號" required="required">
                </div>
                <div class="mb-3">
                    <button type="button" onclick="search()">搜尋姓名</button>
                    <label for="exampleFormControlInput1" class="form-label" id="sName">學生姓名：</label>
                    <script> 
                    function search(){
                        var sId = document.getElementById("sId").value; //將option的值存起來
                        $.ajax({
                        url: '../jump/searchsName.php',
                        method: 'POST',               
                        dataType: 'json',             
                        data: {"act": "postsomething",
                            "sId": sId},    
                        success: function(res){//取得sName，顯示在網頁上
                                    if(res!=""){
                                    console.log(res)
                                    document.getElementById("sName").innerHTML = "";
                                    document.getElementById("sName").innerHTML += "學生姓名:"+res.sName;
                                    }
                                    else{
                                        console.log(res)
                                        document.getElementById("sName").innerHTML = "";
                                        document.getElementById("sName").innerHTML += "查無此學號";
                                    }
                                },
                        error: function (request, status, error) {
                            console.log(request.responseText);
                            }});
                            return false; 
                         }
                    </script>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">獎懲理由：</label>

                    <!-- <div class="select">
                        <select class="form-select-bg-size:16px 12px;" aria-label="Default select example" id="reasonSelect" name="reasonSelect" onChange="update()">
                        <option selected>獎懲理由</option>
                        <option value="1">擔任110學年上學期輔導股長</option>
                        <option value="2">代表學校比賽成績優異</option>
                        </select>
                        <button type="button" class="btn btn-danger" onclick="deleteSelect()">刪除選項</button>
                        <input type="text" id="inputSelect" placeholder="請輸入想新增的選項" />
                        <button type="button" class="btn btn-success" onclick="addSelect()">新增選項</button>
                    </div> -->
                    <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="請詳細敘述申請內容"></textarea>
                </div>

                <div class="select">
                    <select class="form-select form-select-lg mb-3" id="rewardType" name="rewardType" aria-label="Default select example" required="required">
                        <option selected value="">獎懲類型</option>
                        <option value="Commendation">嘉獎</option>
                        <option value="MinorMerit">小功</option>
                        <option value="MajorMerit">大功</option>
                        <option value="Admonition">警告</option>
                        <option value="MinorDemerit">小過</option>
                        <option value="MajorDemerit">大過</option>
                        </select>
                </div>

                <div class="select">
                    <select class="form-select form-select-lg mb-3" id="amount" name="amount" aria-label="Default select example" required="required">
                        <option selected value="">數量</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        </select>
                </div>

                <input type="submit" class="btn btn-primary" value="確定送出">
                <button type="button" class="btn btn-success" id="backbtn" onclick="history.back()">回到上一頁</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        //監聽變動
        // var update = document.querySelector('#reasonSelect');
        // update.addEventListener('change', function() {
        // });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>