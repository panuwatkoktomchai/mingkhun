

<?php
session_start();
include "db.php";

$sql = "select * from keep_select_course where user_id = ".$_SESSION['id'];
$data = $conn->query($sql);

$order = "insert into member_addcourse value(null,".$_SESSION['id'].", 0, '".date('Y-m-d')."','me', '".$_REQUEST['name_user']."', '".$_REQUEST['address_user']."', '".$_REQUEST['phone_user']."', '".$_REQUEST['email_user']."')";
if ($conn->query($order)) {
    $id = $conn->insert_id;
    foreach ($data as $key => $value) {
        $list = "insert into member_course value('', ".$id.", ".$value['course_id'].")";
        $conn->query($list);
    }
    $delete = "delete from keep_select_course where user_id = ".$_SESSION['id'];
    $conn->query($delete);
    $conn->close();
    header("Location:payment.php");
}else {
    $_SESSION['alert']['status'] = "danger";
    $_SESSION['alert']['message'] = "ERROR! at ".$conn->error;
    header('Location:list-course.php');
}


