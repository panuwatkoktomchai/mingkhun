<meta charset="UTF-8">
<?php include 'navbar-admin.php';?>
<title>จัดการข้อมูลสมาชิก</title>

<!-- jQuery library -->
<script src="app/jquery.min.js"></script>
<!-- Popper JS -->
<script src="app/popper.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



<div class="container">
<div class="row">
    <div class="col-md-12">

<?php
error_reporting(0); 
/**
 * If insert to database success
 * 
 */
if($_REQUEST['st'] == 'true'){
?>
    <div class="alert alert-success">
        <strong>Success!</strong> Indicates a successful or positive action.
    </div>
<?php
}

/**
 * If id isset. get user for edit
 * 
 */
$user;
if (isset($_REQUEST['id'])) {
    $sql = "SELECT * FROM users WHERE id = ".$_REQUEST['id'].";";
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $res = $conn->query($sql);
    $user = $res->fetch_assoc();
}
?>

<section>      
        <h1 class="entry-title"><span>คุณ <?php echo $_SESSION['fullname'] ?></span> </h1>
        <hr>

<form class="form-horizontal" action="<?php if(isset($_REQUEST['id'])){echo "update-users.php";}else{echo "insert-user.php?p=add-users.php";}?>" method="post" >        
        
        <input type="text" hidden name="id" value="<?php echo $_REQUEST['id'] ?>">
        
        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อเข้าสู่ระบบ<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input required type="text" class="form-control" id="usr" name="username" value="<?php echo $user['username']; ?>" placeholder="Username" readonly>
            </div>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">รหัสผ่าน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input required type="password" class="form-control" id="pwd" name="password" value="<?php echo $user['password']; ?>" placeholder="Password">
           </div>   
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">ยืนยันรหัสผ่าน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input required type="password" class="form-control" id="pwd" name="password" value="<?php echo $user['password']; ?>" placeholder="Confirm Password">
            </div>  
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อ - นามสกุล<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
          <span class="input-group-addon"><i class="	glyphicon glyphicon-comment"></i></span>
            <input required type="text" class="form-control" name="fullname" value="<?php echo $user['fullname']; ?>" placeholder="Full name">
          </div>
        </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">ตำแหน่ง<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select name="status"  class="form-control">
                    <option selected disabled>เลือกตำแหน่ง</option>
                    <option <?php if($user['status']==1){echo "selected";} ?> value="1">เจ้าของร้าน</option>
                    <option <?php if($user['status']==3){echo "selected";} ?> value="3">อาจารย์</option>
                    <option <?php if($user['status']==2){echo "selected";} ?> value="2">พนักงาน</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">ระบุเบอร์โทรศัพท์<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          	<div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input required type="text" class="form-control" name="tel" value="<?php echo $user['tel']; ?>" placeholder="Tel">
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">ที่อยู่<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          <textarea class="form-control" rows="3" name="address"><?php echo $user['address']; ?></textarea>
          </div>
        </div>
        
        <!-- ช่องโหลดรูป <div class="form-group"> 
          <label class="control-label col-sm-3">Profile Photo <br>
          <small>(optional)</small></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input type="file" name="photo" id="file_nm" class="form-control upload" placeholder="" aria-describedby="file_upload">
            </div>
          </div> -->

        <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10">
            <?php if(isset($_REQUEST['id'])){ ?>
            <input type="submit" value="อัพเดท" class="btn btn-warning">
            <a href="?" class="btn btn-danger">ยกเลิก</a>
            <?php }else{ ?>
            <input type="submit" value="บันทึก" class="btn btn-success" >
            <?php } ?>
        </div>
</form>





<br><br><br><br>

</div>
