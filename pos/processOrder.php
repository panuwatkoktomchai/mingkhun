<?php
session_start();
include "../db.php";
$products_needed = false;
$outofproduct = [];
foreach ($_SESSION['product'] as $key => $value) {
    $sql = "select unit from products where id = ".$value['id'];
    $unit = $conn->query($sql);
    $unit = $unit->fetch_assoc();
    if ($value['amount'] > $unit['unit']) {
        $products_needed = true;
        array_push($outofproduct,$value);
    }
}

if ($products_needed) {
    $_SESSION['outofproduct'] = $outofproduct;
    header('Location:show_outofproduct.php');
    exit;
}else{
    $order = "insert into order_products values(null, '".date('Y-m-d H:i:s')."', ".$_SESSION['id'].", 1, '".$_POST['address']."', '".$_POST['name']."', '".$_POST['phone']."');";
    if ($conn->query($order)) {
        $id = $conn->insert_id;
        foreach ($_SESSION['product'] as $key => $value) {
            $insert_list = "insert into order_product_list values (null, ".$value['id'].", '".date('Y-m-d H:i:s')."', ".$value['amount'].", ".$id." )";
            $conn->query($insert_list);
        }
        unset($_SESSION['product']);
        header('location:selectProduct.php');
    }else {
        echo $conn->error;
    }
}
?>