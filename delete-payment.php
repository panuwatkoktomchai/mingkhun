
<?php include "db.php"; ?>
<?php // code php

// ลบข้อมูลการสมัคร
if (isset($_GET['delete'])) {
  $delete = "delete from member_addcourse where id = ".$_GET['delete'];
  if ($conn->query($delete) == true) {
    $_SESSION['alert']['status'] = "success";
    $_SESSION['alert']['message'] = "ลบข้อมูลแล้ว";
    header("Location:payment.php");
  }else{
      $_SESSION['alert']['status'] = "danger";
      $_SESSION['alert']['message'] = $conn->error;
      header("Location:payment.php");
    }
}

?>