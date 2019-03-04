<?php 
session_start();
include "db.php";

if (isset($_GET['delete'])) {
    $sql = "delete from keep_select_course where id = ".$_GET['delete'];
    if ($conn->query($sql)) {
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "ลบเรียบร้อย";
    }else {
        $_SESSION['alert']['status']  = "danger";
        $_SESSION['alert']['message']  = $conn->error;
    }
}


$sql = "select keep_select_course.id as key_id, course.c_name, music_course.*, c_price from keep_select_course 
left join music_course on keep_select_course.course_id = music_course.id 
left join course on music_course.course_id = course.id 
where user_id = ".$_SESSION['id'];
$data = $conn->query($sql);

    $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id'].";";
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $res = $conn->query($sql);
    $user = $res->fetch_assoc();
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['username'] = $user['username'];
?>

<!doctype html>
<html lang="en" class="no-js">
<?php include 'navbar-member.php';?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSS -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<style>
body {
 
  overflow-x: hidden; 
  background-image: url('https://i.pinimg.com/originals/e4/98/1a/e4981a3dd4aa2fa6f0bc84cde9087c7a.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center; 
  background-size: 100%;
  color:#fff;

}

img {
  max-width: 100%; 
}


</style>

	<title>รายการวิชาที่เลือก</title>
</head>
<body>

<div class="container">
<div class="row">
    <div class="col-md-12">
<section>      




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


<section>      
        <h1 class="entry-title"><span>รายการวิชาที่เลือก</span> </h1>
        <hr>
		
		<form class="form-horizontal" action="confirm-course.php" method="post" >        
        


        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อ - นามสกุล<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
          <span class="input-group-addon"><i class="	glyphicon glyphicon-edit"></i></span>
            <input required type="text" class="form-control" name="name_user" value="<?php echo $user['fullname']; ?>" placeholder="Full name" >
          </div>
        </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">ที่อยู่<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          <textarea  class="form-control" rows="3" name="address_user"><?php echo $user['address']; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          	<div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input required type="text" class="form-control" name="phone_user" value="<?php echo $user['tel']; ?>" placeholder="Tel" maxlength="10" >
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">อีเมล<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input  type="email" class="form-control" name="email_user"  placeholder="Email" value="<?php echo $user['email']; ?>" >
            </div>   </div>
        </div>

        <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10">

            <input type="submit" value="ยืนยันการสมัคร" class="btn btn-success" >
            <a href="music-course.php" class="btn btn-primary">เลือกวิชาต่อ</a>
        </div>
</form>
<br>
<br>
<hr>
<table id="datable" class="display table">
    <thead class="thead-light">
		<tr>
			<th>ลำดับ</th>
			<th>รหัสวิชา</th>
			<th>ชื่อวิชา</th>
			<th>วัน</th>
			<th>เวลาที่เรียน</th>
			<th>ราคา</th>
			<th>จัดการ</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$total_price = 0;
		foreach($data as $key=>$value) { 
			$total_price = $total_price + (int)$value['c_price'];
			?>
			<tr>

			<td><?php echo $key+1 ?></td>
			<td><?php echo $value['id'] ?></td>
			<td><?php echo $value['c_name'] ?></td>
			<td><?php
      
      if($value['date_course'] == '1'){
        echo 'จันทร์';
      }else if($value['date_course'] == '2'){
        echo 'อังคาร';
      }else if($value['date_course'] == '3'){
        echo 'พุธ';
      }else if($value['date_course'] == '4'){
        echo 'พฤหัสบดี';
      }else if($value['date_course'] == '5'){
        echo 'ศุกร์';
      }else if($value['date_course'] == '6'){
        echo 'เสาร์';
      }else{
        echo 'อาทิตย์';
      }
      // echo $value['date_course'];
      
      
      
      ?></td>
			<td><?php echo $value['time_course'] ?></td>
			<td><?php echo $value['c_price'] ?></td>
			<td> 
				<a href="?delete=<?php echo $value['key_id'] ?>" class="btn btn-danger"><b>X</b></a>
			</td>
			
		<?php } ?>
	</tbody>
</table>
<p>
	<span>ราคารวม</span>
	<?php echo $total_price; ?> บาท
</p>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

</body>
</html>
