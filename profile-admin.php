<meta charset="UTF-8">
<?php include 'navbar-admin.php';?>
<title>จัดการข้อมูลส่วนตัว</title>

<!-- jQuery library -->
<script src="app/jquery.min.js"></script>
<!-- Popper JS -->
<script src="app/popper.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<?php
$user;
session_start();

if (isset($_SESSION['id'])) {
    $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id'].";";
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $res = $conn->query($sql);
    $user = $res->fetch_assoc();
}else{
    // header('Location:index.php');
}
?>

<div class="container">

<!-- show alert -->
<br><br>
<?php if(isset($_SESSION['alert'])){ ?>
<div id="alert" class="alert alert-<?php echo$_SESSION['alert']['status'] ?> alert-dismissible">
  <a onclick="document.getElementById('alert').style.display='none'" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong><?php echo $_SESSION['alert']['status'] ?>!</strong> <?php echo $_SESSION['alert']['message'] ?>
</div>
<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 3000);
</script>
<?php }
 unset($_SESSION['alert']);
?>
<!-- end alert -->

<div class="row">
    <div class="col-md-12"> 

<section>      
        <h1 class="entry-title"><span>จัดการข้อมูลส่วนตัว <br><h4>ผู้ใช้งาน : <?php echo $_SESSION['fullname'] ?></h4></span> </h1>
        <hr>

<form class="form-horizontal" action="<?php if(isset($_SESSION['id'])){echo "update-users.php?p=profile-admin.php";}else{echo "insert-user.php?p=add-users.php";}?>" method="post" >        
        
        <input type="text" hidden name="id" value="<?php echo $_SESSION['id'] ?>">
         
        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อเข้าสู่ระบบ<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input required type="text" class="form-control" id="usr" name="username" value="<?php echo $user['username']; ?>" placeholder="Username" readonly >
            </div>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">รหัสผ่าน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input required type="password" class="form-control" id="pwd" name="password" value="<?php echo $user['password']; ?>" placeholder="Password" minlength="8">
           </div>   
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">ยืนยันรหัสผ่าน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input required type="password" class="form-control" id="pwd" name="con_password" value="<?php echo $user['password']; ?>" placeholder="Confirm Password" minlength="8">
            </div>  
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อ - นามสกุล<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
            <input required type="text" class="form-control" name="fullname" value="<?php echo $user['fullname']; ?>" placeholder="Full name">
          </div>
        </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">สถานะ<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select hidden name="status" disabled class="form-control">
                    <option <?php if($user['status']==1){echo "selected";} ?> value="1">เจ้าของร้าน</option>
                    <option <?php if($user['status']==3){echo "selected";} ?> value="3">อาจารย์</option>
                    <option <?php if($user['status']==2){echo "selected";} ?> value="2">พนักงาน</option>
                    <option <?php if($user['status']==5){echo "selected";} ?> value="5">สมาชิกทั่วไป</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">ที่อยู่<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          <textarea class="form-control" rows="3" name="address"><?php echo $user['address']; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">ระบุเบอร์โทรศัพท์<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          	<div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input required type="text" class="form-control" name="tel" value="<?php echo $user['tel']; ?>" placeholder="Tel" maxlength="10" onKeyUp="if(isNaN(this.value)){ this.value='';}">
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">อีเมล<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input  type="email" class="form-control" name="email"  placeholder="Email" value="<?php echo $user['email']; ?>">
            </div>   </div>
        </div>
        
        <!-- ช่องโหลดรูป <div class="form-group"> 
          <label class="control-label col-sm-3">Profile Photo <br>
          <small>(optional)</small></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input type="file" name="file_nm" id="file_nm" class="form-control upload" placeholder="" aria-describedby="file_upload">
            </div>
          </div> -->

        <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10">
            <?php if(isset($_SESSION['id'])){ ?>
            <input type="submit" value="อัพเดท" class="btn btn-warning" >
            <?php }else{ ?>
            <input type="submit" value="บันทึก" class="btn btn-success" >
            <?php } ?>
        </div>
</form>

<script>
      const myForm = document.getElementById('myForm');
      myForm.style.display = 'block';
      setTimeout(() => {
        myForm.style.display = 'none';
      }, 3000);
    </script>