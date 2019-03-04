<?php 
include "db.php";
session_start();


/**
 * check id product
 */
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$sql = "SELECT id FROM products WHERE id = ".$_REQUEST['id'];
$data = $conn->query($sql);
if ($data->num_rows > 0) {
    $_SESSION['alert']['status'] = "warning";
    $_SESSION['alert']['message'] = "รหัสสินค้านี้มีอยู่แล้ว กรุณาลองใหม่อีกครั้ง";
    echo "<script> history.go(-1); </script>";
        // header('Location:add-product.php');
    // echo "<script>alert('รหัสสินค้านี้มีอยู่แล้ว กรุณาลองใหม่อีกครั้ง'); window.location='add-product.php';</script>";
}else{
    $file = "uploads/default.jpg";
    // echo exec('whoami');
    if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"uploads/products/".$_FILES["filUpload"]["name"]))
    {
        $filepath = "uploads/products/".$_FILES['filUpload']['name'];
        // echo "Copy/Upload Complete";
    }
    // echo $filepath;

    


    $sql = "insert into products (id,name,category,unit,create_at,user,status,photo) value (null,'".$_REQUEST['name']."',".$_REQUEST['category']."";
    $sql = $sql.",".$_REQUEST['unit'].",'".Date('Y-m-d')."',".$_SESSION['id'].",1,'".$filepath."');";
    mysqli_query($conn, "SET NAMES UTF8");
    echo $sql;
    if ($conn->query($sql)== true) {
        $_SESSION['alert']['status'] = "success";
        $_SESSION['alert']['message'] = "บันทึกข้อมูลสำเร็จ";
        header('Location:'.$_GET['p']);
    }else{
        $_SESSION['alert']['status'] = "success";
        $_SESSION['alert']['message'] = "ERROR! at ".$conn->error;
        header('Location:'.$_GET['p']);
    }

}