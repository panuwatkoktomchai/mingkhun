
<?php
    session_start();
    error_reporting(0);
    include "db.php";

    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");

    // check exists
    if (isset($_SESSION['getpro'][$_REQUEST['product_id']['product_id']])) {

        $_SESSION['alert']['status'] = "danger";
        $_SESSION['alert']['message'] = "สินค้านี้มีอยูในรายการอยู่แล้ว";
        echo "<script> history.go(-1); </script>";
        exit();
    }

    if (isset($_REQUEST['product_id'])) {
        $sql = "select * from products where id = ".$_REQUEST['product_id'];
        $data = $conn->query($sql);
        print_r($data);
        if ($data->num_rows < 1) {
            $_SESSION['alert'] = true;
            header('Location:get-product-detail.php');
            
        }else {
            $data = $data->fetch_assoc();
            $seller = "select name from seller where id = ".$_REQUEST['seller_id'];
            $seller = $conn->query($seller);
            $seller = $seller->fetch_assoc();

            $_SESSION['getpro'][$_REQUEST['product_id']]['product_id'] = $_REQUEST['product_id'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['get_price'] = $_REQUEST['get_price'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['amount'] = $_REQUEST['amount'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['price'] = $_REQUEST['get_price'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['user_id'] = $_REQUEST['user_id'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['seller_id'] = $_REQUEST['seller_id'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['photo'] = $data['photo'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['name'] = $data['name'];
            $_SESSION['getpro'][$_REQUEST['product_id']]['seller'] = $seller['name'];
            unset($data);
            unset($seller);
            unset($_REQUEST);
            header('Location:get-product-detail.php');
        }
        
        
    }
    if (isset($_REQUEST['cancle'])) {
        unset($_SESSION['getpro']);
    }
    if (isset($_REQUEST['clear'])) {
        unset($_SESSION['getpro'][$_REQUEST['clear']]);
    }
    if (isset($_REQUEST['plus'])) {
        // echo $_REQUEST['plus']."<br>";
        $_SESSION['getpro'][$_REQUEST['plus']]['amount']+=1 ;
    }
    if (isset($_REQUEST['minus'])) {
        $_SESSION['getpro'][$_REQUEST['minus']]['amount']-=1 ;
    }
?>

<!doctype html>
<html lang="en" class="no-js">
<?php include 'navbar-employee.php';?>
<title>รับสินค้า</title>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

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
  }, 5000);
</script>
<?php }
 unset($_SESSION['alert']);
?>
<!-- end alert -->

<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>รับสินค้า</span> </h1>
        <hr>

        <form class="form-horizontal" action="" mentod="post">
        <!-- <form class="form-horizontal" action="insert-get-product.php" mentod="post"> -->
        <div class="form-group">
          <label class="control-label col-sm-2"><span class="text-danger"><?php echo $data["name"] ?></span></label>
          <div class="col-md-5 col-sm-8">
        <!-- <img src="<?php //echo $data['photo'] ?>" alt="" width="250" height="250"><br><br> -->
        </div></div>
        <div class="form-group">
          <label class="control-label col-sm-2">รหัสสินค้า<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
        <input required class="form-control" type="text"  name="product_id" value="<?php echo $data["id"] ?>" placeholder="Product id" minlength="5" maxlength="5" onKeyUp="if(isNaN(this.value)){ this.value='';}"/>
	  </div></div></div>

    <div class="form-group">
          <label class="control-label col-sm-2">ราคารับต่อชิ้น<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input class="form-control" type="text"  name="get_price" required  value="" placeholder="" onKeyUp="if(isNaN(this.value)){ this.value='';}"/>
	  </div></div></div>      
	  
	  <div class="form-group">
          <label class="control-label col-sm-2">จำนวนรับสุทธิ<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-inbox"></i></span>
        <input class="form-control" type="text"  name="amount" required  value="" placeholder="" onKeyUp="if(isNaN(this.value)){ this.value='';}"/>
	  </div></div></div>
        
	  <!--<div class="form-group">
          <label class="control-label col-sm-2">รหัสพนักงานที่รับ<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
        <input class="form-control" type="text"  name="user_id" value="<?php echo $userid['user_id'] ?>" placeholder="employee id" readonly/>
      </div></div></div> -->
	  

        <?php 
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_query($conn, "SET NAMES UTF8");
            
            $sql = "select * from seller";
            $data = $conn->query($sql);
            ?>
        <div class="form-group">
          <label class="control-label col-sm-2">ตัวแทนจำหน่าย<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select required name="seller_id" id=""  class="form-control">
            <option value = "" selected disabled>กรุณาเลือกตัวแทนจำหน่าย</option>
            <?php foreach ($data as $key => $value) { ?>
                <option value="<?php echo $value['id'] ?>" > <?php echo $value['name'] ?> </option>
            <?php } ?>

                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10">
	  <button type="input"  class="btn btn-primary">เพิ่มข้อมูล </button>
	</div></div>
	
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>ลำดับ</th>
                <th>รูป</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th>ราคา</th>
                <th>ตัวแทนจำหน่าย</th>
                <th>จัดการ</th>
            </tr>
                
        </thead>
        <tbody>
                <?php 
                $i = 0;
                $totalPrice;
                foreach($_SESSION['getpro'] as $key=>$value) { 
                    $i++;
                    $totalPrice+=$value['price'] * $value['amount'];
                    ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td>
                        <img src="<?php echo $value['photo'] ?>" alt="" width="150px" height="150px">
                    </td>
                    <td><?php echo $value['product_id'] ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td> <a href="?minus=<?php echo $value['product_id'] ?>" class="btn btn-primary">-</a> <?php echo $value['amount'] ?> <a href="?plus=<?php echo $value['product_id']; ?>" class="btn btn-primary">+</a> </td>
                    <td><?php echo $value['price'] ?></td>
                    <td><?php echo $value['seller'] ?></td>
                    <td>
                        <a  class="btn btn-danger" href="?clear=<?php echo $value['product_id'] ?>" ><b>X</b></a>
                    </td>
                </tr>
                <?php  }?>
        </tbody>
    </table>

    จำนวนรายการรับ : <?php  echo $i; ?> <br>
    ราคารวม : <?php  echo $totalPrice; ?><br>
    <div style="float:right;">
    <a class="btn btn-primary" href="insert-get-product.php">บันทึก</a> 
    <a class="btn btn-danger" href="?cancle=true">ยกเลิก</a>
    </div>
    <br><br><br><br>
    
<?php // print_r($_SESSION['getpro']) ?>
	
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
<script>

    <?php if($_SESSION['alert']){ ?> 
        alert('ไม่มีข้อมูลรหัสสินค้าที่ระบุ');
    <?php } unset($_SESSION['alert']); ?>
</script>