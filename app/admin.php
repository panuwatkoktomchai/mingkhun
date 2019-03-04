<?php 

include "db.php";

$insert = "INSERT INTO `users` (`id`, `fullname`, `email`, `tel`, `address`, `gen`, `status`, `approve`, `username`, `password`, `create_at`, `photo`) VALUES (1, 'admin', 'admin@gmail.com', '0987654323', 'Shop', '2', '1','1', 'admin@gmail.com', 'admin', '2018-08-31', '/upload')";
$conn = new mysqli($servername, $username, $password,$dbname);
$getadmin = "SELECT * FROM users WHERE username = 'admin@gmail.com' AND password = 'admin'";
$result = $conn->query($getadmin);

if ($result->num_rows > 0) {
    
} else {
    if ($conn->query($insert)==true) {
    echo "<script> alert('created user admin');</script>";    
    }else {
    echo "<script> alert('Insert admin false : ".$conn->error."');</script>";            
    }
}
$conn->close();



// if ($res->num_rows < 0) {
//     if ($conn->query($insert) == true) {
//         echo "<script> alert('insert default admin ok');</scritp>";
//     }else{
//         echo $conn->error;
//     }
// }
