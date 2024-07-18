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
    $code = $input['code'];
    $email = $_SESSION['email'];
    $encryptedEmail = encryptData($email);
    

    try {
        $stmt = $pdo->prepare("SELECT reset_token_hash, reset_token_expires_at FROM resident_users WHERE res_email = ?");
        $stmt->execute([$encryptedEmail]);
        $user = $stmt->fetch();
        $decryptedcode = decryptData($user['reset_token_hash']);
        if ($user &&  $decryptedcode == $code && strtotime($user['reset_token_expires_at']) > time()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid or expired code.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
