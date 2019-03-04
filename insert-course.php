<?php 
include "db.php";
session_start();
$sql = "insert into course value (null,'".$_REQUEST['c_name']."','".$_REQUEST['c_detail']."','".$_REQUEST['c_price']."','".$_SESSION['id']."')";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
// print_r($_FILES['filUpload']);
// exit;

if ($conn->query($sql)== true) {

    if(isset($_FILES["filUpload"]))
    {
        
        $id = $conn->insert_id;
        foreach($_FILES['filUpload']['tmp_name'] as $key => $val)
        {
            $file_name = $_FILES['filUpload']['name'][$key];
            $file_size =$_FILES['filUpload']['size'][$key];
            $file_tmp =$_FILES['filUpload']['tmp_name'][$key];
            $file_type=$_FILES['filUpload']['type'][$key];  
            move_uploaded_file($file_tmp,"uploads/course_photo/".$file_name);
            $sql_insertphoto = "insert into music_course_file value('', '"."uploads/course_photo/".$file_name."', '".$file_name."',".$id.")";
            if (!$conn->query($sql_insertphoto)) {
                $_SESSION['alert']['status'] = "warning";
                $_SESSION['alert']['message'] = "เกิดข้อผิดพลาดกับการบันทึกรูปภาพ ".$conn->error;
                echo "<script> history.go(-1); </script>";
                echo "<script> history.go(-1); </script>";
            }
        }
    }

    $_SESSION['alert']['status'] = "success";
    $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
    header('Location:'.$_GET['p']);
}else{
    $_SESSION['alert']['status'] = "warning";
    $_SESSION['alert']['message'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง ".$conn->error;
    echo "<script> history.go(-1); </script>";
}


