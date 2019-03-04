<?php 
include "db.php";
session_start();
//echo "Hello this is".$_REQUEST['c_id'];
//            $data = array();
            $getnaja = "Select fullname from users where status = 3";
              $conn = new mysqli($servername, $username, $password, $dbname);
            $result = $conn->query($getnaja);
//            while ( $row = $result->fetch_assoc() ){
//                $data[] = json_encode($row);
//            }
//            print_r($data);
                $data = $result->fetch_all( MYSQLI_ASSOC );
                echo json_encode($data);

//            echo json_encode($data);