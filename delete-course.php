<?php 
include "db.php";
session_start();
//echo $_POST['jan_name'];
$sql = "delete from course where c_id = '".$_POST['c_id']."'";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->query($sql)== true) {
    echo "yes";
//    header("Refresh:0; url= http://localhost/Mingkhun/add-course.php/");
//    header('Location: ');
}else{
    echo $conn->error;
}