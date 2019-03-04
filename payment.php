
<?php include 'navbar-member.php';?>
<?php 
  include "db.php";
  $sql = "select * from member_addcourse where user_id = ".$_SESSION['id'];
  $data = $conn->query($sql);
$day = ['จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์']

?>



<head>
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

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
  	
	<title>ข้อมูลสมัครเรียนดนตรี</title>
</head>
<body>


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
        <h1 class="entry-title"><span>ข้อมูลสมัครเรียนดนตรี</span> </h1> 
        <img src="">
        <p><b></b></p>
        
        <hr>
<?php
foreach ($data as $key => $value) { ?>
  <h3>รหัสรายการสมัครเรียน : <?php echo $value['id'];  ?></h3>
   <?php if($value['payment'] == 0) {echo "<h4 style= 'color:#3300CC; '><b>ยังไม่ชำระเงิน </b></h4>"; } elseif($value['payment'] == 1){ echo "<h4 style= 'color:#FF9900; '><b> ส่งหลักฐานการชำระแล้ว รอการตรวจสอบ </b></h4>"; }elseif($value['payment']==3){echo "<h4 style= 'color:#339966'><b> ผ่านการตรวจสอบ ชำระเงินเรียบร้อยแล้ว </b> </h4>";}elseif($value['payment']==2){echo "<h4 style= 'color:red; '><b>ไม่ผ่านการอนุมัติ กรุณาส่งหลักฐานใหม่</b></h4>" ;} ?>
  
  <h5>วันที่สมัคร <?php echo $value['date']; ?></h5>
    <?php
    $music_course = "select music_course.*, course.c_name,course.c_detail,course.c_price from member_course left join music_course on member_course.course_id = music_course.id left join course on music_course.course_id = course.id where order_id =  ".$value['id'];
    $datas = $conn->query($music_course);
    $total = 0;
    ?>
    <table class="table">
    <thead>
      <tr>
        <td>รหัสวิชา</td>
        <td>ชื่อวิชา </td>
        <td>รายละเอียด</td>
        <td>วัน / เวลาที่เรียน</td>
        <td>ราคา</td>
      </tr>
    </thead>
    <?php foreach($datas as $keys=>$values) { ?>
    <?php
      $total = $total + (int)$values['c_price'];
    ?>
    <tr>
        <td><?php echo $values['id'] ?></td>
        <td><?php echo $values['c_name'] ?></td>
        <td width=50%><?php echo $values['c_detail'] ?></td>
        <td><?php echo $day[$values['date_course']-1] ?> <br> <?php echo $values['time_course'] ?> </td>
        <td><?php echo $values['c_price'] ?></td>
      </tr>
    <?php } ?>
    </table>
    <hr>
    <div style="float:left;">
    <span style="border-bottom: 3px double;">ราคารวม: <?php echo $total; ?></span> <br> <br>

    <?php if($value['payment'] == 3){ ?>
    <button class="btn btn-default">ปริ้น</button>
    <?php }?>

    <a <?php if($value['payment'] == 3){echo "disabled";} ?> class="btn btn-primary" href="submit_evidence.php?id=<?php echo $value['id'] ?>">ส่งหลักฐานการชำระเงิน</a> 
    <?php if($value['payment'] == 0) { ?>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $value['id'] ?>">ยกเลิกการสมัคร</button>

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
            <a href="delete-payment.php?delete=<?php echo $value['id']?>" class="btn btn-danger">ลบ</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end Modal -->
    <?php } ?>
    <hr>
    <br><br>
<?php
}
?>



<!-- <form class="form-horizontal" action="" method="POST" >  

        <div class="form-group">
          <label class="control-label col-sm-2">รหัสสมัครเรียน<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input required type="text" class="form-control" id="" name="id" value="" placeholder="Enroll ID"  >
            </div>
            </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2">ชื่อ - นามสกุล<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
            <input class="form-control"  name="name" type="text" placeholder="Full name">
          </div>
        </div></div>

        <div class="form-group">
          <label class="control-label col-sm-2">เบอร์โทรศัพท์<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
            <input class="form-control"  name="tel" type="text" placeholder="Tel">
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">โอนเงินไปยังธนาคาร<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
                <select name="category"  class="form-control">
                    <option selected disabled>เลือกธนาคาร</option>
                        <option value = "0" >ธนาคารกรุงเทพ</option>
						<option value="1">ธนาคารกสิกรไทย</option>
						<option value="2">ธนาคารกรุงไทย </option>
                </select>
              </div>
            </div>
          </div>
        </div>

        
        <div class="form-group">
          <label class="control-label col-sm-2">จำนวนเงินที่โอน<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
            <input class="form-control" name="price" type="text" placeholder="Amount" onKeyUp="if(isNaN(this.value)){ this.value='';}">
          </div>
        </div>

           <div class="form-group">
          <label class="control-label col-sm-2">วันที่โอน<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
            <input  class="form-control" name="date" type="date" placeholder="Date" >
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-sm-2">เวลาที่โอน<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
            <input  class="form-control" name="time" type="time" placeholder="Time" >
          </div>
        </div>
        
        <div class="form-group"> 
          <label class="control-label col-sm-2">หลักฐานการชำระเงิน</label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input type="file" name="slip"  class="form-control upload" placeholder="" aria-describedby="file_upload">
            </div>
          </div>
        
        <div class="form-group">
          <div class="col-xs-offset-2 col-xs-10 ">
              <div class="col-md-5 col-sm-8"><br>
          <button type="submit" class="btn btn-primary">แจ้งชำระเงิน</button>
        </div>
</form> -->
