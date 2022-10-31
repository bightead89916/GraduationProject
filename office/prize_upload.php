<?php 

//echo $_POST['comTest'];

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
                <a class="navbar-brand" href="../index.php">
                    <img src="https://cop.npust.edu.tw/wp-content/uploads/2021/04/NPUSTLogo.svg-1024x564.png" alt="" width="45" height="24" class="d-inline-block align-text-top"> 屏科大學生獎勵兌換系統
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="prize_upload.php">商品上架</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li> -->
                    </ul>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="#">登入</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    <div class="container" center>
        <h1>
            商品上架
        </h1>
        <!-- <div class="col-12 col-md-8 col-lg-8"> -->
        <form action="../jump/prize_upload_send.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">商品照片：</label>
                <input class="form-control" type="file" multiple placeholder="請上傳商品照片" name="picture" required>
            </div>

            <div class="mb-3">
                <label class="form-label">商品名稱：</label>
                <input type="text" class="form-control" placeholder="請輸入商品名稱" name="comName" required>
            </div>
            <!--
            <div class="mb-3">
                <label class="form-label">商品使用地點：</label>
                <input type="text" class="form-control"placeholder="請輸入商品使用地點" name="useLoc" required>
            </div>
            -->
            <div class="mb-3">
                <label class="form-label">商品描述：</label>
                <textarea class="form-control" rows="3" placeholder="請說明你的商品" name="comText" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">商品價格：</label>
                <input type="text" class="form-control" placeholder="請輸入商品價格" name="comPrice" required>
            </div>
            <div class="mb-3">
                <label class="form-label">商品數量：</label>
                <input type="text" class="form-control" placeholder="請輸入商品數量" name="comNum" required>
            </div>
            <div class="mb-3">
                <label class="form-label">到期日：</label>
                <input type="datetime-local" name="expiryDate" required>
            </div>
            <!-- </div> -->
            <center><input type="submit" class="btn btn-primary" value="確定上架"></center>
        </form>
    </div>


    <div class="container-fluid main-footer text-center">
        &copy; copyringht by Shantelle
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>