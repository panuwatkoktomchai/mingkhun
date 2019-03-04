<?php
session_start();
include "db.php";


$sql = "SELECT member_addcourse.*, users.fullname FROM member_addcourse LEFT JOIN users ON users.id = member_addcourse.user_id where member_addcourse.id = ".$_GET['id'];
$data = $conn->query($sql);
$data = $data->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <h1>ขอมูลการสมัคร</h1>
    รหัสสมัคร <?php echo $data['id'] ?> <BR>
    วันที่สมัคร <?php echo $data['date'] ?>

    <h1>ข้อมูลผู้สมัคร</h1>
    ชื่อ <?php echo $data['name_user'] ?> <br>
    อีเมล <?php echo $data['email_user'] ?> <br>
    ที่อยู่ <?php echo $data['address_user'] ?>

    <h1> ข้อมูลรายวิชาที่สมัคร </h1>
    <?php
    // ดึงข้อมูลรายวิชา
    $StrSql = "SELECT * FROM member_course left join course on course.id = member_course.course_id where member_course.order_id = ".$data['id'];
    $list = $conn->query($StrSql);
    ?>
    <table style="width:100%">
        <tr>
            <th>..</th>
            <th>รหัสวิชา</th>
            <th>ชื่อวิชา</th> 
            <th>รายละเอียด</th>
            <th>ราคา</th>
        </tr>
        <?php foreach($list as $key=>$value){ ?>
        <tr>
            <td><?php echo $key +1 ?></td>
            <td><?php echo $value['id'] ?></td>
            <td><?php echo $value['c_name'] ?></td> 
            <td><?php echo $value['c_detail'] ?></td>
            <td><?php echo $value['c_price'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>