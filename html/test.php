<?php
$dbhost = 'localhost'; //一般是 localhost 或 127.0.0.1
$dbuser = 'root'; //一般是 root
$dbpasswd = 'aaa974';
$dbname="rewardsystem";
$dbport="3306";
$dbcharacter = 'utf8mb4'; //一般是 utf8
try
{
    $db = new PDO("mysql:host={$dbhost}:{$dbport};dbname={$dbname};charset={$dbcharacter}", $dbuser, $dbpasswd);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //禁用prepared statements的模擬效果
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //讓資料庫顯示錯誤原因
    echo "連線成功";
} catch (PDOException $e) {
    die("無法連上資料庫：" . $e->getMessage());
}