<?php
session_start(); // เริ่มเซสชัน

$open_connect = 1;
require('connect.php'); // เชื่อมต่อฐานข้อมูล

if (isset($_POST['email_account'])) {
    $email_account = mysqli_real_escape_string($connect, $_POST['email_account']);

    // ค้นหาผู้ใช้จากอีเมลในฐานข้อมูล
    $query_check_account = "SELECT * FROM account WHERE email_account = '$email_account'";
    $call_back_check_account = mysqli_query($connect, $query_check_account);

    if (mysqli_num_rows($call_back_check_account) == 1) {
        $result_check_account = mysqli_fetch_assoc($call_back_check_account);

        // ตรวจสอบบทบาทของผู้ใช้
        if ($result_check_account['role_account'] == 'member') {
            // ตั้งค่าเซสชัน
            $_SESSION['id_account'] = $result_check_account['id_account'];
            $_SESSION['username_account'] = $result_check_account['username_account'];
            $_SESSION['password_account'] = $result_check_account['password_account'];
            $_SESSION['email_account'] = $email_account;
            $_SESSION['role_account'] = $result_check_account['role_account'];

            // เปลี่ยนเส้นทางไปยัง play.php (หน้าเกม)
            header('Location: play.php');
            exit();
        } else {
            // ถ้าไม่ใช่สมาชิก, แสดงข้อความหรือเปลี่ยนเส้นทางไปยังหน้าอื่น
            echo "คุณไม่ใช่สมาชิก";
        }
    } else {
        // หากไม่พบอีเมลในฐานข้อมูล
        echo "ไม่พบผู้ใช้ที่มีอีเมลนี้";
    }
}
?>