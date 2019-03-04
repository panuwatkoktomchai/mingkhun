<?php
include "db.php";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
$Musical = true;
if ($conn->connect_error) {
    echo "<script> alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้');</script>";
}else{
    $sql = "show databases;";
    $databases  = $conn->query($sql);
    // print_r($databases->fetch_assoc());
    foreach ($databases->fetch_assoc() as $key => $value) {
        if ($value == $dbname) {
            $Musical = false;
        }
    }
    if ($Musical) {
        $sql = "create database ".$dbname;
        if ($conn->query($sql) == true) {
            echo "<script> alert('สร้างฐานข้อมูลชื่อ ".$dbname." แล้ว');</script>";
            
        }
    }
}
?>