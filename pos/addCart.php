<?php 
session_start();
include "../db.php";

$sql = "SELECT * FROM products WHERE id = ".$_GET['id'];
$data = $conn->query($sql);
$data = $data->fetch_assoc();

$_SESSION['product'][$_GET['id']] = $data;
$_SESSION['product'][$_GET['id']]['amount'] = $_POST['amount'];
header("location:selectProduct.php");