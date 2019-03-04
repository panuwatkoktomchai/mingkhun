<?php 
session_start();
unset($_SESSION['product'][$_GET['id']]);
header("location:cart.php");
