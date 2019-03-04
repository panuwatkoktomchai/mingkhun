<!doctype html>
<html lang="en" class="no-js">
<?php include 'navbar-employee.php';?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

	<title>รายละเอียด</title>
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
<?php }
 unset($_SESSION['alert']);
?>
<!-- end alert -->

<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>รายละเอียดการรับสินค้า </span> </h1>
		<h4 class="entry-title" ><span>รหัสรับสินค้า : <?php echo $_REQUEST['id'] ?></span> </h4>
        <hr>
    
	
		<?php
  /**
   * select ข้อมูลประวัติการรับสินค้า
   */
	include "db.php";
  	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_query($conn, "SET NAMES UTF8");
	$sql = "select * from check_in_products join users on check_in_products.user_id = users.id where order_id = ".$_REQUEST['id'];
	$data = $conn->query($sql);
	$total_price = 0;
	// print_r($data);
  ?>
	


<table class="table">
    <thead class="thead-light">
		<tr>
			<th>ลำดับ</th>
			<th>รหัสสินค้า</th>
			<th>ชื่อสินค้า</th>
			<th>ราคารับ</th>
			<th>จำนวนรับ</th>
			<th>ตัวแทนจำหน่าย</th>
			<th>รับโดย</th>
			<th>วันที่</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $key=>$value) { ?>
			<tr>
			<?php $sql = "select * from products where id = ".$value['product_id'];
				$product = $conn->query($sql);
				$product = $product->fetch_assoc(); 
				$sql_seller = "select * from seller where id = ".$value['seller_id'];
				$seller = $conn->query($sql_seller);
				$seller = $seller->fetch_assoc();
				$total_price += (int)$value['get_price'] * (int)$value['amount'];
				?>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $product['id'] ?></td>
			<td><?php echo $product['name'] ?></td>
			<td><?php echo $value['get_price'] ?></td> 
			<td><?php echo $value['amount'] ?></td>
			<td><?php echo $seller['name'] ?></td>
			<td><?php echo $value['fullname'] ?></td>
			<td><?php echo $value['date'] ?></td>

		<?php } ?>
	</tbody>
</table>
<div>
	<h3 style="color:red">ราคารับสุทธิ : <b><?php echo $total_price; ?> ฿</b></h3>
	
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );
</script>
<!-- <script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> Resource jQuery -->
</body>
</html>
