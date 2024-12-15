<?php
if ($open_connect != 1) {
    die(header('Location: index.php'));
}

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'modtype';
$port = NULL;
$socket = NULL;
$connect = mysqli_connect($hostname, $username, $password, $database);

if (!$connect) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว : " . mysqli_connect_error());
} else {
    mysqli_set_charset($connect, 'utf8');
}

// ดึงข้อมูลผู้ใช้หากเข้าสู่ระบบ
if (isset($_SESSION['id_account'])) {
    $user_id = $_SESSION['id_account'];
    $query = "SELECT email_account, score_account, wpm_account FROM account WHERE id_account = ?";
    $stmt = mysqli_prepare($connect, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && $user_data = mysqli_fetch_assoc($result)) {
            $_SESSION['email_account'] = $user_data['email_account'];
            $_SESSION['score_account'] = $user_data['score_account'];
            $_SESSION['wpm_account'] = $user_data['wpm_account'];
        }
        
        mysqli_stmt_close($stmt);
    }
}
?>
