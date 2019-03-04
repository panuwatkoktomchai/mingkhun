<?php

include "db.php";
$clear = "DELETE FROM `shop` WHERE `shop`.`id` = 1";
$sql = "insert into shop values (1, '".$_REQUEST['name']."', '".$_REQUEST['address']."', '".$_REQUEST['tel']."')";

$conn->query($clear);
$conn->query($sql);
header('Location:shop-information.php');
?>