<?php
//使用parse_ini_file來讀取.ini檔案，會以陣列的方式來存放內容
$ini = parse_ini_file('config.ini',true);
//ini中的sction與參數名會變成陣列的索引 $ini[secion][參數名]
$db=$ini["database"]["db_name"];
$dbhost=$ini["database"]["db_host"];
$dbuser=$ini["database"]["db_user"];
$dbpass=$ini["database"]["db_password"];
//分行列印讀取的陣列資料
//echo '<pre>',print_r($ini);'</pre>';
try{
    $pdo = new PDO($dbhost,$dbuser,$dbpass);
    //echo "成功連線";
}catch (PDOException $e){
    echo $e->getMessage();
}
?>