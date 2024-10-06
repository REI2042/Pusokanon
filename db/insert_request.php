<?php
session_start();
include 'DBconn.php';

$data = json_decode(file_get_contents('php://input'), true);

function generateRandomString($minLength = 8, $maxLength = 13) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
    $charactersLength = strlen($characters);
    $randomLength = rand($minLength, $maxLength);
    $randomString = '';
    for ($i = 0; $i < $randomLength; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check if JSON data is sent
if (isset($data['docTypeId']) && isset($data['purposeId']) && isset($data['purposeName'])) {
    $resId = $_SESSION['res_ID'];
    $docTypeId = $data['docTypeId'];
    $purposeId = $data['purposeId'];
    $purposeName = $data['purposeName'];
    $requestId = generateRandomString(8, 13);

    try {
        if ($purposeId == 5) {
            $sql = "SELECT doc_amount FROM doc_type WHERE docType_id = :docTypeId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':docTypeId' => $docTypeId]);
            $purposeFee = $stmt->fetchColumn();
        } else {
            $sql = "SELECT purpose_fee FROM docs_purpose WHERE purpose_id = :purpose_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':purpose_id' => $purposeId]);
            $purposeFee = $stmt->fetchColumn();
        }

        // Insert into request_doc table
        $sql = "INSERT INTO request_doc (res_ID, docType_id, purpose_id, purpose_name, doc_amount, request_id) 
                VALUES (:resId, :docTypeId, :purposeId, :purposeName, :purposeFee, :requestId)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resId' => $resId,
            ':docTypeId' => $docTypeId,
            ':purposeId' => $purposeId,
            ':purposeName' => $purposeName,
            ':purposeFee' => $purposeFee,
            ':requestId' => $requestId
        ]);

        // Return the request_id in JSON format
        echo json_encode(['success' => true, 'request_id' => $requestId]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resId = $_SESSION['res_ID'];
    $docTypeId = $_POST['docTypeId'];
    $purposeId = 5; // Assuming 'Others' for file uploads
    $purposeName = $_POST['purpose'];
    $requestId = generateRandomString(8, 13);

    try {
        $uploadedFiles = [];
        $uploadFileDir = 'uploaded_filesRequirements/';

        // Process uploaded files
        $fileInput = $_FILES['fileNames'];
        for ($i = 0; $i < count($fileInput['name']); $i++) {
            $fileName = $fileInput['name'][$i];
            $fileTmpPath = $fileInput['tmp_name'][$i];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedfileExtensions = array('jpg', 'png', 'jpeg', 'pdf');

            if (in_array($fileExtension, $allowedfileExtensions)) {
                $newFileName = substr(md5(time() . $fileName), 0, 16) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $uploadedFiles[] = $newFileName;
                }
            }
        }

        $documentRequirements = implode(',', $uploadedFiles);

        $sql = "SELECT doc_amount FROM doc_type WHERE docType_id = :docTypeId";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':docTypeId' => $docTypeId]);
        $purposeFee = $stmt->fetchColumn();

        // Insert into request_doc table with uploaded file names
        $sql = "INSERT INTO request_doc (res_ID, docType_id, purpose_id, purpose_name, doc_amount, request_id, document_requirements) 
                VALUES (:resId, :docTypeId, :purposeId, :purposeName, :purposeFee, :requestId, :documentRequirements)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resId' => $resId,
            ':docTypeId' => $docTypeId,
            ':purposeId' => $purposeId,
            ':purposeName' => $purposeName,
            ':purposeFee' => $purposeFee,
            ':requestId' => $requestId,
            ':documentRequirements' => $documentRequirements
        ]);

        // Return the request_id in JSON format
        echo json_encode(['success' => true, 'request_id' => $requestId, 'message' => 'Request submitted successfully']);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
