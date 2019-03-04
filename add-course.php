<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!doctype html>
<title>เพิ่ม / แก้ไขข้อมูลรายวิชา</title>
<html lang="en" class="no-js">
<?php include 'navbar-employee.php';?>
<?php include "db.php";?>

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

<?php

if (isset($_REQUEST['delete'])) {
  $sql = "DELETE FROM course WHERE id = ".$_REQUEST['delete'];
  if ($conn->query($sql)) {
    $_SESSION['alert']['status'] = "success";
    $_SESSION['alert']['message'] = "ลบข้อมูลสำเร็จ";
  }else {
    $_SESSION['alert']['message'] = "ไม่สามารถลบได้";
    $_SESSION['alert']['status'] = "danger";
    # code...
  }
  header('Location:add-course.php');
 
}
$get = "select * from course";
$res = $conn->query($get);
?>
      
 
<head>
</head>


<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>




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
  }, 6000);
</script>
<?php }
 unset($_SESSION['alert']);
?>
<!-- end alert -->

<div class="row">
<div class="col-md-12">
    <section>      
        <h1 class="entry-title"><span>เพิ่ม / แก้ไขข้อมูลรายวิชา</span> </h1>
        <hr>
        
<!-- ----------------------------------------------------------------การแก้ไข ---------->

<!-- ----------------------------------------------------------------ฟอร์มกรอกข้อมูล ---------->


<?php
if(!empty($_REQUEST['edit'])){
    $sql = "select * from course where id = ".$_REQUEST['edit'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $edit = $conn->query($sql);
    $edit = $edit->fetch_assoc();
    
}
?>  
    <?php if(isset($_REQUEST['edit'])){ ?>
    
  <form enctype="multipart/form-data" class="form-horizontal" action="update-course.php?p=add-course.php" method="POST">
    <?php }else{ ?>
    <form enctype="multipart/form-data" class="form-horizontal" action="insert-course.php?p=add-course.php" method="POST">
    <?php } ?>
      
    <?php

//            echo "naja=".$std_id;
            $get = "select * from users where status = 3";
              $conn = new mysqli($servername, $username, $password, $dbname);
              mysqli_query($conn, "SET NAMES UTF8");
              $data = $conn->query($get);
        ?>
    <input type="hidden" name="id" value="<?php echo $edit['id'] ?>" >


    <div class="form-group">
          <label class="control-label col-sm-2">ชื่อวิชา<span class="text-danger">*</span> </label>
          <div class="col-md-5 col-sm-8">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
        <input  required  class="form-control" name="c_name" type="text" placeholder="ชื่อวิชา" value="<?php echo $edit['c_name'] ?>"/>
	  </div>
    </div>
</div> 

<div class="form-group">
          <label class="control-label col-sm-2">รายละเอียด<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
              <div class="input-group">
        <textarea class="form-control" placeholder="รายละเอียด" required name="c_detail" id="" cols="60" ><?php echo $edit['c_detail'] ?></textarea>
	  </div>
    </div>
</div>

         <div class="form-group">
          <label class="control-label col-sm-2">ราคา<span class="text-danger">*</span></label>
          <div class="col-md-5 col-sm-8">
          <input required class="form-control" placeholder="ราคา"  name="c_price" type="number"  value="<?php echo $edit['c_price'] ?>"/>
          </div>
        </div>

        <div class="form-group"> 
          <label class="control-label col-sm-2">อัพโหลดรูปภาพ</label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input <?php if(isset($_REQUEST['edit'])){ echo "disabled"; }?>  type="file" name="filUpload[]" id="filUpload" multiple="multiple" class="form-control upload" placeholder="">
            </div>
          </div>
        
        <!--<div class="form-group">
          <label class="control-label col-sm-2">อาจารย์ผู้สอน<span class="text-danger">*</span></label>
          <div class="col-xs-8">
            <div class="form-inline">
              <div class="form-group">
            <select  name = "us_id" required  class="form-control">
                <option value = "" selected disabled>กรุณาเลือกอาจารย์ผู้สอน</option>
                <?php
              foreach ($data as $key => $value) {  ?>
            <option <?php if($edit['us_id'] == $value['fullname']){ echo "selected"; } ?> value = "<?php echo $value['fullname'];?>">อ. <?php echo $value['fullname'];?></option>
			<?php }?>
          </select>
          </div>
      </div>
    </div>
    </div>-->

       <div class="form-group">
          <div class="col-xs-offset-2 col-sm-8">

          <?php if(isset($_REQUEST['edit'])==true){ ?>

          <input type="submit" value="อัพเดท" class="btn btn-warning">
          <a class="btn btn-danger" href="?">ยกเลิก</a>

          <?php }else{ ?>

          <button type="submit" class="btn btn-primary" >บันทึก</button>
          <?php } ?>
        </div>
        </div></div>
        
  </form>
</div>
<br>

<h1 class="entry-title"><span>จัดการข้อมูลรายวิชา</span> </h1>
        <hr>

    <?php
    $gets = "select * from course";
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $datanaja = $conn->query($gets);
    foreach ($datanaja as $key => $value) {
?>


<table class="table display" id="datable">
    <thead class="thead-light">
      <tr>
      <th>รหัสวิชา</th>
        <th>ชื่อวิชา</th>
        <th width="30%">รายละเอียด</th>
        <th>ราคา</th>
        <th>รูปภาพ</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>
        <?php
        
        foreach ($datanaja as $key => $value) {
            
        ?>
            <tr>
            <td> <?php echo $value['id'];
                        $id = $value['id'];                    
                        $c_name = $value['c_name'];
                        $c_price =$value['c_price'];
                        $us_id = $value['us_id'];

                    ?></td>
                <td><?php echo $value['c_name'] ?></td>
                <td><?php echo $value['c_detail'] ?></td>
                <td><?php echo $value['c_price'] ?></td>
                <td><a class="btn btn-warning"  href="music-photo.php?id=<?php echo $value['id'] ?>">จัดการรูป</a></td>
              
                <!--<td>อ. <?php echo $value['us_id'] ?></td>-->
                <td>
                <a class="btn btn-success"  href="?edit=<?php echo $value['id'] ?>">แก้ไข</a>


                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $value['id'] ?>">ลบ</button>
                    
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
                              <a href="?delete=<?php echo $value['id']?>&table=course&p=add-course.php" class="btn btn-danger">ลบ</a>
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
    <?php } ?>



<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    function get_update(id,c_name,c_detail){
//        alert(id);
        $('input:text[name=idnaja]').empty();
        $('input:text[name=c_namenaja]').empty();
        $('input:text[name=c_detailnaja]').empty();
        $('#jan_namenaja').empty();
        
        $('.main_overlay_paycheck').css("display","block");
         $('.main_overlay_paycheck').click(function(e){
                var target = e.target;
                var contener = $('.main_overlay_paycheck');
//            alert(contener);
//                console.log(e.target);
            if(contener.is(e.target)){
                
                 $('.main_overlay_paycheck').css("display","none");
            }
        });
        $('input:text[name=idnaja]').val(id);
         $('input:text[name=c_namenaja]').val(c_name);
         $('textarea[name=c_detailnaja]').val(c_detail);
        $.ajax({
            url:"http://localhost/Mingkhun/select_course_for_update.php",
             data:"&id="+id,
            type:"POST",
            dataType:"JSON",
            success:function(items){
                console.log(items)
                $.each(items, function(index, element){
                    $('#jan_namenaja').append('<option value="'+element.fullname+'">'+element.fullname+'</option>');
                });
//                alert(data);
//                console.log(data)
//                $.each(data, function(index,val) {
//                     $('#jan_namenaja').append('<option value="'+val.Us_id+'">'+val.Us_id+'</option>');
////                        console.log(val.c_name)
//                      
//                    
//                });
//                $.each(data.data, function(k, v) {
//                        $('#jan_namenaja').append('<option value="'+v.Us_id+'">'+v.Us_id+'</option>');
//                });
            }
        });
    }
    function get_delete(id){
         $.ajax({
            url:"http://localhost/Mingkhun/delete-course.php",
             data:"&id="+id,
            type:"POST",
//            dataType:"JSON",
            success:function(data){
//                alert(data);
               
                    window.location.href = "http://localhost/Mingkhun/add-course.php";
                
                

            }
        });
    }
</script>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );
</script>