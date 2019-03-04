<?php
include "db.php";
session_start();
$check = "select * from keep_select_course where course_id = ".$_REQUEST['course'];
$data = $conn->query($check);

if ($data->num_rows == 0) {
    $sel = "insert into keep_select_course value('', ".$_SESSION['id'].", ".$_REQUEST['course'].")";
    if ($conn->query($sel)) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "เพิ่มรายวิชาที่เลือกแล้ว";
        header('Location:music-course.php');
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
        echo "<script> history.go(-1); </script>";
    }
}else {
    $_SESSION['alert']['status']  = "danger";
    $_SESSION['alert']['message']  = "รายวิชานี้มีอยู่ในรายการที่เลือกแล้ว";
    echo "<script> history.go(-1); </script>";
}