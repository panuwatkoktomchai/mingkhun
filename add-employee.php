<!doctype html>
<html lang="en" class="no-js">
<?php include 'owner-menubar.php';?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  	
		
	<title>Mingkhun</title>
</head>


<body>
<br><br><br><br><br><br>
<div class="container">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="app/bootstrap.min.css">

<!-- jQuery library -->
<script src="app/jquery.min.js"></script>

<!-- Popper JS -->
<script src="app/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<h1>เพิ่มพนักงาน</h1>

<?
error_reporting(0);
/**
 * If insert to database success
 * 
 */
if($_REQUEST['st'] == 'true'){
?>
    <div class="alert alert-success">
        <strong>Success!</strong> Your request is success
    </div>
<?
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


<form action="<? if(isset($_REQUEST['id'])){echo "update-user.php";}else{echo "insert-user.php?p=add-employee.php";}?>" method="post">
    <h3>ระบบ</h3>
    <div class="form-group">
        <select name="position" class="form-control">
            <option selected value="2">พนักงาน</option>
        </select>
    </div>
    <div class="form-group">
        <label for="usr">username:</label>
        <input required type="text" class="form-control" id="usr" name="user" value="<? echo $user['username']; ?>">
    </div>
    <div class="form-group">
        <label for="usr">Email:</label>
        <input required type="text" class="form-control" id="usr" name="email" value="<? echo $user['email']; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input  required type="password" class="form-control" id="pwd" name="pass" value="<? echo $user['password']; ?>">
    </div>
    <div class="form-group">
        <label for="">confirm-password:</label>
        <input required type="password" class="form-control" name="confirmpass" value="<? echo $user['password']; ?>">
    </div>
    <br><br>
    <h3>ข้อมูลทั่วไป</h3>
    <div class="form-group">
        <label for="">ชื่อ:</label>
        <input required type="text" class="form-control" name="fullname" value="<? echo $user['fullname']; ?>">
    </div>
    <div class="form-group">
        <label for="">เบอร์โทร:</label>
        <input required type="text" class="form-control" name="tel" value="<? echo $user['tel']; ?>">
    </div>
    <div class="form-group">
        <label for="">รหัสบัตรประชาชน:</label>
        <input required type="text" class="form-control" name="idcard" value="<? echo $user['cardid']; ?>">
    </div>
    <div class="form-group">
        <label for="comment">ที่อยู่:</label>
        <textarea class="form-control" rows="5" name="address"><? echo $user['address']; ?></textarea>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" checked name="m">ชาย
        </label>
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input <? if($user['gen']==2){echo "checked";} ?> type="radio" class="form-check-input" name="w">หญิง
        </label>
    </div>
    <label for="">รูปภาพ</label>
    <input class="form-control" type="file" name="img">
    <br>
    <input class="btn btn-success" type="submit" value="บันทึก">
		<a href="add-employee.php" class="btn btn-secondary">Cancle</a>
    
</form>

<?
/**
 * List all user
 */
$position = array('ผู้ดูแลระบบ','พนักงาน','อาจารย์');
include "db.php";
$sql = "SELECT * FROM users WHERE status = 2;";
$conn = new mysqli($servername, $username, $password, $dbname);
$obj = $conn->query($sql);
?>

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
        <?
        foreach ($obj as $key => $value) {
        ?>
            <tr>
                <td><? echo $value['fullname']?></td>
                <td><? echo $value['email']?></td>
                <td><? echo $value['username']?></td>
                <td><? echo $position[(int)$value['status']-1];?></td>
                <td>
                    <a href="add-employee.php?id=<? echo $value['id'] ?>" class="btn btn-warning">แก้ไข</a>
                    <a href="delete.php?id=<? echo $value['id'] ?>&table=users&p=add-employee.php" class="btn btn-danger">ลย</a>
                </td>
            </tr>
        <?
        }
        ?>
    </tbody>
  </table>

	</div>
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>