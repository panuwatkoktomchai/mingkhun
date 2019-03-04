
<?php
    include "navbar-member.php";
    include "db.php";
    session_start();
    $sql = "select * from member_addcourse where payment = 0 and id = ".$_GET['id'];
    $data = $conn->query($sql);
    $data = $data->fetch_assoc();

    $image = "select * from submit_evidence where user_id = ".$_SESSION['id']." and course_id = ".$_GET['id'];
    $image = $conn->query($image);
?>

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
        <h3>รหัสสมัครเรียนดนตรี : <?php echo $data['id'];  ?></h3>
        <form action="save_evidance.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
            <label for="">รูปภาพหลักฐานการโอนเงิน</label>
            <input class="form-control" type="file" name="filUpload">
            <br><br>
            <input class="btn btn-primary" type="submit" value="ส่งหลักฐาน">
        </form>
        <h2>ประวัติการส่งหลักฐานการโอนเงิน </h2>
        <?php foreach($image as $key=>$value) { ?>
        <img src="<?php echo $value['image'] ?>" alt=""><br>
        <?php } ?>
    </div>
</body>
</html>