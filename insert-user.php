<?php
   session_start();
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $checkmail = "select * from users where email = '".$_REQUEST['email']."'";
    $checkmail = $conn->query($checkmail);
    $checkuser = "select * from users where username = '".$_REQUEST['username']."'";
    $checkuser = $conn->query($checkuser);
    // print_r($checkuser);
    // exit;
    if ($checkuser->num_rows > 0) {
        $_SESSION['alert']['status'] = "warning";
        $_SESSION['alert']['message'] = "ชื่อผู้ใช้นี้ถูกใช้งานแล้ว";
        echo "<script> history.go(-1); </script>";
        // header('Location:'.$_GET['p']);
    }elseif ($_REQUEST['password'] != $_REQUEST['con_password']) {
        $_SESSION['alert']['status'] = "warning";
        $_SESSION['alert']['message'] = "รหัสผ่านไม่ตรงกัน";
        echo "<script> history.go(-1); </script>";
        // header('Location:'.$_GET['p']);
    }elseif ($checkmail->num_rows > 0) {
        $_SESSION['alert']['status'] = "warning";
        $_SESSION['alert']['message'] = "อีเมลนี้ถูกใช้งานแล้ว";
        echo "<script> history.go(-1); </script>";
        // header('Location:'.$_GET['p']);
    
    }else{
        $sql = "insert into users (id,fullname,email,tel,address,gen,status,approve,username,password,create_at,photo)";
        $sql = $sql." value (null,'".$_REQUEST['fullname']."','".$_REQUEST['email']."','".$_REQUEST['tel']."'";
        $sql = $sql.",'".$_REQUEST['address']."',".(int)$_REQUEST['gen'].",".(int)$_REQUEST['status'].",1,'".$_REQUEST['username']."','".$_REQUEST['password']."',".Date("Y-m-d").",'/upload'); ";

        // echo $servername,$username,$password,$dbname;
        if ($conn->query($sql) == true) {
            $_SESSION['alert']['status'] = "success";
            $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
            header('Location:'.$_GET['p']);
        }else{
            echo("<script>alert('การเพิ่มข้อมูลล้มเหลวง);</script>");        
        }
    }
    


?>