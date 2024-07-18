<?php
session_start();
include 'DBconn.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Ensure the content type is JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'];
    $code = $input['code'];
    $expiryTime = date("Y-m-d H:i:s", strtotime("+5 minutes"));

    // Encrypt email before storing in the database
    $encryptedEmail = encryptData($email);


    try {
        $stmt = $pdo->prepare("SELECT res_email FROM resident_users WHERE res_email = ?");
        $stmt->execute([$encryptedEmail]);
        if ($stmt->rowCount() > 0) {
            $updateStmt = $pdo->prepare("UPDATE resident_users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE res_email = ?");
            $updateStmt->execute([$code, $expiryTime, $encryptedEmail]);
            $_SESSION['email'] = $email;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Email not found.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
