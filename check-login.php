<?php
    session_start();
    include "db.php";
    
    if (empty($_REQUEST['username']) || empty($_REQUEST['password'])) {
        header("Location:index.php?url=login&message=login false");
    }else {
            $sql = "SELECT * FROM users WHERE username = '".$_REQUEST['username']."';";
            
            $conn = new mysqli($servername, $username, $password,$dbname);
            mysqli_query($conn, "SET NAMES UTF8");
            $result = $conn->query($sql);
            // print_r($result->num_rows);
            // exit;
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();
            //         print_r($row['password']);
            // exit;
                    if ($_REQUEST['password'] != $row['password']) {
                        $_SESSION['alert']['status']  = "warning";
                        $_SESSION['alert']['message']  = "[ ผู้ใช้งานกรอกรหัสผ่านไม่ถูกต้อง ]";
                        print_r($_SESSION);
                        $conn->close();
                        header('Location:login.php');
                    }else {
                         $_SESSION['fullname']=$row['fullname'];  
                         $_SESSION['username']=$row['username'];
                         $_SESSION['email']=$row['email'];  
                         $_SESSION['status']=$row['status'];
                         $_SESSION['id']=$row['id'];
                        

                        switch ((int)$_SESSION['status']) {
                             case 1:
                                 header('Location:admin.php');    
                                 break;
                             case 2:
                                 header('Location:employee.php');
                                 break;
                             case 3:
                                 header('Location:teacher.php');
                                 break;
                             case 4:
                                header('Location:owner.php');
                                 break;

                             default:
                                 // echo "user member";
                                 // exit;
                                 header('Location:member.php');
                                break;
                             }
                  
                    }
            } else {
                $_SESSION['alert']['status']  = "warning";
                $_SESSION['alert']['message']  = "[ ไม่พบข้อมูลผู้ใช้งานในระบบ ]";
                header('Location:login.php');
            }

    }
?>