<?php 
session_start();
$total = 0;
$sell_id = rand(10,999999999);
include "db.php";

if (!isset($_SESSION['list'])) {
    header('Location:sell.php');
}

foreach ($_SESSION['list'] as $key => $value) {
    $amount_product = "select unit from products where id = ".$key;
    $res = $conn->query($amount_product)->fetch_assoc();
    // echo $res['unit'];
    if ($res['unit']< $value['amount']) {
        echo "<script> alert('จำนวนสินค้าในสต๊อกไม่เพียงพอสำหรับขาย id : ".$key." สินค้า : ".$value['name']."'); </script>";
        echo "<a href='get-product.php'>ไปหน้ารับสินค้า</a>";
        exit;
    }
    
}

//get shop information
$shop = "select * from shop where id = 1";
$res = $conn->query($shop);
$shop = $res->fetch_assoc();
?>
<style>
    table, th, td {
    border: 1px solid black;
}
</style>

<div id = "print">
<div align = "center">
<h1> ใบเสร็จรับเงิน </h1>
<h3><?php echo $shop['name'] ?></h3>
</div>
<hr>
รหัสบิล <?php echo $sell_id ?> <br>
วันที่ : <?php echo date('Y-m-d h:m:s'); ?><br>
ที่อยู่ :<?php echo $shop['address'] ?><br>
ผู้ขาย <?php echo $_SESSION['fullname'] ?>

<hr>

<div style="padding-left:50px;padding-right:50px;">
    <table style="width:100%">
        <thead>
            <tr>
                <td>รหัส</td>
                <td>รายการสินค้า</td>
                <td>จำนวน</td>
                <td>ราคา</td>
                <td>ราคารวม</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION['list'] as $key=>$value){ ?>
            <tr>
            <?php 
                $total = $total + ($value['price'] * $value['amount']);
            ?>
                <td><?php echo $value['id'] ?></td>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['amount'] ?></td>
                <td><?php echo $value['price'] ?></td>
                <td><?php echo $value['price'] * $value['amount'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    จำนวน <?php echo count($_SESSION['list']); ?> <br>
    ราคารวมสุทธิ <?php echo number_format($total,2); ?>
</div>
<div>
<button onclick="printDiv('print')">Print</button><a href="sell.php">เสร็จสิ้นการขาย</a href="sell.php">
<?php
// session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
$date = date('Y-m-d');
$sell = "insert into sell (id, user_id, date, amount, total) values (".$sell_id.", ".$_SESSION['id'].", '".$date."', ".count($_SESSION['list']).", ".$_SESSION['total'].")";
$conn->query($sell);
foreach ($_SESSION['list'] as $key => $value) {
    $sql = "insert into history_sell (id, product_id, amount, user_id, date, sell_id) values (null, ".$value['id'].", ".$value['amount'].", ";
    $sql = $sql.$_SESSION['id'].", '".$date."', ".$sell_id.")";
    $conn->query($sql);
    $cut_stock = "update products set unit = unit - ".$value['amount']." where id = ".$value['id'].";";
    $conn->query($cut_stock);
}
$conn->close();
unset($_SESSION['list']);
unset($_SESSION['total']);
unset($_SESSION['amount']);
unset($_SESSION['show']);
// header('Location:sell.php');

?>

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>