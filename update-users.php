<?php 

include "db.php";



$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
session_start();

$getEmail = "select * from users where email = '".$_REQUEST['email']."' and id != ".$_REQUEST['id'];
$res = $conn->query($getEmail);
if ($res->num_rows > 0) {
    $_SESSION['alert']['status'] = "warning";
    $_SESSION['alert']['message'] = "อีเมลนี้ถูกใช้งานแล้ว";
    echo "<script> history.go(-1); </script>";
}elseif ($_REQUEST['password'] != $_REQUEST['con_password']) {
    $_SESSION['alert']['status'] = "warning";
    $_SESSION['alert']['message'] = "รหัสผ่านไม่ตรงกัน";
    echo "<script> history.go(-1); </script>";
    // header('Location:'.$_GET['p']);
}else{
    $obj = '';
    foreach ($_REQUEST as $key => $value) {
        if ($key=='id' || $key == 'p' || $key == "con_password" || $key == "datable_length") {
            continue;
        }
        $obj = $obj."".$key."='".$value."', ";
    }
    if($_REQUEST['id'] == $_SESSION['id']){
        $_SESSION['fullname'] = $_REQUEST['fullname'];
        $_SESSION['username'] = $_REQUEST['username'];
    }

    $sql = "UPDATE users SET ".$obj." create_at='".Date('Y-m-d')."' WHERE id = '".$_REQUEST['id']."';";
    if($conn->query($sql)==true){
        $_SESSION['alert']['status'] = "success";
        $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
        header('Location:'.$_GET['p']);

    }else{
        $_SESSION['alert']['status'] = "danger";
        $_SESSION['alert']['message'] = "อัพเดทข้อมูลผิดพลาดที่ ".$conn->error;
        echo "<script> history.go(-1); </script>";
        
    }
} // end check email exists
