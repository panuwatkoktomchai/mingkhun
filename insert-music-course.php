<?php 
include "db.php";
session_start();


/**
 * check id product
 */
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");

$sqlcheck = "select * from music_course where date_course = '".$_REQUEST['date_course']."' and time_course = '".$_REQUEST['time_course']."'";
$res = $conn->query($sqlcheck);
if ($res->num_rows > 0) {
    $_SESSION['alert']['status'] = "warning";
    $_SESSION['alert']['message'] = "วันและเวลาที่เลือกถูกใช้งานแล้ว";
    echo "<script> history.go(-1); </script>";
}else {
    $sql = "insert into music_course (id, course_id,time_course,date_course,user) 
        value ( '',".$_REQUEST['course'].",'".$_REQUEST['time_course']."','".$_REQUEST['date_course']."', ".(int)$_SESSION['id'].");";
    mysqli_query($conn, "SET NAMES UTF8");

    if ($conn->query($sql)== true) {
        $_SESSION['alert']['status'] = "success";
        $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
        header('Location:'.$_GET['p']);
    }else{
        $_SESSION['alert']['status'] = "danger";
        $_SESSION['alert']['message'] = "ERROR! at ".$conn->error;
        header('Location:'.$_GET['p']);
    }
}




