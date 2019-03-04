<?php 
include "db.php";
session_start();
$image = "";
if($_FILES["filUpload"]["name"] != '') // ครวจสอบว่ามีการระบุรูปจากฟอร์มหรือไม่ ถ้ามีก็บันทีกรูป
{
    $date = new DateTime();
    $date = $date->getTimestamp();
    $file_name = $_FILES['filUpload']['name'];
    $file_size =$_FILES['filUpload']['size'];
    $file_tmp =$_FILES['filUpload']['tmp_name'];
    $file_type=$_FILES['filUpload']['type'];  
    $image = "uploads/confirm_course/".$date.$file_name; //ที่อยู่รูปภาพ
    move_uploaded_file($file_tmp,$image);
}

$sql = "insert into submit_evidence value(null, ".$_SESSION['id'].", '".$image."', ".$_GET['id'].")";
if ($conn->query($sql) == true) {
    $update = "update member_addcourse set payment = 1 where id = ".$_GET['id'];
    $conn->query($update);
    $_SESSION['alert']['status'] = "success";
    $_SESSION['alert']['message'] = "ส่งหลักฐานการชำระเงินเรียบร้อยแล้ว";
    header("Location:payment.php");
  }else{
    $_SESSION['alert']['status'] = "danger";
    $_SESSION['alert']['message'] = $conn->error;
    header("Location:payment.php");
}
