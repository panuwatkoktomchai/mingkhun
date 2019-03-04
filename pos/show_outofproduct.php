<?php 
session_start();
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>รายการสินค้าหมด ไม่สามารถสั่งซื้อได้</h1>
<table class="table">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>สินค้า</th>
        <th>จำนวนคงเหลือ</th>
        <th>จำนวนสั่งซื้อ</th>
        <th>ขาดไป</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($_SESSION['outofproduct'] as $key=>$value){ 
        ?>
      <tr>
        <td><?php echo $value['id'] ?></td>
        <td><?php echo $value['name'] ?></td>
        <td><?php echo $value['unit'] ?></td>
        <td><?php echo $value['amount'] ?></td>
        <td><?php echo $value['amount'] - $value['unit'] ?></td>
      </tr>
        <?php } ?>
    </tbody>
</table>
<a class="btn btn-primary" href="../get-product.php">รับสินค้าเพิ่ม</a>
</body>
</html>