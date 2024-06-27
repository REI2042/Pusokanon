<?php
session_start();
include 'DBconn.php';

error_log(print_r($_POST, true)); // Debug statement

if (isset($_POST['docTypeId']) && isset($_POST['purposeId']) && isset($_POST['purposeName'])) {
    $resId = $_SESSION['res_ID'];
    $docTypeId = $_POST['docTypeId'];
    $purposeId = $_POST['purposeId'];
    $purposeName = $_POST['purposeName']; 


    $requestId = generateRandomString(8, 13);

    try {
        $sql = "INSERT INTO request_doc (res_ID, docType_id, purpose_id, purpose_name, request_id) VALUES (:resId, :docTypeId, :purposeId, :purposeName, :requestId)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resId' => $resId,
            ':docTypeId' => $docTypeId,
            ':purposeId' => $purposeId,
            ':purposeName' => $purposeName, 
            
            ':requestId' => $requestId
        ]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}


function generateRandomString($minLength = 8, $maxLength = 13) {// Generate a random request ID with length between 8 and 13 characters
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
    $charactersLength = strlen($characters);
    $randomLength = rand($minLength, $maxLength);
    $randomString = '';
    for ($i = 0; $i < $randomLength; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>


