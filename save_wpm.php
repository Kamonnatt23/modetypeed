<?php
session_start();
$open_connect = 1;
require('connect.php');

// รับข้อมูลจาก request (JSON)
$data = json_decode(file_get_contents("php://input"), true);

// ตรวจสอบว่าได้รับข้อมูลหรือไม่
if (isset($_SESSION['id_account'], $_SESSION['score_account'], $_SESSION['wpm_account'])) {
    $user_id = $_SESSION['id_account'];
    $score = $_SESSION['score_account'];
    $wpm = $_SESSION['wpm_account'];


    // ตรวจสอบค่า wpm และ score
    if (!is_numeric($wpm) || !is_numeric($score)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data format']);
        exit;
    }

    // สร้างคำสั่ง SQL สำหรับอัพเดตข้อมูล
    $query = "UPDATE account SET score_account = ?, wpm_account = ? WHERE id_account = ?";
    $stmt = mysqli_prepare($connect, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'dii', $score, $wpm, $user_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Data saved successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save data']);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare query']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data or session']);
}

mysqli_close($connect);
?>
