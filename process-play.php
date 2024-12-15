<?php
session_start(); // เริ่มต้นเซสชัน
$open_connect = 1;
require('connect.php');

// ตรวจสอบว่าได้เข้าสู่ระบบหรือยัง
if (!isset($_SESSION['email_account'])) {
    header('Location: login.php'); // ถ้าไม่มีการเข้าสู่ระบบ ให้เปลี่ยนเส้นทางไปยัง login.php
    exit();
}

// ถ้าเข้าสู่ระบบแล้ว, เปลี่ยนเส้นทางไปยังหน้า play.php
header('Location: play.php');
exit();
?>
