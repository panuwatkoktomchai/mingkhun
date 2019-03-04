<?php 
//error_reporting(0);
session_start();

?>
<!doctype html>
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
		<a href="index.php" class="cd-logo"><img src="img/logo1.png" alt="Logo"></a>

		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li><a href="index.php">หน้าแรก</a></li>
				<li><a href="shop.php">สินค้า</a></li>
				<li><a href="music-course.php">คอร์สเรียนดนตรี</a></li>
				<li><a href="promotion.php">โปรโมชั่น</a></li>
				<li><a href="payment.php">แจ้งชำระเงิน</a></li>
				<li><a href="contact.php">ติดต่อเรา</a></li>

				<?php  if(empty($_SESSION['username'])){?>
				<li class="has-children ">
					<a href="login.php">
						<img src="img/cd-avatar.png" alt="avatar">
						Login
					</a>
				</li>
				<?php }else{?>
				<li class="has-children ">
					<a href="logout.php">
						<img src="img/cd-avatar.png" alt="avatar">
						<?php  echo $_SESSION['fullname']; ?>
					</a>
				</li>
				<?php  } ?>
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