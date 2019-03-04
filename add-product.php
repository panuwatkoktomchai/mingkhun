<?php
// error_reporting(0);
session_start();
include "db.php";
$sql = "SELECT * FROM `category_product`";
$obj = $conn->query($sql);
$data = [];
if (isset($_REQUEST['id'])) {
  $sql = "select * from products where id = ".$_REQUEST['id'];
  $conn = new mysqli($servername, $username, $password, $dbname);
  mysqli_query($conn, "SET NAMES UTF8");
  $data = $conn->query($sql);
  $data = $data->fetch_assoc();
}
?>
<meta charset="UTF-8">
<?php include 'navbar-employee.php';?>
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
	<title>เพิ่ม / จัดการข้อมูลสินค้า</title>
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
  }, 3000);
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

if (isset($_REQUEST['delete'])) {
        $sql = "DELETE FROM products WHERE id = ".$_REQUEST['delete'];
        $conn->query($sql);
        echo("<script> alert('ลบข้อมูลสำเร็จ'); window.location='add-product.php';</script>");
    }
    $get = "select * from products";
    $res = $conn->query($get);
?>
<!-- end alert -->
<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>เพิ่มสินค้า</span> </h1>
        <hr>
       

        <?php if(isset($_REQUEST['id'])){ ?>
    <form class="form-horizontal" action="update.php?p=add-product.php&table=products" method="POST" enctype="multipart/form-data" >  
        <?php }else{ ?>
    <form class="form-horizontal" action="insert-product.php?p=add-product.php" method="POST" enctype="multipart/form-data">  
        <?php } ?>
      
        <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>" >   <!-- AUTO ID -->

        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อสินค้า<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
            <input required class="form-control"  name="name" value="<?php echo $data['name']  ?>" type="text" placeholder="Product name">
          </div>
        </div></div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">ประเภท<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                
                <select required name="category" id="" class="form-control">
                <option value = "" selected disabled>กรุณาเลือกประเภทสินค้า</option>
                  <?php foreach ($obj as $key=>$value) { ?>
                    <option <?php if($value['cate_id']==$data['category']){ echo "selected"; } ?> value="<?php echo $value['cate_id'] ?>" > <?php echo $value['cate_name'] ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </div>

        
        <!-- <div class="form-group">
          <label class="control-label col-sm-2">ราคาต่อหน่วย<span class="text-danger"></span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
            <input required class="form-control" name="price" value="<?php echo $data['price']  ?>" type="number" placeholder="Price" >
          </div>
        </div></div> -->

           <div class="form-group">
          <label class="control-label col-sm-2">จำนวนสินค้าคงเหลือ<span class="text-danger"></span> </label>
          <div class="col-md-5 col-sm-8"> 
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-inbox"></i></span>
            <input required  class="form-control" name="unit" value="<?php echo $data['unit']  ?>" type="number" placeholder="Unit">
          </div>
        </div></div>
        
        <div class="form-group"> 
          <label class="control-label col-sm-2">อัพโหลดรูปภาพ</label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input  type="file" name="filUpload" id="file_nm" class="form-control upload" placeholder="">
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
        </div></div>
</form>

<br><br><br>


<?php

$get = "select products.* , category_product.cate_name from products 
        left join category_product on products.category = category_product.cate_id";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$data = $conn->query($get);
?>


<!--------------------------------------------------------------------------tableที่จะเปลี่ยน-->

<section>      
        <h1 class="entry-title"><span>ข้อมูลสินค้า</span> </h1>
        <hr>
	
<table id = "datable" class="display table">
    <thead class="thead-light">
      <tr>
        <th>รหัส</th>
        <th>ชื่อสินค้า</th>
				<th>ประเภทสินค้า</th>
        <!--<th>ราคาต่อหน่วย</th>-->
        <th>จำนวนคงเหลือ</th>
        <th>รายละเอียด</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody> 
        <?php
        foreach ($data as $key => $value) {
        ?>
            <tr>
            <td><?php echo $value['id']?></td>
            <td><?php echo $value['name']?></td>
                <td><?php echo $value['cate_name']?></td>
                <!--<td><?php echo $value['price']?></td>-->
                <td><?php echo $value['unit']?></td>
                <td><img src="<?php echo $value['photo'] ?>" width="150px" height="150px"></td>
                <td>
                    <a href="add-product.php?id=<?php echo $value['id']?>" class="btn btn-success">แก้ไข</a>
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
                              <a href="delete.php?id=<?php echo $value['id']?>&table=products&p=add-product.php" class="btn btn-danger">ลบ</a>
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