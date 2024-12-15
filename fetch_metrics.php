<?php
session_start();
$open_connect = 1;
require('connect.php');

if (isset($_SESSION['id_account'])) {
    echo json_encode([
        'status' => 'success',
        'wpm_account' => $_SESSION['wpm_account'] ?? 0,
        'score_account' => $_SESSION['score_account'] ?? 0,
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
}
?>
