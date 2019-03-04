<?php 
include "db.php";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");

// เช็คเวลาซ้ำ
$find = "select * from schedule where start_time < '".$_REQUEST['start_time']."' and end_time > '"
        .$_REQUEST['start_time']."' or start_time < '".$_REQUEST['end_time']."' and end_time > '"
        .$_REQUEST['end_time']."' and date = '".$_REQUEST['date']."' and room_id = ".$_REQUEST['room_id'];
$res = $conn->query($find);

$start = strtotime($_REQUEST['start_time']);
$end = strtotime($_REQUEST['end_time']);

// echo $start."<br>";
// echo $end."<br>";
// echo $end - $start;

if ($res->num_rows > 0) {
    $_SESSION['alert']['status']  = "warning";
    $_SESSION['alert']['message']  = "ห้องเรียนนี้ถูกใช้งานไปแล้ว";
    echo "<script> history.go(-1); </script>";
}elseif ($start >= $end || $end - $start < 3600 ) {
    $_SESSION['alert']['status']  = "warning";
    $_SESSION['alert']['message']  = "โปรดเลือกเวลาในการสอนขั้นต่ำ 60 นาที";
    echo "<script> history.go(-1); </script>";
}else{
    // insert
    $sql = "insert into schedule value('', ".$_REQUEST['course_id'].", ".$_SESSION['id'].", '".$_REQUEST['start_time']
            ."', '".$_REQUEST['end_time']."', '".$_REQUEST['date']."', ".$_REQUEST['room_id'].")";

    $update_status = "update music_course set active = 1 where id = ".$_REQUEST['course_id'];
    if ($conn->query($sql) == true && $conn->query($update_status) == true) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "บันทึกข้อมูลสำเร็จ";
        header('Location:set_schedule.php');
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
        $delete = "delete from schedule where id = ".$conn->insert_id;
        $conn->query($delete);
        echo "<script> history.go(-1); </script>";
    }
}

