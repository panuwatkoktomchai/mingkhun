<?php 
include "db.php";
session_start();


$file = "uploads/default.jpg";
  $filepath = "logo_seller/".$_FILES['fileUpload']['name'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $checkid = "select * from promotion  where id = ".$_REQUEST['id'];
    $res = $conn->query($checkid);
    //print_r($res);
   // exit();
    if ($res->num_rows != 0 ) {
        $_SESSION['alert']['status']  = "warning";
        $_SESSION['alert']['message']  = "รหัสนี้มีอยู่แล้ว";
        echo "<script> history.go(-1); </script>";
    }else {
        $sql = "insert into promotion (id, name, detail,discount, user, create_at) values(".$_REQUEST['id'].", '".$_REQUEST['name']."', '".$_REQUEST['detail']."',".$_REQUEST['discount'].",  ".$_SESSION['id'].", '".date('Y-m-d')."')";
        // echo $sql;
        // exit;
        if ($conn->query($sql) == true) {
            $_SESSION['alert']['status']  = "success";
            $_SESSION['alert']['message']  = "บันทึกข้อมูลสำเร็จ";
            header('Location:add-promotion.php');
        }else {
            $_SESSION['alert']['status']  = "danger";
            $_SESSION['alert']['message']  = $conn->error;
            echo "<script> history.go(-1); </script>";
        }
    }
    

// echo $filepath;