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

	<title>รับสินค้า</title>
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
        <h1 class="entry-title"><span>รับสินค้า</span> </h1>
        <hr>
      
    
	      <a href="get-product-detail.php" class="btn btn-primary">ค้นหาสินค้า +</a>
      </div>
  </div>

	
  <?php
  /**
   * select ข้อมูลประวัติการรับสินค้า
   */
	include "db.php";
  	$conn = new mysqli($servername, $username, $password, $dbname);
	 mysqli_query($conn, "SET NAMES UTF8");
	$sql = "select check_in_order.*, users.fullname from check_in_order left join users on check_in_order.user_id = users.id";
	$data = $conn->query($sql);
	// print_r($data);
  ?>
	
<br><br>
<section>      
        <h1 class="entry-title"><span>ประวัติการรับสินค้า</span> </h1>
        <hr>
		
<table id="datable" class="display table">
    <thead class="thead-light">
		<tr>
			<th>ลำดับ</th>
			<th>รหัสรับสินค้า</th>
			<th>รับโดย</th>
			<th>วันที่</th>
			<th>รายละเอียด</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $key=>$value) { ?>
			<tr>

			<td><?php echo $key+1 ?></td>
			<td><?php echo $value['id'] ?></td>
			<td><?php echo $value['fullname'] ?></td>
			<td><?php echo $value['date'] ?></td>
			<td> 
				<a href="list-get-product.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">รายละเอียด</a>
			</td>
			
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
<!-- <script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> Resource jQuery -->
</body>
</html>
