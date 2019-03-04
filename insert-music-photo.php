<?php 
include "db.php";
session_start();


/**
 * check id product
 */
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$id = $_REQUEST['id'];
foreach($_FILES['filUpload']['tmp_name'] as $key => $val)
{
    
    $file_name = $_FILES['filUpload']['name'][$key];
    $file_size =$_FILES['filUpload']['size'][$key];
    $file_tmp =$_FILES['filUpload']['tmp_name'][$key];
    $file_type=$_FILES['filUpload']['type'][$key];  
    $image ="uploads/course_photo/".time().$file_name;
    move_uploaded_file($file_tmp,$image);
    $sql_insertphoto = "insert into music_course_file value('', '".$image."', '".$file_name."',".$id.")";
    if ($conn->query($sql_insertphoto)) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "เพิ่มรูปภาพเรียบร้อย";
        header('Location:music-photo.php?id='.$_REQUEST['id']);
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
        header('Location:music-photo.php?id='.$_REQUEST['id']);
    }
    
    
}