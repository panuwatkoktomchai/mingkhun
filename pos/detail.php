<?php 
include "../db.php";
$str = "select products.*, category_product.cate_name from products left join category_product on products.category = category_product.cate_id where products.id = ".$_GET['id'];
$data = $conn->query($str);
$data = $data->fetch_assoc();
?>


<h1>รายละเอียด</h1>
<strong>ชื่อ </strong><?php echo $data['name']; ?> <br>
<strong>ประเภท </strong><?php echo $data['cate_name']; ?> <br>
<strong>ราคา </strong><?php echo $data['price']; ?> <br>
<strong>คงเหลือ </strong><?php echo $data['unit']; ?> <br>
<img src="../<?php echo $data['photo'] ?>" alt="">