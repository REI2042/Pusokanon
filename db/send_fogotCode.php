<?php
    session_start();
    include 'DBconn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = json_decode(file_get_contents('php://input'), true);
        $email = $input['email'];
        $code = $input['code'];
        $expiryTime = date("Y-m-d H:i:s", $input['expiryTime'] / 1000);

        $decryptedEmail = decryptData($email);

        $stmt = $pdo->prepare("SELECT res_email FROM resident_users WHERE res_email = ?");
        $stmt->bindParam(1, $decryptedEmail);
        $stmt->execute();
        
            
        try {
        // Generate a unique code
            // $resetToken = strval(random_int(100000, 999999));
            // $code = encryptData($resetToken);

            $expirationTime = date("Y-m-d H:i:s",time() + 60 * 30);

            // Update the database with the reset token and expiration time
            $updateStmt = $pdo->prepare("UPDATE resident_users SET reset_token_hash = ?, reset_token_expires_at	 = ? WHERE res_email = ?");
            $updateStmt->bindParam(1, $code);
            $updateStmt->bindParam(2, $expiryTime);
            $updateStmt->bindParam(3, $decryptedEmail);
            $updateResult = $updateStmt->execute();

            $_SESSION['email'] = $email;
            echo json_encode(['success' => true]);

        } catch (PDOException $e) {
            var_dump($_POST);
            exit; 
        }
                
    }
?>

