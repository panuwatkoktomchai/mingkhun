<!doctype html>
<html lang="en" class="no-js">
<?php include 'navbar-member.php';?>
<title>ช่องทางชำระเงิน</title>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSS -->



<style>
/*Don't copy this part*/

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




/*Business Card Css */
.business-card {
  border: 1px solid #cccccc;
  background: #FFCC99;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 10px;
}
.profile-img {
  height: 120px;
  background: white;
}
.job {
  color: #666666;
  font-size: 17px;
}
.mail {
  font-size: 16px;
 }
</style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
<?php 

include "db.php";

$sql = "select * from payment_acout";
$data = $conn->query($sql);

?>

<br>
<div class="container">
<div class="row">
<div class="col-md-12">
    <section>      
        <h1 class="entry-title" style="color:white"><span>ช่องทางชำระเงิน</span> </h1>
        <hr>

<?php foreach($data as $key=>$value){ ?>


<div class="container">
	<div class="row">
        <div class="col-sm-8">
            <div class="business-card">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object img-circle profile-img" src="<?php echo $value['photo'] ?>">
                    </div>
                    <div class="media-body">
                        <h2><?php echo $value['idacout']; ?></h2>
                        <h5>ชื่อบัญชี : <?php echo $value['nameacout']; ?></h5>
                        <h5>ธนาคาร : <?php echo $value['bankacout']; ?></a> </h5>
                    </div>
                </div>
            </div>
        </div>
        

<?php } ?> 
</body>
