<?php 

$servername = "localhost";
$username = "mario";
$password = "leavemealone";
$dbname = "musical";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");