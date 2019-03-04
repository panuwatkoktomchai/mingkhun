<?php 
include "db.php";
session_start();
$sql = "select * from music_course";
$course  = $conn->query($sql);


?>

<form action="save-sign-course.php" method="post">  
    ชื่อ
    <input required type="text" name = "data[name]"><br>
    อายุ
    <input required type="number" name = "data[age]"><br>
    เพศ
    <select required name="data[gen]" id="">
        <option value="0">ชาย</option>
        <option value="1">หญิง</option>
    </select>   <br>
    ที่อยู่
    <textarea required name="data[address]" id="" cols="30" rows="10"></textarea><br>
    เบอร์
    <input required type="text" name="data[phone]"><br>
    อีเมล
    <input required type="email" name ="data[email]"><br>

    รูปภาพ
    <input required type="file" name="filUpload" id="">

</form>