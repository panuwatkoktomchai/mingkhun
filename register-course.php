<meta charset="UTF-8">
<?php include 'navbar-member.php';?>
<title>สมัครเรียน</title>

<!-- jQuery library -->
<script src="app/jquery.min.js"></script>
<!-- Popper JS -->
<script src="app/popper.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<?php
$user;
session_start();

if (isset($_SESSION['id'])) {
    $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id'].";";
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $res = $conn->query($sql);
    $user = $res->fetch_assoc();
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['username'] = $user['username'];
}else{
    // header('Location:index.php');
}
?>

<div class="container">

<!-- show alert -->
<br><br>
<?php if(isset($_SESSION['alert'])){ ?>
<div id="alert" class="alert alert-<?php echo$_SESSION['alert']['status'] ?> alert-dismissible">
  <a onclick="document.getElementById('alert').style.display='none'" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><?php echo $_SESSION['alert']['status'] ?>!</strong> <?php echo $_SESSION['alert']['message'] ?>
</div>
<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 3000);
</script>
<?php }
 unset($_SESSION['alert']);

 if (!isset($_REQUEST['id'])) {
  echo "<script> history.go(-1); </script>";
 }


?>
<!-- end alert -->

<div class="row">
    <div class="col-md-12">

<section>      
        <h1 class="entry-title"><span>เลือกวันเวลา <br><h4>ผู้ใช้งาน : <?php echo $_SESSION['fullname'] ?></h4></span> </h1>
        <hr>
<form action="member-add-course.php" method="post">
<table class="table display" id="datable">
    <thead class="thead-light">
      <tr>
        <th>ชื่อวิชา</th>
        <th>วัน</th>
        <th>เวลา</th>
        <th>...</th>
      </tr>
    </thead>
    <tbody>
        <?php
          $day = ['จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์'];

         $sql = "select music_course.*, course.c_name from music_course left join course on music_course.course_id = course.id where course_id = ".$_REQUEST['id']." order by music_course.date_course";
         $course = $conn->query($sql);
        foreach ($course as $key => $value) {
            
        ?>
            <tr>
                <td><?php echo $value['c_name'] ?></td>
                <td><?php echo $day[$value['date_course']-1] ?></td>
                <td><?php echo $value['time_course'] ?></td>
                <td>
                  <input type="radio" required name="course" value="<?php echo $value['id'] ?>"> เลือก
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
  </table>
  <input type="submit" value="ยืนยัน">
  </form>