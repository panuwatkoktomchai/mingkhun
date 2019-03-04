<?php
    session_start();
    include "db.php";
    
    if (empty($_REQUEST['username']) || empty($_REQUEST['password'])) {
        header("Location:index.php?url=login&message=login false");
    }else {
            $sql = "SELECT * FROM member WHERE mb_user = '".$_REQUEST['username']."' AND mb_pass = '".$_REQUEST['password']."';";
            $conn = new mysqli($servername, $username, $password,$dbname);            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $_SESSION['fullname']=$row['mb_name'];  
                  $_SESSION['username']=$row['mb_user'];
                  $_SESSION['email']=$row['mb_mail'];  
                  $_SESSION['status']= 4;
                  $_SESSION['id']=$row['id'];
                }

                header('Location:member.php');
                // print_r($result);
                // echo $conn->error;
            } else {
                header('Location:member-login.php');
                // echo $conn->error;
                // print_r($result);
            }
            $conn->close();

    }
?>