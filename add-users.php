<meta charset="UTF-8">
<?php include 'navbar-admin.php';?>
<title>เพิ่ม / จัดการข้อมูลสมาชิก</title>
<!-- jQuery library -->
<script src="app/jquery.min.js"></script>
<!-- Popper JS -->
<script src="app/popper.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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


<?php
/**
 * If id isset. get user for edit 
 * 
 */
$user;
if (isset($_REQUEST['id'])) {
    $sql = "SELECT * FROM users WHERE id = ".$_REQUEST['id'].";";
    include "db.php";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $res = $conn->query($sql);
    $user = $res->fetch_assoc();
}
?>

<section>      
        <h1 class="entry-title"><span>เพิ่มผู้ใช้งาน</span> </h1>
        <hr>

<form class="form-horizontal" action="<?php if(isset($_REQUEST['id'])){echo "update-users.php?p=add-users.php";}else{echo "insert-user.php?p=add-users.php";}?>" method="post" >        
        
        <input type="text" hidden name="id" value="<?php echo $_REQUEST['id'] ?>">
        
        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อเข้าสู่ระบบ<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input <?php if(isset($_REQUEST['id'])) {echo "readonly"; } ?> required type="text" class="form-control" id="usr" name="username" value="<?php echo $user['username']; ?>" placeholder="Username" >
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
              <input  required type="password" class="form-control" id="pwd" name="con_password" value="<?php echo $user['password']; ?>" placeholder="Confirm Password" minlength="8">
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
                    <?php if($_SESSION['id'] = 1) { ?>
                    <option <?php if($user['status']==1){echo "selected";} ?> value="1">เจ้าของร้าน</option>
                    <?php } ?>
                    <option <?php if($user['status']==2){echo "selected";} ?> value="2">พนักงาน</option>
                    <option <?php if($user['status']==3){echo "selected";} ?> value="3">อาจารย์</option>
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
            <input required type="text" class="form-control" name="tel" value="<?php echo $user['tel']; ?>" placeholder="Tel" onKeyUp="if(isNaN(this.value)){ this.value='';}" maxlength="10">
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
        <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10">
            <?php if(isset($_REQUEST['id'])){ ?>
            <input type="submit" value="อัพเดท" class="btn btn-warning">
            <a href="?" class="btn btn-danger">ยกเลิก</a>
            <?php }else{ ?>
            <input type="submit" value="บันทึก" class="btn btn-primary">
            <?php } ?>
        </div>
</form>
<br><br><br><br>
<h1 class="entry-title"><span>จัดการสมาชิก</span> </h1>
        <hr>
<?php
/**
 * List all user
 */
$position = array('เจ้าของร้าน','พนักงาน','อาจารย์','','สมาชิกทั่วไป',);
include "db.php";

$sql = "SELECT * FROM users ;";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$obj = $conn->query($sql);
?>

<table class="table display" id="datable">
    <thead class="thead-light">
      <tr>
      <th>รหัสสมาชิก</th>
      <th>ชื่อเข้าสู่ระบบ</th>
        <th>ชื่อ - นามสกุล</th>
        <th>อีเมล</th>
        <th>ตำแหน่ง</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach ($obj as $key => $value) {
        ?>
            <tr>
            <td><?php echo $value['id']?></td>
                <td><?php echo $value['username']?></td>
                <td><?php echo $value['fullname']?></td>
                <td><?php echo $value['email']?></td>
                <td><?php echo $position[(int)$value['status']-1];?></td>
                <td>
                    <?php if($_SESSION['id'] == $value['id']){ ?>
                      คุณ
                    <?php }else{ ?>
                    <a href="add-users.php?id=<?php echo $value['id'] ?>" class="btn btn-success">แก้ไข</a>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $value['id'] ?>">ลบ</button>
                    <?php } ?>
                     <!-- Modal -->
                      <div class="modal fade" id="<?php echo $value['id'] ?>" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">ยืนยันการลบ</h4>
                            </div>
                            <div class="modal-body">
                              <p>ต้องการลบข้อมูลหรือไม่.</p>
                            </div>
                            <div class="modal-footer">
                              <a href="delete.php?id=<?php echo $value['id']?>&table=users&p=add-users.php" class="btn btn-danger">ลบ</a>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end Modal -->
                </td>
            </tr>
            
        <?php
        }
        ?>
    </tbody>
  </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );
</script>
