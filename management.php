<!doctype html>
<html lang="en" class="no-js">
<?php include 'owner-menubar.php';?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	        <!-- Latest compiled and minified CSS -->
			  <link rel="stylesheet" href="app/bootstrap.min.css">

<!-- jQuery library -->
<script src="app/jquery.min.js"></script>

<!-- Popper JS -->
<script src="app/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
	<title>Mingkhun</title>
</head>
<body class="container">

<br><br><br><br>
<div class="row">
	<div class="col-md-6">
	<?php
		/**
		 * List all user
		 */
		$position = array('ผู้ดูแลระบบ','พนักงาน','อาจารย์');
		include "db.php";
		$sql = "SELECT * FROM users WHERE status = 2;";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$obj = $conn->query($sql);
		?>
		<h1>พนักงาน</h1>
		<table class="table">
			<thead class="thead-light">
			<tr>
				<th>fullname</th>
				<th>email</th>
				<th>user</th>
				<th>ตำแหน่ง</th>
				<th>จัดการ</th>
			</tr>
			</thead>
			<tbody>
				<?php
				foreach ($obj as $key => $value) {
				?>
					<tr>
						<td><?php echo $value['fullname']?></td>
						<td><?php echo $value['email']?></td>
						<td><?php echo $value['username']?></td>
						<td><?php echo $position[(int)$value['status']-1];?></td>
						<td>
							<a href="add-employee.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">แก้ไข</a>
							<a href="delete.php?id=<?php echo $value['id'] ?>&table=users&p=add-employee.php" class="btn btn-danger">ลย</a>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
	
		<?php
		/**
		 * List all user
		 */
		$position = array('ผู้ดูแลระบบ','พนักงาน','อาจารย์');
		include "db.php";
		$sql = "SELECT * FROM users WHERE status = 3;";
		$conn = new mysqli($servername, $username, $password, $dbname);
		$obj = $conn->query($sql);
		?>
		<h1>อาจารย์</h1>
		<table class="table">
			<thead class="thead-light">
			<tr>
				<th>fullname</th>
				<th>email</th>
				<th>user</th>
				<th>ตำแหน่ง</th>
				<th>จัดการ</th>
			</tr>
			</thead>
			<tbody>
				<?php
				foreach ($obj as $key => $value) {
				?>
					<tr>
						<td><?php echo $value['fullname']?></td>
						<td><?php echo $value['email']?></td>
						<td><?php echo $value['username']?></td>
						<td><?php echo $position[(int)$value['status']-1];?></td>
						<td>
							<a href="add-employee.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">แก้ไข</a>
							<a href="delete.php?id=<?php echo $value['id'] ?>&table=users&p=add-employee.php" class="btn btn-danger">ลย</a>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>

	</div>
</div>
	

<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>