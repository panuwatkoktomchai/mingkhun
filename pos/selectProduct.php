<?php
    session_start();
    error_reporting(0);
    include "../db.php";
    $str = "select * from products";
    $strCat = "SELECT * FROM category_product";
    $category = $conn->query($strCat);
    if (isset($_POST['category']) && $_POST['category'] != 'all') {
        $str = $str." where category = ".$_POST['category'];
    }else {
        $_POST['category'] = "all";
    }
    $products = $conn->query($str);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>POS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<p>
<a href="cart.php" class="btn btn-default btn-sm"> 
    <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart <span class="badge badge-danger"><?php echo count($_SESSION['product']) ?></span>
</a>
</p>
  <h2>เลือกสินค้า</h2>
  <p>The .img-rounded class adds rounded corners to an image (not available in IE8):</p> 
  <form action="" method="post"> 
    <label for="category">ประเภทสินค้า</label>   
    <select onchange="this.form.submit()" class="form-control" name="category" id="category">
            <option <?php echo $_POST['category'] == 'all' ? 'selected' : '' ?> value="all" >ทั้งหมด</option>
        <?php foreach($category as $key=>$cat){ ?>
            <option value="<?php echo $cat['cate_id'] ?>" <?php echo $_POST['category'] == $cat['cate_id'] ? 'selected' : '' ?> ><?php echo $cat['cate_name'] ?></option>
        <?php } ?>
    </select>
  </form>
  <div class="row">
    <?php foreach($products as $value) { ?>
    <div class="col col-md-3">
        <img src="../<?php echo $value['photo'] ?>" class="img-rounded" alt="Cinque Terre" width="304" height="236"> 
        <div ><?php echo $value['name'] ?></div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#<?php echo $value['id'] ?>">หยิบใส่ตระกร้า</button>
        <a href="detail.php?id=<?php echo $value['id'] ?>" class="btn btn-info" href="">รายละเอียด</a>
    </div>
    
    <div class="modal fade" id="<?php echo $value['id'] ?>" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="addCart.php?id=<?php echo $value['id'] ?>" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ระบุจำนวน</h4>
          </div>
          <div class="modal-body">
              <input autofocus class="form-control" required type="number" name="amount">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" >ยืนยัน</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
          </div>
            </form>
        </div>
      </div>
    </div>

    <?php } ?>
  </div>           
</div>

</body>
</html>
