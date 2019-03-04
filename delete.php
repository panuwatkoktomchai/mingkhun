<?php
include "db.php";
session_start();
// print_r($_REQUEST);
// exit;
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "DELETE FROM ".$_REQUEST['table']." WHERE id = '".$_REQUEST['id']."';";
if ($_REQUEST['table']== "course") {
    
}elseif($conn->query($sql) == true){
    $_SESSION['alert']['status']  = "success";
    $_SESSION['alert']['message']  = "ลบข้อมูลจาก ID : ".$_REQUEST['id']." เรียบร้อย";
    header('Location:'.$_REQUEST['p']);
}else{
    $_SESSION['alert']['status']  = "danger";
    $_SESSION['alert']['message']  = "การลบข้อมูลล้มแหลว ".$conn->error;
    header('Location:'.$_REQUEST['p']);
    echo "delete eror".$conn->error;
}
