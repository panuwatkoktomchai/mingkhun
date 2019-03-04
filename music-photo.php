<?php
include "db.php";
$sql = "SELECT * FROM `music_course`";
$obj = $conn->query($sql);
$data = $obj->fetch_assoc();

?>
<meta charset="UTF-8">
<?php include 'navbar-employee.php';?> 

<?php
include "db.php";
if(empty($_SESSION['id'])){
  $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id'].";";
    header('Location:login.php'); 
}

if (isset($_REQUEST['delete'])) {
        $sql = "DELETE FROM music_course_file WHERE id = ".$_REQUEST['delete'];
        $conn->query($sql);
        unlink($_REQUEST['file']);
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "ลบข้อมูลจาก ID : ".$_REQUEST['id']." เรียบร้อย";
        header('Location:music-photo.php?id='.$_REQUEST['id']);
}
    $get = "select * from music_course";
    $res = $conn->query($get);
?>
<head>
<!-- CSS -->
<link rel="stylesheet" href="css/add_style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title>เพิ่ม / จัดการรูปภาพ</title>
</head>
<body>

<style>

body{
 background-color: #fff ;
}

</style>

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




<!-- end alert -->
<div class="row">
    <div class="col-md-12">
<section>      
        <h1 class="entry-title"><span>เพิ่มรูปภาพ</span> </span> </h1>
        <hr>
       

    <form class="form-horizontal" action="insert-music-photo.php?p=music-photo.php&id=<?php echo $_REQUEST['id'] ?>" method="POST" enctype="multipart/form-data" >  
        <div class="form-group"> 
          <label class="control-label col-sm-2">อัพโหลดรูปภาพ</label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input required type="file" name="filUpload[]" id="filUpload" multiple="multiple" class="form-control upload" placeholder="">
            </div>
          </div>
        <br><br>  
        <div class="form-group">
          <div class="col-xs-offset-2 col-sm-8">
          <button type="submit" class="btn btn-primary" >เพิ่ม</button>
        </div>
</form>

<br><br><br>


<?php

$get = "select * from music_course_file where music_course_id = ".$_REQUEST['id'];
// echo $get;  
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$data = $conn->query($get);
?>


<!--------------------------------------------------------------------------tableที่จะเปลี่ยน-->

<section>      
        <h1 class="entry-title"><span>ข้อมูลรูปภาพ</span> </h1>
        <hr>
	
<table id = "datable" class="display table">
    <thead class="thead-light">
      <tr>
        <th>รูปภาพ</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody> 
        <?php
        foreach ($data as $key => $value) {
        ?>
            <tr>
            <td> <img src="<?php echo $value['file_path'] ?>" alt="" width = "140px"> </td>

            <td>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?php echo $value['id'] ?>">ลบ</button>
            </td>
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
                    <a href="?delete=<?php echo $value['id']?>&file=<?php echo $value['file_path'] ?>&id=<?php echo $_REQUEST['id'] ?>" class="btn btn-danger">ลบ</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Modal -->
            </tr>
     
        <?php
        }
        ?>
    </tbody>
  </table>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable').DataTable();
} );

$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});  
</script>

<!-- <script src="js/jquery-2.1.4.js"></script> -->
<!-- <script src="js/jquery.menu-aim.js"></script> -->
<!-- <script src="js/main.js"></script> Resource jQuery -->
</body>
</html>