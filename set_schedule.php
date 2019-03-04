<?php
// error_reporting(0);
session_start();
include "db.php";
$sql = "SELECT * FROM `music_course` where active = 0";

$obj = $conn->query($sql);
$data = [];
if (isset($_REQUEST['id'])) {
  $sql = "select schedule.*, music_course.name from schedule
  left join music_course on music_course.id = course_id where schedule.id = '".$_REQUEST['id']."'";
  $conn = new mysqli($servername, $username, $password, $dbname);
  mysqli_query($conn, "SET NAMES UTF8");
  $data = $conn->query($sql);
  $data = $data->fetch_assoc();
}
?>
<meta charset="UTF-8">
<?php include 'navbar-teacher.php';?> 
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
	<title>เพิ่ม / จัดตารางสอน</title>
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


<?php
session_start();
include "db.php";
if(empty($_SESSION['id'])){
    header('Location:login.php'); 
}

?>


<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>จัดตารางสอน</span> </h1>
        <label for="">ชื่ออาจารย์</label>
        <?php echo $_SESSION['fullname']; ?>
        <hr>
       

<?php if(isset($_REQUEST['id'])){ ?>
    <form class="form-horizontal" action="update-schedule.php?p=set_schedule.php" method="POST" enctype="multipart/form-data" >  
<?php }else{ ?>
    <form class="form-horizontal" action="insert-schedule.php?p=set_schedule.php" method="POST" enctype="multipart/form-data">  
<?php } ?>
        

        <?php if(!isset($_REQUEST['id'])){ ?>
        <div class="form-group">
          <label class="control-label col-sm-2">เลือกคอร์ส<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                
                <select required name="course_id" id="" class="form-control">
                <option value = "" selected disabled>กรุณาเลือกคอร์ส</option>
                  <?php foreach ($obj as $key=>$value) { ?>
                    <option <?php if($value['id']==$data['course_id']){ echo "selected"; } ?> value="<?php echo $value['id'] ?>" > <?php echo $value['name'] ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <?php }else{ ?>
        <div class="form-group">
            <label class="control-label col-sm-2">คอร์สสอน<span class="text-danger"></span> </label>
            <div class="col-md-5 col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input required class="form-control" readonly value="<?php echo $data['name']  ?>" type="text"  >
                    <input required class="form-control" name="id" value="<?php echo $data['id']  ?>" type="hidden"  >
                </div>
            </div>
        </div>
        <?php } ?>
        
        <div class="form-group">
            <label class="control-label col-sm-2">วันที่สอน<span class="text-danger"></span> </label>
            <div class="col-md-5 col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input required class="form-control" name="date_teach" value="<?php echo $data['date_teach']  ?>" type="date"  >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">เริ่มสอนเวลา<span class="text-danger"></span> </label>
            <div class="col-md-5 col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input required class="form-control" name="start_time" value="<?php echo $data['start_time']  ?>" type="time"  >
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2">สิ้นสุดเวลา<span class="text-danger"></span> </label>
            <div class="col-md-5 col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                    <input required class="form-control" name="end_time" value="<?php echo $data['end_time']  ?>" type="time"  >
                </div>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">เลือกห้อง<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                
                <select required name="room_id" id="" class="form-control">
                <option value = "" selected disabled>กรุณาเลือกห้อง</option>
                  <?php
                  $getRoom = "select * from rooms";
                  $res = $conn->query($getRoom);
                  foreach ($res as $key=>$value) { ?>
                    <option <?php if($value['id']==$data['room_id']){ echo "selected"; } ?> value="<?php echo $value['id'] ?>" > <?php echo $value['name'] ?> </option>
                  <?php } ?>
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

$get = "select schedule.*, users.fullname as user_name, music_course.name, music_course.id as cid, rooms.name as rooomname from schedule
left join users on users.id = teacher_id
left join music_course on music_course.id = course_id
left join rooms on rooms.id = room_id";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$data = $conn->query($get);
?>


<!--------------------------------------------------------------------------tableที่จะเปลี่ยน-->

<section>      
        <h1 class="entry-title"><span>ข้อมูลตารางสอน</span> </h1>
        <hr>
	
<table id = "datable" class="display table">
    <thead class="thead-light">
      <tr>
        <th>รหัสคอร์ส</th>
        <th>ชื่อคอร์ส</th>
        <th>ผู้สอน</th>
        <th>ห้องเรียน</th>
        <th>วันที่สอน</th>
        <th>เริ่มสอนเวลา</th>
        <th>สิ้นสุดเวลา</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody> 
        <?php
        foreach ($data as $key => $value) {
        ?>
            <tr>
            <td><?php echo $value['cid']?></td>
            <td><?php echo $value['name']?></td>
            <td><?php echo $value['user_name']?></td>
            <td><?php echo $value['rooomname']?></td>
            <td><?php echo $value['date_teach']?></td>
            <td><?php echo $value['start_time']?></td>
            <td><?php echo $value['end_time']?></td>
            <td>
                <a href="set_schedule.php?id=<?php echo $value['id']?>" class="btn btn-success">แก้ไข</a>
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
                    <a href="delete.php?id=<?php echo $value['id']?>&table=schedule&p=set_schedule.php&setid=<?php echo $value['course_id'] ?>" class="btn btn-danger">ลบ</a>
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
</script>

<!-- <script src="js/jquery-2.1.4.js"></script> -->
<!-- <script src="js/jquery.menu-aim.js"></script> -->
<!-- <script src="js/main.js"></script> Resource jQuery -->
</body>
</html>