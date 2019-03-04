<?php 
include "db.php";
session_start();

// echo $_REQUEST['idnaja'];
$file = "uploads/default.jpg";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $sql = "update seller set name = '".$_REQUEST['name']."', address = '".$_REQUEST['address']."', phone = '".$_REQUEST['phone']."', owner = '".$_REQUEST['owner']."' where id = '".$_REQUEST['idnaja']."'";
    if ($conn->query($sql) == true) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "อัพเดทข้อมูลเรียบร้อย";
        header('Location:seller.php');
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
    }

// echo $filepath;

?>