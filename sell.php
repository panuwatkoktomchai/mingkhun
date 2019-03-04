<meta charset="UTF-8">
<?php include 'navbar-employee.php';?>
<head>
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

  	
	<title>เพิ่มสินค้า</title>
</head>
<style>
</style>
<body>

<?php
    session_start();
    error_reporting(0);
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $data;
    // เมื่อแสกน  รหัสสินค้า
    if(isset($_POST['id']))
    {
        $sql = "select * from products where id = ".$_POST['id'];
        $res = $conn->query($sql);
        $data = $res->fetch_assoc();
        if($res->num_rows > 0) // ถ้ามีข้อมูล
        {
            if (isset($_SESSION['list'][$_POST['id']])) {
                $_SESSION['list'][$_POST['id']]['amount']+= $_POST['amount'];
            }else{
                
                $data['amount'] = $_POST['amount'];
                $_SESSION['list'][$_POST['id']] = $data;
            }
            
            // ไส่ค่าไว้สำหรับแสดงรายละเดียดสินค้า
            $_SESSION['show'] = $_SESSION['list'][$_POST['id']];
            header("Location:sell.php");
        }else{ // ถ้าไม่มีข้อมูล
            echo "<h2 style='color:red'> ไม่มีข้อมูล </h2>";
        }
        
    }

    if(isset($_GET['up'])){
        $_SESSION['list'][$_GET['up']]['amount']++;  
        checkAmount($_GET['up']);
    }

    if(isset($_GET['down'])){
        $_SESSION['list'][$_GET['down']]['amount']--;  
        checkAmount($_GET['down']);
    }


    if (isset($_GET['delete'])) {
        unset($_SESSION['list'][$_GET['delete']]);
        print_r($_GET['id']);
        header('Location:sell.php');
    }

    function checkAmount($id)
    {
        echo $id;
        if ($_SESSION['list'][$id]['amount'] == 0) {
            unset($_SESSION['list'][$id]);
            header("Location:sell.php");
        }
    }
?>

<div class="container">
<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>ขายสินค้า</span> </h1>
        <hr>

<form  class="form-horizontal" action="" method="post">  
<div class="form-group">
<label class="control-label col-sm-2">รหัสสินค้า<span class="text-danger">*</span> </label>
    <div class="col-md-3 col-sm-6">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
            <input required autofocus class="form-control" name="id" type="number">
        </div>
    </div>
</div>

<div class="form-group">
<label class="control-label col-sm-2">จำนวน<span class="text-danger">*</span> </label>
    <div class="col-md-3 col-sm-6">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tags"></i></span>
            <input class="form-control" required  type="number" name="amount" value="1" >
        </div>
    </div>
</div>


<div class="form-group">
    <div class="col-xs-offset-2 col-sm-6">
        <input class="btn btn-primary"  type="submit" value="แสกน">
</div>


<div class="form-group">
    <div class="col-md-3 col-sm-6">
    <?php $show = $_SESSION['show']; ?>
รหัส : <?php echo $show['id'] ?> <br>
ชื่อสินค้า : <?php echo $show['name'] ?> <br>
ราคาต่อหน่วย : <?php echo $show['price'] ?> <br>

<img src="<?php echo $show['photo'] ?>" width="100px" alt="">
    </div>
</div>


</form>

<hr>

<?php $show = $_SESSION['show']; ?>
รหัส : <?php echo $show['id'] ?> <br>
ชื่อสินค้า : <?php echo $show['name'] ?> <br>
ราคาต่อหน่วย : <?php echo $show['price'] ?> <br>

<img src="<?php echo $show['photo'] ?>" width="100px" alt="">

<hr>
<h1>รายการสินค้า</h1>
<table>
    <thead>
        <tr>
            <td>ลำดับ</td>
            <td>รหัสสินค้า</td>
            <td>ชื่อสินค้า</td>
            <td>ราคา</td>
            <td>จำนวน</td>
            <td>ราคา</td>
            <td>จัดการ</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i =1;
        foreach($_SESSION['list'] as $key=>$value) { 
            ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $value['id'] ?></td>
            <td><?php echo $value['name'] ?></td>
            <td><?php echo $value['price'] ?></td>
            <td><?php echo $value['amount'] ?></td>
            <td><?php echo number_format($value['amount'] * $value['price'],2) ?></td>
            <td><a href="sell.php?delete=<?php echo $key ?>">ยกเลิกรายการ</a></td>
            <td><a href="sell.php?up=<?php echo $key ?>">เพิ่ม</a></td>
            <td><a href="sell.php?down=<?php echo $key ?>">ลด</a></td>
        </tr>
        <?php } $i++;?>
    </tbody>
</table>
<hr>
<h3>คำนวน</h3>
<?php 
$product;
$price;
foreach ($_SESSION['list'] as $key => $value) {
    $product = $product+$value['amount'];
    $price = $price+($value['price'] * $value['amount']);
}
?>
จำนวนรายการ : <?php echo count($_SESSION['list']) ?> <br>
จำนวนสินค้าทั้งหมด : <?php echo $product ?><br>
ราคารวมสุทธิ : <?php echo number_format($price,2); ?><br>

<?php 
$_SESSION['amount'] = $product;
$_SESSION['total'] = $price;

if (!isset($_SESSION['id'])) {
    header('Location:index.php');
}
?>

<a href="save_sell.php">บันทึกรายการขาย</a>


