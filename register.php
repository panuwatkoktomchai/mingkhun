<?php session_start(); 
// print_r($_SESSION);
// exit;

?>
<?php include 'navbar.php';?>
<title>สมัครสมาชิก</title>

<!-- jQuery library -->
<script src="app/jquery.min.js"></script>
<!-- Popper JS -->
<script src="app/popper.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


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
    <div class="col-md-8">

<?php
// error_reporting(l0);
/**
 * If insert to database success
 * 
 */

 
/**
 * If id isset. get user for edit
 * 
 */
$user;
if (isset($_REQUEST['id'])) {
    $sql = "SELECT * FROM member WHERE mb_id = ".$_REQUEST['id'].";";
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $res = $conn->query($sql);
    $user = $res->fetch_assoc();
}
?>

      <section>      
        <h1 class="entry-title"><span>สมัครสมาชิก</span> </h1>
        <hr>
            <form class="form-horizontal" action="<?php if(isset($_REQUEST['id'])){echo "update-user.php";}else{echo "insert-user.php?p=register.php";}?>" method="post" >    

            <div class="form-group">
          <label class="control-label col-sm-3">ชื่อเข้าสู่ระบบ<span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input required type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $user[''] ?>">
          </div>
        </div></div>
        
        <div class="form-group">
          <label class="control-label col-sm-3">ระบุรหัสผ่าน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input required   type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $user[''] ?>" minlength="8">
           </div>   
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3">ยืนยันรหัสผ่าน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input required   type="password" class="form-control" name="con_password" placeholder="Confirm Password" value="<?php echo $user[''] ?>" minlength="8">
            </div>  
          </div>
        </div>
         
        <div class="form-group">
          <label class="control-label col-sm-3">ชื่อ - นามสกุล<span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
            <input required   type="text" class="form-control" name="fullname"  placeholder="Full name" value="<?php echo $user[''] ?>">
          </div>
        </div></div>

        
        <!-- <div class="form-group">
          <label class="control-label col-sm-3">อายุ<span class="text-danger">*</span></label>
          <div class="col-md-2 col-sm-9">
            <input  type="text" class="form-control" name="age" placeholder="Age" value="<?php echo $user[''] ?>">
          </div>
        </div> -->

        <!-- <div class="form-group">
          <label class="control-label col-sm-3">เพศ <span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
            <label>
            <input name="gen" type="radio" value="1" checked>
            ชาย </label>
               
            <label>
            <input name="gen" type="radio" value="2" >
            หญิง </label>
          </div>
        </div> -->

        <div class="form-group">
          <label class="control-label col-sm-3">ที่อยู่<span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
          <textarea required  class="form-control" rows="3" name="address" placeholder="Address" ></textarea>
          </div>
        </div>

        
        <div class="form-group">
          <label class="control-label col-sm-3">เบอร์โทรศัพท์<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          	<div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
            <input required  type="text" class="form-control" name="tel"  placeholder="Tel" value="" maxlength="10" onKeyUp="if(isNaN(this.value)){ this.value='';}">
            </div>
          </div>
        </div>
            
        <div class="form-group">
          <label class="control-label col-sm-3">อีเมล<span class="text-danger">*</span></label>
          <div class="col-md-8 col-sm-9">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input required  type="email" class="form-control" name="email"  placeholder="Email" value="">
            </div>   </div>
        </div>
        
               
        <!-- โน้ต <div class="form-group">
          <div class="col-xs-offset-3 col-md-8 col-sm-9"><span class="text-muted"><span class="label label-danger">Note:-</span> By clicking Sign Up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Policy</a>, including our <a href="#">Cookie Use</a>.</span> </div>
        </div> -->
        <input type="text" hidden name="status"  value="5">


        <div class="form-group">
          <div class="col-xs-offset-3 col-xs-10">
            <input name="Submit" type="submit" value="ยืนยันการสมัคร" class="btn btn-success">
          </div>
        </div>
      </form>
    </div>
</div>
</div>
