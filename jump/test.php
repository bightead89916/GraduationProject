<?php
session_start();
require_once('../connectDB.php');
$pdo = connectDB();
$sId = $_SESSION['login_id'];
$pId = 0;
    $sql=$pdo->prepare("SELECT * FROM student_prize WHERE (sId = :sId AND pId = :pId)");
    $sql->execute(array(
        ':sId'         => "$sId",
        ':pId'          => "$pId",
        )
    );
    $count = $sql->rowCount();
    if($count == 0){//insert
        echo $count;
    }
    else{//update
        
    }
?>