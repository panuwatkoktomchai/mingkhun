<?php 
include "db.php";
session_start();


$file = "uploads/default.jpg";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $sql = "update promotion set name = '".$_POST['name']."', detail = '".$_POST['detail']."', discount = '".$_POST['discount']."' where id = '".$_POST['id']."'";
    if ($conn->query($sql) == true) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "อัพเดทข้อมูลเรียบร้อย";
        header('Location:add-promotion.php');
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
        header('Location:add-promotion.php');
    }

// echo $filepath;