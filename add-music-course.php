<?php
error_reporting(0);
session_start();
include "db.php";
if (isset($_REQUEST['delete'])) {
  $sql = "DELETE FROM music_course WHERE id = ".$_REQUEST['delete'];
  $conn->query($sql);
  // $get_file = "select `file_path` from music_course_file where music_course_id = ".$_REQUEST['delete'];
  // $file = $conn->query($get_file);
  // foreach ($file as $key => $value) {
  //   unlink($value['file_path']);
  // }
  $_SESSION['alert']['status'] = "success";
  $_SESSION['alert']['message'] = "ลบข้อมูลสำเร็จ";
  header('Location:add-music-course.php');
  exit;
}
$sql = "SELECT * FROM `course`";
$obj = $conn->query($sql);
$data = [];
if (isset($_REQUEST['id'])) {
  $sql = "select * from music_course where id = ".$_REQUEST['id'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  mysqli_query($conn, "SET NAMES UTF8");
  $data = $conn->query($sql);
  $data = $data->fetch_assoc();
}
?>
<meta charset="UTF-8">
<?php include 'navbar-teacher.php';?> 
<?php
include "db.php";
if(empty($_SESSION['id'])){
  $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id'].";";
    header('Location:login.php'); 
}
?>
<head>
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title>เพิ่ม / จัดการข้อมูลคอร์สสอนดนตรี</title>
</head>
<body>

<style>

body{
 background-color: #fff ;
}

</style>

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
  }, 6000);
</script>
<?php }
 unset($_SESSION['alert']);
?>
<!-- end alert -->

<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>จัดตารางสอนดนตรี</span> <br><h4>อาจารย์ : <?php echo $_SESSION['fullname'] ?></h4></span> </h1>
        <hr>
       

        <?php if(isset($_REQUEST['id'])){ ?>
    <form class="form-horizontal" action="update-music-course.php?p=add-music-course.php&id=<?php echo $_REQUEST['id']; ?>" method="POST" enctype="multipart/form-data" >  
        <?php }else{ ?>
    <form class="form-horizontal" action="insert-music-course.php?p=add-music-course.php" method="POST" enctype="multipart/form-data">  
        <?php } ?>
       
        
        <div class="form-group">
          <label class="control-label col-sm-2">วิชา<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                
                <select required name="course" id="" class="form-control">
                <option value = "" selected disabled>กรุณาเลือกวิชาที่สอน</option>
                  <?php foreach ($obj as $key=>$value) { ?>
                    <option <?php if($value['id']==$data['course_id']){ echo "selected"; } ?> value="<?php echo $value['id'] ?>" > <?php echo $value['c_name'] ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">วันที่สอน<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select name = "date_course" class="form-control">
                  <option <?php echo $date = $data['date_course']=="1" ? "selected" : '' ?> value="1">จันทร์</option>
                  <option <?php echo $date = $data['date_course']=="2" ? "selected" : '' ?> value="2">อังคาร</option>
                  <option <?php echo $date = $data['date_course']=="3" ? "selected" : '' ?> value="3">พุธ</option>
                  <option <?php echo $date = $data['date_course']=="4" ? "selected" : '' ?> value="4">พฤหัส</option>
                  <option <?php echo $date = $data['date_course']=="5" ? "selected" : '' ?> value="5">ศุกร์</option>
                  <option <?php echo $date = $data['date_course']=="6" ? "selected" : '' ?> value="5">เสาร์</option>
                  <option <?php echo $date = $data['date_course']=="7" ? "selected" : '' ?> value="7">อาทิตย์</option>
                </select>
                </div>
            </div>
          </div>
        </div>


        <div class="form-group">
          <label class="control-label col-sm-2">เวลาที่สอน<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select name="time_course" class="form-control">
                  <option <?php echo $date = $data['time_course']=="09.00 - 10.00" ? "selected" : '' ?> value="09.00 - 10.00">09.00 - 10.00</option>
                  <option <?php echo $date = $data['time_course']=="10.00 - 11.00" ? "selected" : '' ?> value="10.00 - 11.00">10.00 - 11.00</option>
                  <option <?php echo $date = $data['time_course']=="11.00 - 12.00" ? "selected" : '' ?> value="11.00 - 12.00">11.00 - 12.00</option>
                  <option <?php echo $date = $data['time_course']=="12.00 - 13.00" ? "selected" : '' ?> value="12.00 - 13.00">12.00 - 13.00</option>
                  <option <?php echo $date = $data['time_course']=="13.00 - 14.00" ? "selected" : '' ?> value="13.00 - 14.00">13.00 - 14.00</option>
                  <option <?php echo $date = $data['time_course']=="14.00 - 15.00" ? "selected" : '' ?> value="14.00 - 15.00">14.00 - 15.00</option>
                  <option <?php echo $date = $data['time_course']=="15.00 - 16.00" ? "selected" : '' ?> value="15.00 - 16.00">15.00 - 16.00</option>
                  <option <?php echo $date = $data['time_course']=="16.00 - 17.00" ? "selected" : '' ?> value="16.00 - 17.00">16.00 - 17.00</option>
                  <option <?php echo $date = $data['time_course']=="17.00 - 18.00" ? "selected" : '' ?> value="17.00 - 18.00">17.00 - 18.00</option>
                  <option <?php echo $date = $data['time_course']=="18.00 - 19.00" ? "selected" : '' ?> value="18.00 - 19.00">18.00 - 19.00</option>
                  <option <?php echo $date = $data['time_course']=="19.00 - 20.00" ? "selected" : '' ?> value="19.00 - 20.00">19.00 - 20.00</option>
                </select>
                </div>
            </div>
          </div>
        </div>
<br><br>


        <div class="form-group">
          <div class="col-xs-offset-2 col-sm-8">

          <?php if(isset($_REQUEST['id'])==true){ ?>

          <input type="submit" value="อัพเดท" class="btn btn-warning">
          <a class="btn btn-danger" href="?">ยกเลิก</a>

          <?php }else{ ?>

          <button type="submit" class="btn btn-primary" >บันทึก</button>
          <?php } ?>
        </div>
</form>

<br><br><br>


<?php

$get = "select music_course.* ,course.c_name as c_name from music_course 
left join course on music_course.course_id = course.id 
where user = ".$_SESSION['id']. " order by music_course.date_course";
// echo $get;  
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$data = $conn->query($get);
$day = ['จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์']
?>


<!--------------------------------------------------------------------------tableที่จะเปลี่ยน-->

<section>      
        <h1 class="entry-title"><span>ข้อมูลตารางสอน</span> </h1>
        <h4>ผู้ใช้งาน : <?php echo $_SESSION['fullname'] ?></h4>
        <hr>
	
<table id = "datable" class="display table">
    <thead class="thead-light">
      <tr>
        <th>รหัสคอร์ส</th>
        <th>ชื่อวิชา</th>
        <th>วัน</th>
        <th>เวลา</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody> 
        <?php
        foreach ($data as $key => $value) {
        ?>
            <tr>
            <td><?php echo $value['id']?></td>
            <td><?php echo $value['c_name']?></td>
            <td><?php echo $day[$value['date_course']-1]?></td>
            <td><?php echo $value['time_course']?></td>
            <td>
                <a href="add-music-course.php?id=<?php echo $value['id']?>" class="btn btn-success">แก้ไข</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $value['id'] ?>">ลบ</button>
            </td>
            <!-- Modal -->
            <div class="modal fade" id="<?php echo $value['id'] ?>" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ยืนยันการลบ</h4>
                  </div>
                  <div class="modal-body">
                    <p>ต้องการลบข้อมูลหรือไม่.</p>
                  </div>
                  <div class="modal-footer">
                    <a href="?delete=<?php echo $value['id']?>" class="btn btn-danger">ลบ</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Modal -->
            </tr>
     
        <?php
        }
        ?>
    </tbody>
  </table>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );

$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});  
</script>

<!-- <script src="js/jquery-2.1.4.js"></script> -->
<!-- <script src="js/jquery.menu-aim.js"></script> -->
<!-- <script src="js/main.js"></script> Resource jQuery -->
</body>
</html>