<?php
    include "db.php";
    if(isset($_REQUEST['id'])==false){
        header('Location"get-product.php');
    }else{
        $sql = "select * from products where id = ".$_REQUEST['id'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_query($conn, "SET NAMES UTF8");
        $data = $conn->query($sql);
        if ($data->num_rows <= 0) {
            header('Location"get-product.php');            
        }else{
            $data = $data->fetch_assoc();
        }
        $conn->close();
    }
?>
<!doctype html>
<html lang="en" class="no-js">
<?php include 'employee-menubar.php';?>
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
<br><br><br><br><br>
<div class="container">
  <form>
    <div class="row">
	<div class="col-half">
        <h4>รับสินค้า</h4><br>

      <div class="input-group input-group-icon">
        <input type="text" value="<?php echo $data["id"] ?>" placeholder="รหัสสินค้า" />
	  </div>
	  
	  <div class="input-group input-group-icon">
        <input type="text" value="<?php echo $data["unit"] ?>" placeholder="จำนวนรับสุทธิ" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"/>
	  </div>
	  <div class="input-group input-group-icon">
        <input type="text" value="<?php echo $_SESSION['id'] ?>" placeholder="รหัสพนักงาน"/>
	  </div>
	  
      <div class="input-group input-group-icon">
        <input type="text" value="" autofocus placeholder="รหัสตัวแทนจำหน่าย"/>
	  </div>
	  <button type="input" class="btn btn-primary">บันทึก</button>
	</div>
	

	
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>