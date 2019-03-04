<?php

include "db.php";
$data = $_REQUEST['data'];
$image = "";
if($_FILES["filUpload"]["name"] != '') // ครวจสอบว่ามีการระบุรูปจากฟอร์มหรือไม่ ถ้ามีก็บันทีกรูป
{
    $date = new DateTime();
    $date = $date->getTimestamp();
    $file_name = $_FILES['filUpload']['name'];
    $file_size =$_FILES['filUpload']['size'];
    $file_tmp =$_FILES['filUpload']['tmp_name'];
    $file_type=$_FILES['filUpload']['type'];  
    $image = "uploads/".$date.$file_name; //ที่อยู่รูปภาพ
    move_uploaded_file($file_tmp,$image);
}
$sql = "INSERT INTO `other_user_course` (`id`, `order_id`, `name`, `age`, `gen`, `address`, `phone`, `email`, `image`, `user_id`) VALUES (null,'".$data['order_id']."', '".$data['name']."', '".$data['age']."', '".$data['gen']."', '".$data['address']."', '".$data['phone']."', '".$data['email']."', '".$image."','".$_SESSION['id']."');";
if ($conn->query($sql)) {
    $_SESSION['alert']['status'] = "success";
    $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
    // header('Location:music-course.php');
}else{
    $_SESSION['alert']['status'] = "danger";
    $_SESSION['alert']['message'] = $conn->error;
    // header('Location:music-course.php');
}