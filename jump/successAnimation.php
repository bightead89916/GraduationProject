<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>成功給予獎懲!</title>
    <style type="text/css">
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }
        
        h2 {
            font-family: Helvetica;
            font-size: 36px;
            margin-top: 40px;
            color: #333;
            opacity: 0;
        }
        
        input[type="checkbox"]:checked~h2 {
            animation: .6s title ease-in-out;
            animation-delay: 1.2s;
            animation-fill-mode: forwards;
        }
        
        .circle {
            stroke-dasharray: 1194;
            stroke-dashoffset: 1194;
        }
        
        input[type="checkbox"]:checked+svg .circle {
            animation: circle 1s ease-in-out;
            animation-fill-mode: forwards;
        }
        
        .tick {
            stroke-dasharray: 350;
            stroke-dashoffset: 350;
        }
        
        input[type="checkbox"]:checked+svg .tick {
            animation: tick .8s ease-out;
            animation-fill-mode: forwards;
            animation-delay: .95s;
        }
        
        @keyframes circle {
            from {
                stroke-dashoffset: 1194;
            }
            to {
                stroke-dashoffset: 2388;
            }
        }
        
        @keyframes tick {
            from {
                stroke-dashoffset: 350;
            }
            to {
                stroke-dashoffset: 0;
            }
        }
        
        @keyframes title {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <input style="visibility: hidden" type="checkbox" checked>
    <svg width="400" height="400">
      <circle fill="none" stroke="#68E534" stroke-width="20" cx="200" cy="200" r="190" stroke-linecap="round" transform="rotate(-90 200 200)" class="circle" />
      <polyline fill="none" stroke="#68E534" stroke-width="24" points="88,214 173,284 304,138" stroke-linecap="round" stroke-linejoin="round" class="tick" class="tick "/>
    </svg>

    <h2>成功上傳!</h2>
    <script>
        setTimeout("location.href='office_info.php'", 4000); // 4秒後跳轉頁面
    </script>
</body>

</html>