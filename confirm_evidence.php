<?php
include "db.php";
session_start();
if ($_GET['status'] == "ok") {
    $sql = "update member_addcourse set payment = 3 where id = ".$_GET['id'];   
}else {
    $sql = "update member_addcourse set payment = 2 where id = ".$_GET['id'];   
}
if ($conn->query($sql) == true) {
    $_SESSION['alert']['status'] = "success";
    $_SESSION['alert']['message'] = "บันทึกสำเร็จ";
    header("Location:show-member-course.php");
  }else{
      $_SESSION['alert']['status'] = "danger";
      $_SESSION['alert']['message'] = $conn->error;
      header("Location:show-member-course.php");
    }