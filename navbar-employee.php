<?php 
error_reporting(0);
session_start();
include "connect.php";
include "app/user.php"; 
include "app/admin.php";
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body
{
    background: #FFCC66		 url("loginbg.jpg") no-repeat right top;
}

.bs-dark.navbar-inverse {
  background-color: #222;
  border-color: #080808;
}
.bs-dark .navbar-img {padding:5px 6px !important;}
.bs-dark .navbar-img img {width:40px;}
.bs-dark .dropdown-menu {
  min-width: 200px;
  padding: 5px 0;
  margin: 2px 0 0;
  background-color: #000;
  border: 1px solid rgba(0, 0, 0, 0.7);
  border: 1px solid rgba(0, 0, 0, .15);
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
          box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.bs-dark .dropdown-menu .divider {
  border: 1px solid rgba(0, 0, 0, 0.8);
}
.bs-dark .dropdown-menu > li > a {
  padding: 6px 20px;
  color: rgba(255,255,255,0.80);
}
.bs-dark .dropdown-menu > li > a:hover,
.bs-dark .dropdown-menu > li > a:focus {
  color: rgba(255,255,255,0.70);
  text-decoration: none;
  background-color: transparent;
}
.bs-dark .dropdown-menu > .active > a,
.bs-dark .dropdown-menu > .active > a:hover,
.bs-dark .dropdown-menu > .active > a:focus {
  color: rgba(255,255,255,0.70);
  text-decoration: none;
  background-color: transparent;
  outline: 0;
}

.bs-dark .navbar-form {
  margin:0;
  margin-top: 5px;
  padding:8px 0px;
}
 
.bs-dark .navbar-form .search-box {
  border:0px;
  height:35px;
  outline: none;
  width:320px;
  padding-right: 3px;
  padding-left: 15px;
  margin:4px;
  -webkit-border-radius: 22px;
  -moz-border-radius: 22px;
  border-radius: 22px;
}
 
.bs-dark .navbar-form button {
  border: 0;
  background: none;
  padding: 2px 5px;
  margin-top: 2px;
  position: relative;
  left: -34px;
  margin-bottom: 0;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}
 
.bs-dark .search-box:focus + button {
  z-index: 3;   
}

@media (min-width: 768px) {
    .bs-dark .dropdown:hover {background-color: #000;}
	.bs-dark .dropdown:hover .dropdown-menu {
	  display: block;
	}
	.bs-dark .navbar-form {
	  padding:0px;
	}	
	.bs-dark .navbar-form .search-box {
	  width:260px;
	  height:32px;
	}

}

</style>
<?php session_start();
  if ($_SESSION['status'] != 2) {
    Header('Location:forbidden.php');
  }
?>

 <!------------- Navbar -------------->
    <nav class="navbar-inverse bs-dark">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">MINGKHUN</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

          <li class="dropdown">
              <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">จัดการข้อมูลพื้นฐาน<span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="seller.php">ข้อมูลตัวแทนจำหน่าย</a></li>
                <li><a href="add-product.php">ข้อมูลสินค้า</a></li>
                <li><a href="Add_category_product.php">ข้อมูลประเภทสินค้า</a></li>
                <li><a href="add-course.php">ข้อมูลรายวิชา</a></li>
                
                
              </ul>
            </li>
          
            <!--<li><a href="add-promotion.php">จัดการข้อมูลโปรโมชั่น<span class="sr-only"></span></a></li>-->
            <li><a href="show-member-course.php">ข้อมูลสมัครเรียน</a><span class="sr-only"></span></a></li>
            <li><a href="check_evidence.php">ยืนยันการสมัครเรียน</a><span class="sr-only"></span></a></li>
            <li><a href="get-product.php">รับสินค้า<span class="sr-only"></span></a></li>
            <li><a href="pos/selectProduct.php">ขายสินค้า<span class="sr-only"></span></a></li>
            <li><a href="#">ส่งสินค้า<span class="sr-only"></span></a></li>

            
            
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="employee.php" class="dropdown-toggle navbar-img" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              &nbsp;<?php  echo $_SESSION['fullname']; ?> (พนักงาน)
              
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Emblem-person-red.svg/1024px-Emblem-person-red.svg.png" class="img-circle" alt="Profile Image" /> &nbsp;
              </a>
              <ul class="dropdown-menu">
                
                <li><a href="profile-employee.php">จัดการข้อมูลส่วนตัว &nbsp;<span class="glyphicon glyphicon glyphicon-edit"></a></a></li>
                <li role="separator" class="divider"></li>
                <li><a href=javascript:if(confirm('ยืนยันการออกจากระบบ')==true){window.location='logout.php';}>ออกจากระบบ &nbsp;<span class="glyphicon glyphicon-log-out"></a></a></li>
              </ul>
            </li>
          </ul>
   
    </nav>
    <!----------- !Navbar End ------------>

	