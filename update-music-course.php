<?php 
include "db.php";
session_start();


/**
 * check id product
 */
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");

$sqlcheck = "select * from music_course where date_course = '".$_REQUEST['date_course']."' and time_course = '".$_REQUEST['time_course']."' and id != ".$_REQUEST['id'];
$res = $conn->query($sqlcheck);
if ($res->num_rows > 0) {
    $_SESSION['alert']['status'] = "warning";
    $_SESSION['alert']['message'] = "วัน".$_REQUEST['date_course']." เวลา".$_REQUEST['time_course']."ถูกใช้งานแล้ว";
    echo "<script> history.go(-1); </script>";
}else {
    $sql = "update music_course set course_id = ".$_REQUEST['course'].", date_course = '".$_REQUEST['date_course']."', time_course = '".$_REQUEST['time_course']."' where id = ".$_REQUEST['id'];
    if ($conn->query($sql)== true) {
        $_SESSION['alert']['status'] = "success";
        $_SESSION['alert']['message'] = "อัพเดทข้อมูลสำเร็จ";
        header('Location:'.$_GET['p']);
    }else{
        $_SESSION['alert']['status'] = "success";
        $_SESSION['alert']['message'] = "ERROR! at ".$conn->error;
        header('Location:'.$_GET['p']);
    }
}




