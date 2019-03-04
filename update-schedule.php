<?php 
include "db.php";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");

// เช็คเวลาซ้ำ
$find = "select * from schedule where start_time < '".$_REQUEST['start_time']."' and end_time > '"
        .$_REQUEST['start_time']."' and start_time < '".$_REQUEST['end_time']."' and end_time > '"
        .$_REQUEST['end_time']."' and date_teach = '".$_REQUEST['date_teach']."' and room_id = ".$_REQUEST['room_id'].
        " and id != ".$_REQUEST['id'];
$res = $conn->query($find);

$start = strtotime($_REQUEST['start_time']);
$end = strtotime($_REQUEST['end_time']);

// echo $start."<br>";
// echo $end."<br>";
// echo $end - $start;
// exit;

if ($res->num_rows > 0) {
    $_SESSION['alert']['status']  = "danger";
    $_SESSION['alert']['message']  = "ห้องเรียนนี้ถูกใช้งานไปแล้ว";
    echo "<script> history.go(-1); </script>";
}elseif ($start >= $end || $end - $start < 1800 ) {
    $_SESSION['alert']['status']  = "danger";
    $_SESSION['alert']['message']  = "เวลาในการสอนขั้นต่ำ 30 นาทีเท่านั้น";
    echo "<script> history.go(-1); </script>";
}else{
    // insert
    $sql = "update schedule set start_time = '".$_REQUEST['start_time']."', end_time = '".$_REQUEST['end_time']."',
    date_teach = '".$_REQUEST['date_teach']."', room_id = ".$_REQUEST['room_id']." where id = ".$_REQUEST['id'];

    if ($conn->query($sql) == true) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "อัพเดทข้อมูลสำเร็จ";
        header('Location:set_schedule.php');
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
        echo "<script> history.go(-1); </script>";
    }
}

