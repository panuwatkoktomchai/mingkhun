<?php 
session_start();
include "db.php";


$sql = "SELECT member_addcourse.*, users.fullname FROM member_addcourse LEFT JOIN users ON users.id = member_addcourse.user_id";
$data = $conn->query($sql);

?>

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

	<title>ข้อมูลสมัครเรียน</title>
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-md-12">

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

<br><br>
<section>      
        <h1 class="entry-title"><span>ข้อมูลสมัครเรียน</span> </h1>
        <hr>
		
<table id="datable" class="display table">
    <thead class="thead-light">
		<tr>
			<th>ลำดับ</th>
			<th>รหัสสมาชิก</th>
			<th>ชื่อสมาชิก</th>
			<th>วันที่สมัคร</th>
			<th>สถานะ</th>
			<th>จัดการ</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $key=>$value) { ?>
			<tr>
            
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value['user_id'] ?></td>
			<td><?php echo $value['fullname'] ?></td>
			<td><?php echo $value['date'] ?></td>
			<td><?php if($value['payment'] == 0) {echo "ยังไม่ชำระเงิน"; }elseif($value['payment'] == 1){ echo "รอการตรวจสอบ"; }elseif($value['payment']==3){echo "ชำระเงินเรียบร้อย";} ?></td>
			<td> 
				<a href="show-detail-register.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">รายละเอียด</a>
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
