<?php 
include "connect.php";
include "app/user.php"; 
include "app/admin.php";
include "db.php";

/**
 * Create product tabel
 */
$create_products = "CREATE TABLE IF NOT EXISTS `musical`.`products` ( `id` INT(5) UNSIGNED ZEROFILL NOT NULL  , `name` VARCHAR(100) NOT NULL , `photo` VARCHAR(200) NOT NULL , `category` INT NOT NULL , `price` INT NOT NULL, `discount` INT NOT NULL , `unit` INT NOT NULL , `create_at` INT NOT NULL , `user` INT NOT NULL , `status` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
if ($conn->query($create_products)) {
    echo "Create table product success <br><br>";
}else{
    echo "Create table product false :: ".$conn->error."<br><br>";
}

$create_seller = "CREATE TABLE IF NOT EXISTS `musical`.`seller` ( `id` INT(5) UNSIGNED ZEROFILL NOT NULL  , `name` VARCHAR(100) NOT NULL , `address` TEXT NOT NULL , `logo` VARCHAR(100) NOT NULL , `phone` VARCHAR(20) NOT NULL , `owner` VARCHAR(100) NOT NULL , `user` INT NOT NULL , `create_at` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if ($conn->query($create_seller)) {
    echo "Create table seller success <br><br>";
}else{
    echo "Create table seller false :: ".$conn->error."<br><br>";
}

$checkin = "CREATE TABLE IF NOT EXISTS `musical`.`check_in_products` ( `id` INT(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT , `user_id` INT NOT NULL ,`product_id` INT NOT NULL ,`seller_id` INT NOT NULL , `date` DATE NOT NULL , `amount` INT NOT NULL , `get_price` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if ($conn->query($checkin)) {
    echo "Create table check_in_product success <br><br>";
}else{
    echo "Create table check_in_product false :: ".$conn->error."<br><br>";
}
$member = "CREATE TABLE IF NOT EXISTS `musical`.`member` ( `id` INT NOT NULL AUTO_INCREMENT , `mb_name` VARCHAR(100) NOT NULL , `mb_mail` VARCHAR(200) NOT NULL , `mb_tel` VARCHAR(10) NOT NULL , `mb_add` TEXT NOT NULL , `mb_gen` VARCHAR(100) NOT NULL , `mb_age` INT(2) NOT NULL , `mb_user` VARCHAR(100) NOT NULL , `mb_pass` VARCHAR(100) NOT NULL , `mb_pass_confirm` VARCHAR(100) NOT NULL , `create_at` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if ($conn->query($member)) {
    echo "insert member success <br><br>";
}else{
    echo "insert seller false :: ".$conn->error."<br><br>";
}

$history_sell = "CREATE TABLE IF NOT EXISTS `musical`.`history_sell` ( `id` INT(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT , `product_id` INT(5) UNSIGNED ZEROFILL NOT NULL , `amount` INT(7) NOT NULL , `user_id` INT(5) UNSIGNED ZEROFILL NOT NULL , `date` DATE NOT NULL , `sell_id` INT(10) UNSIGNED ZEROFILL NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if ($conn->query($history_sell)) {
    echo "insert history_sell success <br><br>";
}else{
    echo "insert history_sell false :: ".$conn->error."<br><br>";
}

$sell = "CREATE TABLE IF NOT EXISTS `musical`.`sell` ( `id` INT(10) UNSIGNED ZEROFILL NOT NULL , `user_id` INT(5) UNSIGNED ZEROFILL NOT NULL , `date` DATE NOT NULL , `amount` INT(5) NOT NULL , `total` INT(7) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if ($conn->query($sell)) {
    echo "insert sell success <br><br>";
}else{
    echo "insert sell false :: ".$conn->error."<br><br>";
}

$category_product = "CREATE TABLE IF NOT EXISTS `musical`.`category_product` ( `cate_id` INT(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT , `cate_name` VARCHAR(100) NOT NULL , `user_id` INT(5) UNSIGNED ZEROFILL NOT NULL , `create` DATE NOT NULL , PRIMARY KEY (`cate_id`)) ENGINE = InnoDB;";
if ($conn->query($category_product)) {
    echo "insert category_product success <br><br>";
}else{
    echo "insert category_product false :: ".$conn->error."<br><br>";
}

$shop = "CREATE TABLE IF NOT EXISTS `musical`.`shop` ( `id` INT NOT NULL , `name` VARCHAR(200) NOT NULL , `address` TEXT NOT NULL , `tes` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
if ($conn->query($category_product)) {
    echo "insert shop success <br><br>";
}else{
    echo "insert shop false :: ".$conn->error."<br><br>";
}