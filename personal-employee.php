<?php
error_reporting(0);
session_start();
include "connect.php";
include "app/user.php"; 
include "app/admin.php";

?><!doctype html>

<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Mingkhun</title>
</head>
<body>
	<header class="cd-main-header">
		<a href="employee.php" class="cd-logo"><img src="img/logo1.png" alt="Logo"></a>

		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li><a href="add-product.php">จัดการข้อมูลสินค้า</a></li>
                <li><a href="get-product.php">รับสินค้า</a></li> 
				<li><a href="sale-product.php">ขายสินค้า</a></li>
				<li><a href="send-product.php">ส่งสินค้า</a></li>
                <li><a href="add-promotion.php">จัดโปรโมชั่น</a></li>
                <li><a href="personal-employee.php">จัดการข้อมูลส่วนตัว</a></li>
                <li><a href="check-payment.php">ตรวจสอบการชำระเงิน</a></li>

				<? if(empty($_SESSION['username'])){?>
				<li class="has-children ">
					<a href="login.php">
						<img src="img/cd-avatar.png" alt="avatar">
						Login
					</a>
				</li>
				<?}else{?>
				<li class="has-children ">
					<a href="logout.php">
						<img src="img/cd-avatar.png" alt="avatar">
						<? echo $_SESSION['fullname']; ?>
					</a>
				</li>
				<? } ?>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->



	<main class="cd-main-content">

	</main> <!-- .cd-main-content -->
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>