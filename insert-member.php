<?php include 'navbar.php';?>


<?php
  
    include "db.php";
    $sql = "insert into member (mb_name,mb_user,mb_pass,mb_age,mb_gen,mb_add,mb_tel,mb_mail)";
    
    $sql = $sql." values ('".$_REQUEST['fullname']."','".$_REQUEST['user']."','".$_REQUEST['mb_pass']."',".$_REQUEST['age'].", '".$_REQUEST['gender']."', '".$_REQUEST['address']."' ,'".$_REQUEST['mb_tel']."','".$_REQUEST['mb_mail']."')";
    // echo $servername,$username,$password,$dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    if ($conn->query($sql) == true) {
        
        echo("<script> alert('สมัครสมาชิกสำเร็จ !!'); window.location='Login.php';</script>");
        
    }else{
        echo("<script> alert('รหัสนี้มีผู้ใช้งานแล้ว !!'); window.location='register.php';</script>");
           
    }
?>





<h1> สมัครสมาชิกเรียบร้อยแล้ว</h1>
<a href="login.php">login</a>