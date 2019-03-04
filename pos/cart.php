<?php 
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <a href="selectProduct.php">back</a>
  <h2>รายการที่เลือก</h2>
  <p>
    <a class="btn btn-primary" href="confirmOrder.php">ยืนยันการสั่งซื้อ</a>
  </p>
  <div class="row">

    <?php foreach($_SESSION['product'] as  $value){ ?>
    <div class="col-md-4">
      <div class="thumbnail">
        <a href="" >
          <img src="../<?php echo $value['photo'] ?>" alt="Lights" style="width:100%">
          <div class="caption">
            <p>ชื่อ <?php echo $value['name'] ?></p>
            <p>ราคา <?php echo $value['price'] ?></p>
            <p>จำนวน <?php echo $value['amount'] ?></p>
            
          </div>
        </a>
       
        <a class="btn btn-danger" href="delete.php?id=<?php echo $value['id'] ?>">ลบ</a>
      </div>
    </div>
    <?php } ?>

  </div>
</div>

</body>
</html>


