<?php 
include "db.php";
mysqli_query($conn, "SET NAMES UTF8");
session_start();
//echo $_POST['c_id'];
$status = "";
mysqli_query($conn, "SET NAMES UTF8");
if(trim($_POST['id']) == null){
    echo "id is null";
    $status = "0";
}
if(trim($_POST['c_name']) == null){
    echo "name is null";
   $status = "0"; 
}
if(trim($_POST['c_price']) == null){
    echo "detail is null";
   $status = "0"; 
}

if($status == "0"){
//   
       echo "it's null";        

}else{
//     
     echo "not null";
     if($_POST['us_id'] == ""){
        $sql = "update course set c_name = '".$_POST['c_name']."',c_price = '".$_POST['c_price']."', c_detail='".$_REQUEST['c_detail']."' where id = '".$_POST['id']."'";
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_query($conn, "SET NAMES UTF8");
            if ($conn->query($sql) == true) {
                $_SESSION['alert']['status'] = "success";
                $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
                header('Location:'.$_GET['p']);
            }else{
                $_SESSION['alert']['status'] = "danger";
                $_SESSION['alert']['message'] = "error : ".$conn->error;
                header('Location:'.$_GET['p']);
            }
    }else{
        $sql = "update course set c_name = '".$_POST['c_name']."',c_price = '".$_POST['c_price']."',Us_id = '".$_POST['us_id']."' where id = '".$_POST['id']."'";
        $conn = new mysqli($servername, $username, $password, $dbname);
        mysqli_query($conn, "SET NAMES UTF8");
        if ($conn->query($sql)== true) {
            $_SESSION['alert']['status'] = "success";
            $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
            header('Location:'.$_GET['p']);
        }else{
            $_SESSION['alert']['status'] = "danger";
            $_SESSION['alert']['message'] = "error : ".$conn->error;
            header('Location:'.$_GET['p']);
        }
    }
}





?>