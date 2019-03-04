<?php 

session_start();

$_SESSION['product'][$_REQUEST['id']] = $_REQUEST;

print_r($_SESSION['product']) ;