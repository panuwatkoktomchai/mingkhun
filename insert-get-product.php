<?php 
    include "db.php";
    session_start();
    $conn = new mysqli($servername, $username, $password, $dbname);
    mysqli_query($conn, "SET NAMES UTF8");
    $sqlorder = "INSERT INTO check_in_order VALUES (null, ".$_SESSION['id']." ,'".date("Y-m-d h:i:s")."');";
    $res = $conn->query($sqlorder);
    $id = mysqli_insert_id($conn);
    foreach($_SESSION['getpro'] as $key=>$value){    
        $sql = "insert into check_in_products (id, user_id, product_id, date, amount, get_price, seller_id, order_id) values (null, ".$_SESSION['id'].",".$value['product_id'].", '".date('Y-m-d')."', ".$value['amount'].", ".$value['get_price'].", ".$value['seller_id'].",".$id.")";
        if ($conn->query($sql) == true) {
            $sql = "update products set unit = unit+".$value['amount']." where id = ".$value['product_id'];
            if ($conn->query($sql) == true) {
                // echo("<script> alert('เพิ่มข้อมูลสำเร็จ'); window.location='get-product.php';</script>");
            }else{
                // echo "update product eroro: ".$conn->error;
            }
        }else {
            // echo "insert product eroro: ".$conn->error;
        }
    }
    unset($_SESSION['getpro']);
    header('Location:list-get-product.php?id='.$id);
            // echo("<script> alert('เพิ่มข้อมูลสำเร็จ'); window.location='get-product.php';</script>");


?>