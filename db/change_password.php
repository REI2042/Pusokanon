<?php
session_start();
include 'DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    $repeatPassword = $_POST['repeatpassword'];

    // Verify that the new password and repeat password match
    if ($newPassword !== $repeatPassword) {
        echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
        exit;
    }

    // Get the user's current password from the database
    $userId = $_SESSION['res_ID']; // Assume you have the user's ID stored in the session
    $stmt = $pdo->prepare("SELECT res_password FROM resident_users WHERE res_ID = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    // Verify the current password
    if (!password_verify($currentPassword, $user['res_password'])) {
        echo json_encode(['success' => false, 'error' => 'current_password', 'message' => 'Current password is incorrect']);
        exit;
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $pdo->prepare("UPDATE resident_users SET res_password = ? WHERE res_ID = ?");
    if ($stmt->execute([$hashedPassword, $userId])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update password']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}