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
<h3>กรอกข้อมูลลูกค้า</h3>
<form action="processOrder.php" method="post">
  ชื่อ : 
  <input type="text" name="name" id=""><br>
  ที่อยู่ : 
  <textarea name="address" id="" cols="30" rows="10">
  </textarea><br>
  เบอร์โทร :
  <input type="text" name="phone" id="">

  <hr>
<h3>รายการที่สั่ง</h3>
<table class="table">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>สินค้า</th>
        <th>ราคา</th>
        <th>จำนวนสั่งซื้อ</th>
        <th>ราคารวม</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($_SESSION['product'] as $key=>$value){ 
        $total = $total+($value['price'] * $value['amount']);
        ?>
      <tr>
        <td><?php echo $value['id'] ?></td>
        <td><?php echo $value['name'] ?></td>
        <td><?php echo $value['price'] ?></td>
        <td><?php echo $value['amount'] ?></td>
        <td><?php echo ($value['price'] * $value['amount']) ?></td>
      </tr>
        <?php } ?>
    </tbody>
</table>
<strong>ราคาสุทธิ</strong> <?php echo $total ?><br>
<button type="submit">ยืนยัน</button>
</form>
</body>
</html>