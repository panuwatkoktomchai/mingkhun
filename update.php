<?php 

include "db.php";
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$obj = '';
foreach ($_REQUEST as $key => $value) {
    if ($key=='id' || $key == 'p' || $key == 'table' || $key == "datable_length") {
        continue;
    } 
    $obj = $obj."".$key."='".$value."', ";
}
$sql = "UPDATE ".$_REQUEST['table']." SET ".$obj." create_at='".Date('Y-m-d')."' WHERE id = '".$_REQUEST['id']."';";
if($conn->query($sql)==true){
    if (isset($_FILES['filUpload'])) {
        if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"uploads/products/".$_FILES["filUpload"]["name"]))
        {
            $get_old_file = "select photo from ".$_REQUEST['table']." where id = ".$_REQUEST['id'];
            $data = $conn->query($get_old_file);
            $data = $data->fetch_assoc();
            unlink($data['photo']);
            $filepath = "uploads/products/".$_FILES['filUpload']['name'];
            $update = "UPDATE ".$_REQUEST['table']." SET photo = '".$filepath."' WHERE id = ".$_REQUEST['id'];
            $conn->query($update);
            $conn->close();
            $_SESSION['alert']['status']  = "success";
            $_SESSION['alert']['message']  = "อัพเดทข้อมูลเรียบร้อย";
            header('Location:add-product.php');
        }else{
            $_SESSION['alert']['status']  = "success";
            $_SESSION['alert']['message']  = "อัพเดทข้อมูลเรียบร้อย";
            header('Location:add-product.php');

        }
        // echo $filepath;
    
    }else{
        $_SESSION['alert']['status']  = "success";
        $_SESSION['alert']['message']  = "อัพเดทข้อมูลเรียบร้อย";
        header('Location:add-product.php');
        // echo "no uploadfile";
    }
    
}else{
    // echo "<script>alert('อัพเดทข้อมูลล้มเหลว')</scirpt>";
    $_SESSION['alert']['status']  = "danger";
    $_SESSION['alert']['message']  = $conn->error;
    //echo " this update error: ".$conn->error;
    header('Location:add-product.php');
}



