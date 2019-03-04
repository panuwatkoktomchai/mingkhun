
<?php
 include 'navbar-employee.php';
include "db.php";
    session_start();
    $sql = "select * from member_addcourse where id = ".$_GET['id'];
    $data = $conn->query($sql);
    $data = $data->fetch_assoc();

    $image = "select * from submit_evidence where course_id = ".$_GET['id'];
    $image = $conn->query($image);

    
?>
<title>ยืนยันการสมัครเรียน</title>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="css/add_style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

        <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h3>รหัสรายการสมัคร : <?php echo $data['id'];  ?></h3>
    วันที่สมัคร <?php echo $data['date']; ?>
    <?php
    $music_course = "select music_course.*, course.c_name,course.c_detail,course.c_price from member_course left join music_course on member_course.course_id = music_course.id left join course on music_course.course_id = course.id where order_id = ".$data['id'];
    $datas = $conn->query($music_course);
    $total = 0;
    ?>
    <table class="table">
    <thead>
      <tr>
        <td>รหัสวิชา</td>
        <td>ชื่อวิชา </td>
        <td>รายละเอียด</td>
        <td>วันที่เรียน</td>
        <td>เวลาเรียน</td>
        <td>ราคา</td>
      </tr>
    </thead>
    <?php foreach($datas as $keys=>$values) { ?>
    <?php
      $total = $total + (int)$values['c_price'];
      $day = ['จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์']
    ?>
    <tr>
        <td><?php echo $values['id'] ?></td>
        <td><?php echo $values['c_name'] ?></td>
        <td width="500px"><?php echo $values['c_detail'] ?></td>
        <td ><?php echo $day[$values['date_course']-1] ?></td>
     

        <td><?php echo $values['time_course'] ?></td>
        <td><?php echo $values['c_price'] ?></td>
      </tr>
    <?php } ?>
    </table>
    <hr>
    <span  style="border-bottom: 3px double;">ราคารวม: <?php echo $total; ?></span> <br> <br>
    <hr>
    
    <a class="btn btn-success" href="confirm_evidence.php?status=ok&id=<?php echo $data['id']; ?>">อนุมัติการชำระเงิน</a>
        <a class="btn btn-warning" href="confirm_evidence.php?status=no&id=<?php echo $data['id']; ?>">ไม่ผ่านการอนุมัติ</a>
        <h3>หลักฐานการโอน</h3>
        <?php foreach($image as $key=>$value) { ?>
        <img src="<?php echo $value['image'] ?>" alt="" width=50% height=50%><br>
        <?php } ?>
        
    </div>
</body>
</html>