<?php
session_start(); // เริ่มต้นเซสชัน
$open_connect = 1;
require('connect.php');

// ดึงข้อมูล Scoreboard จากฐานข้อมูล
$query = "SELECT username_account, score_account FROM account ORDER BY score_account DESC LIMIT 5";
$result = mysqli_query($connect, $query);

$scores = []; // สร้างอาร์เรย์สำหรับเก็บผลลัพธ์
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[] = $row; // เก็บผลลัพธ์แต่ละแถวลงในอาร์เรย์
    }
}

// ส่งผลลัพธ์โดยตรงไปยังหน้า `play.php` ผ่าน URL หรือสามารถลิงก์หน้าอื่นได้
header("Location: play.php");
exit();
