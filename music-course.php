<?php include 'navbar-member.php';?>
<?php
include "db.php";
$get_couse = "select * from course";
$data = $conn->query($get_couse);
?>
<title>สมัครเรียนดนตรี</title>
<!-- CSS -->
<link rel="stylesheet" href="css/music-course_style.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">
  <head>
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<style>
body {
 
 overflow-x: hidden; 
 background-image: url('https://i.pinimg.com/originals/e4/98/1a/e4981a3dd4aa2fa6f0bc84cde9087c7a.jpg');


}

  .person {
      border: 10px solid transparent;
      margin-bottom: 25px;
      width: 80%;
      height: 80%;
      opacity: 0.7;
  }
  .person:hover {
      border-color: #f1f1f1;
  }
  </style>
</head>

<body>
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
	<div class="container">
		<?php foreach($data as $key=>$value) { ?>
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<?php
							$file = "select * from music_course_file where music_course_id = ".$value['id'];
							$file = $conn->query($file);
						?>
						<div id="myCarousel<?php echo $value['id'] ?>" class="carousel slide" data-ride="carousel" >
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<?php for ($i=0; $i < $file->num_rows; $i++) { ?>
									<li data-target="#myCarousel<?php echo $value['id'] ?>" data-slide-to="<?php echo $i; ?>" class="<?php if($i == 0 ){ echo "active";}?>"></li>									
								<?php }
								 ?>
							</ol>

							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<?php $i = 0; ?>
								<?php foreach($file as $key=>$values){ ?>
								<div class="item <?php if($i ==0 ){ echo "active"; } ?>">
									<div class="img-resize">
									<img src="<?php echo $values['file_path'] ?>" alt="New York" width="550px" height="200px">
									</div>
								</div>
								<?php $i++ ?>
								<?php } ?>

							</div>

							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel<?php echo $value['id'] ?>" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							
							<a class="right carousel-control" href="#myCarousel<?php echo $value['id'] ?>" role="button" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
					</div>

					</div>
					
					<div class="details col-md-6">
						<h1 class="product-title" style="color:red" >#<?php echo $value['c_name'] ?></h1>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
							</div>
						</div>
            
						
						<h5><?php echo $value['c_detail'] ?></b></h5>    
						<br>           
						<h4 class="price">ราคา <span> <?php echo $value['c_price'] ?> </span>บาท</h4>
						<br>
						<div class="action">
							<a class="add-to-cart btn btn-success" href="register-course.php?id=<?php echo $value['id'] ?>">สมัครเรียน</a>
							<!--<a class="add-to-cart btn btn-success" href="member-add-course.php?id=<?php echo $value['id'] ?>">สมัครเรียน</a>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
			<!-- end card -->
	</div> <br><br><br>
		<!-- end container -->


  </body>
</html>
