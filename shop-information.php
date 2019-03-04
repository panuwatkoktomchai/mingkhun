
<?php
include "db.php";
$sql = "select * from shop";
$res = $conn->query($sql);
$data = $res->fetch_assoc();
?>
<form action="save-shop.php" method="post">
    ชื่อร้าน
    <input value="<?php echo $data['name'] ?>" name="name" type="text"><br>
    ที่อยู่
    <input value="<?php echo $data['address'] ?>" name="address" type="text"><br>
    เบอร์
    <input value="<?php echo $data['tes'] ?>" name="tel" type="text"><br>
    <input type="submit" value="บันทึก">
</form>