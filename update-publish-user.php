<?php 

include "db.php";

session_start();

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES UTF8");
$obj = '';
foreach ($_REQUEST as $key => $value) {
    if ($key=='id' || $key == 'p' || $key == 'table') {
        continue;
    }
    $obj = $obj."".$key."='".$value."', ";
}
$sql = "UPDATE ".$_REQUEST['table']." SET ".$obj." create_at='".Date('Y-m-d')."' WHERE id = '".$_REQUEST['id']."';";
if($conn->query($sql)==true){
    $_SESSION['fullname'] = $_REQUEST['mb_name'];
    header('Location:profile-member.php');
}else{
    // echo "<script>alert('อัพเดทข้อมูลล้มเหลว')</scirpt>";
    echo "update error: ".$conn->error."<br>";
    echo $sql;
    // header('Location:add-users.php');
}
    