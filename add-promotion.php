<meta charset="UTF-8">
<?php include 'navbar-employee.php';?>
<title>จัดการข้อมูลโปรโมชั่น</title>
<head>
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<?php 
include "db.php";
error_reporting(0);
$conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_query($conn, "SET NAMES UTF8");
session_start();
if (!isset($_SESSION['id'])) {
    Header('Location:index.php');
}else {
    if (isset($_REQUEST['edit'])) {
        $sql = "select * from promotion where id = ".$_REQUEST['edit']; 
        $data = $conn->query($sql);
        $data = $data->fetch_assoc();
    }
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
?>
<!-- end alert -->

<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>เพิ่ม / แก้ไขข้อมูลโปรโมชั่น</span> </h1>
        <hr>
      
<form class="form-horizontal" action="<?php if(isset($_REQUEST['edit'])){ echo "update-promotion.php"; }else{ echo "insert-promotion.php"; } ?>" method="post" enctype="multipart/form-data">
    
<div class="form-group">
<label class="control-label col-sm-2">รหัสโปรโมชั่น<span class="text-danger">*</span> </label>
    <div class="col-md-5 col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
            <input required <?php if(isset($_REQUEST['edit'])){ echo "readonly" ; } ?> class="form-control" hidden  type="text" value="<?php echo $data['id'] ?>" name="id" placeholder="Promotion ID" minlength="5" maxlength="5" onKeyUp="if(isNaN(this.value)){ this.value='';}">
        </div>
    </div>
</div>
<div class="form-group">    
<label class="control-label col-sm-2">ชื่อโปรโมชั่น<span class="text-danger">*</span> </label>
    <div class="col-md-5 col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="	glyphicon glyphicon-edit"></i></span>
            <input class="form-control" required type="text" value="<?php echo $data['name'] ?>" name="name" placeholder="Promotion name">
        </div>
    </div>
</div>
<div class="form-group">
          <label class="control-label col-sm-2">รายละเอียด<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          <textarea required class="form-control" rows="3" name="detail"><?php echo $data['detail'] ?></textarea>
          </div>
        </div>

<div class="form-group">    
<label class="control-label col-sm-2">ส่วนลด<span class="text-danger">*</span> </label>
    <div class="col-md-5 col-sm-8">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
            <input class="form-control" required type="number" value="<?php echo $data['discount'] ?>" name="discount" placeholder="Discount">
        </div>
    </div>
</div>

        <div class="form-group">
          <div class="col-xs-offset-2 col-sm-8">

          <?php if(isset($_REQUEST['edit'])==true){ ?>

          <input type="submit" value="อัพเดท" class="btn btn-warning">
          <a class="btn btn-danger" href="?">ยกเลิก</a>

          <?php }else{ ?>

          <button type="submit" class="btn btn-primary" >บันทึก</button>
          <?php } ?>
        </div>

 </form>   
 <br><br><br>

<?php
$sql = "select * from promotion;";
$seller = $conn->query($sql);
?>

<section>      
        <h1 class="entry-title"><span>ข้อมูลโปรโมชั่น</span> </h1>
        <hr>
	
<table id="datable" class="display table">
    <thead class="thead-light">
        <tr>
            <td>ลำดับ</td>
            <td>รหัสโปรโมชั่น</td>
            <td>ชื่อโปรโมชั่น</td>
            <td>รายละเอียด</td>
            <td>ส่วนลด</td>
            <td>จัดการ</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($seller as $key=>$value){ ?>
        <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $value['id'] ?> </td> <!--แก้รหัสตัวแทน พิมเอง 5 หลัก-->
            <td><?php echo $value['name'] ?></td>
            <td><?php echo $value['detail'] ?></td>
            <td><?php echo $value['discount'] ?></td>
            <td>
                <a class="btn btn-success" href="?edit=<?php echo $value['id'] ?>">แก้ไข</a>
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
                            <a class="btn btn-danger" href="delete.php?table=promotion&id=<?php echo $value['id'] ?>&p=add-promotion.php">ลบ</a></td>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal -->
            
        </tr>
        <?php } ?>
    </tbody>
</table> 

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );
</script>