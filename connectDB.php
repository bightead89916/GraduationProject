<?php
function connectDB(){
    require_once('connectDB.php');
    $ini = parse_ini_file('webConfig.ini',true);
    $db=$ini["database"]["db_name"];
    $dbhost=$ini["database"]["db_url"];
    $dbuser=$ini["database"]["db_user"];
    $dbpass=$ini["database"]["db_password"];

    try{
        $pdo = new PDO("mysql:host={$dbhost};dbname={$db}","{$dbuser}","{$dbpass}");
        return $pdo;
        //echo "成功連線";
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}


?>