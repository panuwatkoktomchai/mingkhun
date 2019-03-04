<?php

include "db.php";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
$haveuser = false;
$createtabel = "CREATE TABLE `musical`.`users` ( `id` INT NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(100) NOT NULL , `email` VARCHAR(200) NOT NULL , `tel` VARCHAR(10) NOT NULL , `cardid` TEXT NOT NULL , `address` TEXT NOT NULL , `gen` INT(2) NOT NULL , `status` INT(2) NOT NULL, `approve` INT(2) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `create_at` DATE NOT NULL , `photo` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
$checktable = "show tables;";
$tabel = $conn->query($checktable);
foreach ($tabel->fetch_assoc() as $key => $value) {
    if ($value == "users") {
        $haveuser = true;
    }
}
if (!$haveuser) {
    if ($conn->query($createtabel)==false) {
    echo "<script> alert('create tabel user false:".$conn->error."');</script>";    
    $conn->close();
    }else {
    echo "<script> alert('Create table success');</script>";    
    # code...
    }
}


?>