<?php error_reporting(0) ?>
<meta charset="UTF-8">
<?php include 'navbar-employee.php';?>
<?php 
    session_start();
    include "db.php";
    if(empty($_SESSION['id'])){
        header('Location:login.php');
    }

    if (isset($_REQUEST['cate_name'])) {
        
        if (isset($_REQUEST['update_id'])) {
            $update = "update category_product set cate_name = '".$_REQUEST['cate_name']."' where cate_id = ".$_REQUEST['update_id'];
            // echo("<script> alert('อัพเดทข้อมูลสำเร็จ'); window.location='Add_category_product.php';</script>");
            $conn->query($update);
            $_SESSION['alert']['status'] = "success";
            $_SESSION['alert']['message'] = "อัพเดทข้อมูลสำเร็จ";
            unset($_REQUEST);
            header('Location:Add_category_product.php');
            
        }else{
            $sql = "insert into category_product values(null, '".$_REQUEST['cate_name']."', ".$_SESSION['id'].", '".date('Y-m-d')."')";
          
            // echo("<script> alert('เพิ่มข้อมูลสำเร็จ'); window.location='Add_category_product.php';</script>");
            if ($conn->query($sql)) {
                $_SESSION['alert']['status'] = "success";
                $_SESSION['alert']['message'] = "เพิ่มข้อมูลสำเร็จ";
                unset($_REQUEST);
                header('Location:Add_category_product.php');
            }else {
                $_SESSION['alert']['status'] = "danger";
                $_SESSION['alert']['message'] = "Error! ".$conn->error;
                unset($_REQUEST);
                header('Location:Add_category_product.php');
            }
           
        }
    }

    if (isset($_REQUEST['delete'])) {
        $check = "select * from products where category = ".$_REQUEST['delete'];
        $res = $conn->query($check);
        if ($res->num_rows > 0) {
            $_SESSION['alert']['status'] = "danger";
            $_SESSION['alert']['message'] = "ข้อมูลรายการนี้ถูกใช้งานอยู่ ไม่สามารถลบได้";
        }else {
            $sql = "DELETE FROM category_product WHERE cate_id = ".$_REQUEST['delete'];
            $conn->query($sql);
            $_SESSION['alert']['status'] = "success";
            $_SESSION['alert']['message'] = "ลบข้อมูลสำเร็จ";
        }
        
        // echo("<script> alert('ลบข้อมูลสำเร็จ'); window.location='Add_category_product.php';</script>");
    } 
    $get = "select category_product.*, users.fullname as user from category_product left join users on category_product.user_id = users.id";
    $res = $conn->query($get);
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

  	
	<title>เพิ่ม / จัดการข้อมูลประเภทสินค้า</title>
</head>
<body>
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
        <h1 class="entry-title"><span>เพิ่มประเภทสินค้า</span> </h1>
        <hr>

<form class="form-horizontal" action="" method="post">
<?php if($_REQUEST['edit']){ ?>
    <input type="text" name="update_id" value="<?php echo $_REQUEST['e_id'] ?>" hidden>
    <?php } ?>

    <input type="hidden" name="id" value="<?php echo $edit['cate_id'] ?>" >   <!-- AUTO ID -->

    
    <div class="form-group">
          <label class="control-label col-sm-2">ชื่อประเภทสินค้า<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
        <input required class="form-control" type="text" name="cate_name" value="<?php echo $_REQUEST['cat'] ?>">
    </div></div></div>

       <div class="form-group">
          <div class="col-xs-offset-2 col-sm-8">

          <?php if(isset($_REQUEST['edit'])==true){ ?>

          <input type="submit" value="อัพเดท" class="btn btn-warning">
          <a class="btn btn-danger" href="?">ยกเลิก</a>

          <?php }else{ ?>

          <button type="submit" class="btn btn-primary" >บันทึก</button>
          <?php } ?>
        </div>
        </div></div>

</form>

<br><br><br>

<section>      
        <h1 class="entry-title"><span>ข้อมูลประเภทสินค้า</span> </h1>
        <hr>

<table id = "datable" class="display table">
    <thead class="thead-light">
        <tr>
            <td>ลำดับ</td>
            <td>รหัสประเภท</td>
            <td>ชื่อประเภท</td>
            <td>เพิ่มโดย</td>
            <td>วันที่สร้าง</td>
            <td>จัดการ</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($res as $key=>$value){
            
            ?>
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $value['cate_id'] ?></td>
                <td><?php echo $value['cate_name'] ?></td>
                <td><?php echo $value['user'] ?></td>
                <td><?php echo $value['create'] ?></td>
                <td>
                <a class="btn btn-success" href="?edit=true&e_id=<?php echo $value['cate_id'] ?>&cat=<?php echo $value['cate_name'] ?>&cate_id=<?php echo $value['cate_id'] ?>" >แก้ไข</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $value['cate_id'] ?>">ลบ</button>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="<?php echo $value['cate_id'] ?>" role="dialog">
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
                            <a class="btn btn-danger" href="?delete=<?php echo $value['cate_id']; ?>" >ลบ</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal -->
            </tr>
        <?php  }?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );
</script>