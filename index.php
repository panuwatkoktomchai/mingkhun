<?php 

session_start();
error_reporting(0);
switch ($_SESSION['status']) {
  case 1:
// ถ้าเป็น addmin
include "navbar-admin.php";
      break;
  case 2:
// ถ้าเป็น employee
include "navbar-employee.php";
      break;
  case 3:
// ถ้าเป็น Teacher
include "navbar-teacher.php";
      break;
  case 4:
// ถ้าเป็นสมาชิกทั่วไป
include "navbar-owner.php";
      break;
      case 5:
      // ถ้าเป็นสมาชิกทั่วไป
      include "navbar-member.php";
            break;

  default:
// ถ้าไม่login
include "navbar.php";
header('Location:index.php');
      break;
}

?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<title>หน้าหลัก</title>
<style>
/*
Fade content bs-carousel with hero headers
Code snippet by maridlcrmn (Follow me on Twitter @maridlcrmn) for Bootsnipp.com
Image credits: unsplash.com
*/

/********************************/
/*       Fade Bs-carousel       */
/********************************/
.fade-carousel {
    position: relative;
    height: 100vh;
}
.fade-carousel .carousel-inner .item {
    height: 100vh;
}
.fade-carousel .carousel-indicators > li {
    margin: 0 2px;
    background-color: #f39c12;
    border-color: #f39c12;
    opacity: .7;
}
.fade-carousel .carousel-indicators > li.active {
  width: 10px;
  height: 10px;
  opacity: 1;
}

/********************************/
/*          Hero Headers        */
/********************************/
.hero {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 3;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    text-shadow: 1px 1px 0 rgba(0,0,0,.75);
       -webkit-transform: translate3d(-50%,-50%,0);
       -moz-transform: translate3d(-50%,-50%,0);
       -ms-transform: translate3d(-50%,-50%,0);
       -o-transform: translate3d(-50%,-50%,0);
       transform: translate3d(-50%,-50%,0);
}
.hero h1 {
    font-size: 6em;    
    font-weight: bold;
    margin: 0;
    padding: 0;
}

.fade-carousel .carousel-inner .item .hero {
    opacity: 0;
    -webkit-transition: 2s all ease-in-out .1s;
       -moz-transition: 2s all ease-in-out .1s; 
        -ms-transition: 2s all ease-in-out .1s; 
         -o-transition: 2s all ease-in-out .1s; 
            transition: 2s all ease-in-out .1s; 
}
.fade-carousel .carousel-inner .item.active .hero {
    opacity: 1;
    -webkit-transition: 2s all ease-in-out .1s;
       -moz-transition: 2s all ease-in-out .1s; 
        -ms-transition: 2s all ease-in-out .1s; 
         -o-transition: 2s all ease-in-out .1s; 
            transition: 2s all ease-in-out .1s;    
}

/********************************/
/*            Overlay           */
/********************************/
.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: #080d15;
    opacity: .7;
}

/********************************/
/*          Custom Buttons      */
/********************************/
.btn.btn-lg {padding: 10px 40px;}
.btn.btn-hero,
.btn.btn-hero:hover,
.btn.btn-hero:focus {
    color: #f5f5f5;
    background-color: #1abc9c;
    border-color: #1abc9c;
    outline: none;
    margin: 20px auto;
}

/********************************/
/*       Slides backgrounds     */
/********************************/
.fade-carousel .slides .slide-1, 
.fade-carousel .slides .slide-2,
.fade-carousel .slides .slide-3 {
  height: 100vh;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
}
.fade-carousel .slides .slide-1 {
  background-image: url(https://wallpapercave.com/wp/wp2373796.jpg); 
}
.fade-carousel .slides .slide-2 {
  background-image: url( http://getwallpapers.com/wallpaper/full/8/7/3/328035.jpg);
}
.fade-carousel .slides .slide-3 {
  background-image: url(https://ununsplash.imgix.net/photo-1416339276121-ba1dfa199912?q=75&fm=jpg&s=9bf9f2ef5be5cb5eee5255e7765cb327);
}

/********************************/
/*          Media Queries       */
/********************************/
@media screen and (min-width: 980px){
    .hero { width: 980px; }    
}
@media screen and (max-width: 640px){
    .hero h1 { font-size: 4em; }    
}

/**ของ button **/
.btn{
  width: 200px;
  height: 50px;
  margin-left: 7.5%;
  margin-top: 15px;
  border: none;
  border-radius: 30px;
  font-size: 1.5rem;
  font-weight: 800;  
  padding-bottom: 3px;
  color: white;
  moz-transition: all .4s ease-in-out;
  -o-transition: all .4s ease-in-out;
  -webkit-transition: all .4s ease-in-out;
  transition: all .4s ease-in-out;
  background-size: 300% 100%;
  
}

.btn:hover{
  background-position: 100% 0;
}

.btn1{
  background-image: linear-gradient(to right, red, yellow, yellow, red);
}
.btn2{
  background-image: linear-gradient(to right, rgb(1, 19, 37), rgb(200, 19, 37), rgb(200, 19, 37), rgb(1, 19, 37));
}
.btn3{
  background-image: linear-gradient(to right,  rgb(77, 19, 77),  rgb(225, 77, 77),rgb(77, 19, 77));
}
.btn4{
  background-image: linear-gradient(to right, rgb(77, 19, 200),  rgb(130, 77, 10),rgb(77, 19, 200));
}
.btn5{
  background-image: linear-gradient(to right, rgb(10, 225, 130),  rgb(10, 77, 77),rgb(10, 225, 130));
}
.btn6{
  background-image: linear-gradient(to right, rgb(10, 225, 200),  rgb(200, 200, 77),rgb(10, 225, 200));
}
.btn7{
  background-image: linear-gradient(to right, rgb(225, 105, 100), rgb(225, 125, 10),rgb(190, 25, 100), rgb(190, 25, 100));
}
.btn8{
  background-image: linear-gradient(to right, rgb(225, 10, 140),  rgb(225, 10, 90),rgb(225, 10, 30), rgb(225, 250, 0),  rgb(225, 250, 0),rgb(225, 10, 30), rgb(225, 10, 90), rgb(225, 10, 140));
}


</style>



<div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
  <!-- Overlay -->
  <div class="overlay"></div>

 
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item slides active">
      <div class="slide-1"></div>
      <div class="hero">
        <hgroup>
            <h1 style="color:#FFCC00;">MINGKHUN<br>Music & Sport</h1>        
            <h3>โรงเรียนสอนและจำหน่ายเครื่องดนตรี</h3>
        <!--<button class="btn btn-hero btn-lg btn1" role="button" onclick="window.location.href='login.php'">เข้าสู่ระบบ</button>-->
      </div>
    </div>

    
    </div>
  </div> 
</div>