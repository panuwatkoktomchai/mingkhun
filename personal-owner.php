<!doctype html>
<html lang="en" class="no-js">
<?php include 'owner-menubar.php';?>
<br><br>
<br>
<?
$sql = "select * from users where id = ".$_SESSION['id'];
include "db.php";
$conn = new mysqli($servername, $username, $password, $dbname);
$res = $conn->query($sql);
$user = $res->fetch_assoc();
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/add_style.css"> 
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>Mingkhun</title>
</head>
<body>
<br><br><br><br><br><br>
<div class="container">
  <form>
    <div class="row">
      <h4>จัดการข้อมูลส่วนตัว</h4><br>
      <div class="input-group input-group-icon">
        <input name="username" type="text" placeholder="ชื่อเข้าสู่ระบบ"/ value="<? echo $user['username'] ?>">
	  </div>
	  
      <div class="input-group input-group-icon">
        <input name="password" type="password" placeholder="รหัสผ่าน"/ value="<? echo $user['password'] ?>">
	  </div>
	  
      <div class="input-group input-group-icon">
        <input name="fullname" type="text" placeholder="ชื่อ - นามสกุล"/ value="<? echo $user['fullname'] ?>">
	  </div>
	  
	  <div class="input-group input-group-icon">
        <input name="address" type="text" placeholder="ที่อยู่"/ value="<? echo $user['address'] ?>">
	  </div>
	  
	  <div class="input-group input-group-icon">
        <input name="tel" type="text" placeholder="เบอร์โทรศัพท์"/ value="<? echo $user['tel'] ?>">
      </div>
	</div>
	
  <button type="input" class="btn btn-success">บันทึก</button>

  </form>
</div>

	
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>