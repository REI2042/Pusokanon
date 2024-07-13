<?php
session_start();
include 'DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    $repeatPassword = $_POST['repeatpassword'];

    if ($newPassword !== $repeatPassword) {
        echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
        exit;
    }

    $userId = $_SESSION['res_ID'];
    $stmt = $pdo->prepare("SELECT res_password FROM resident_users WHERE res_ID = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if (!password_verify($currentPassword, $user['res_password'])) {
        echo json_encode(['success' => false, 'error' => 'current_password', 'message' => 'Current password is incorrect']);
        exit;
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE resident_users SET res_password = ? WHERE res_ID = ?");
    if ($stmt->execute([$hashedPassword, $userId])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>