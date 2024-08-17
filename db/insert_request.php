<?php
session_start();
include 'DBconn.php';

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

        if ($stmt->execute()) {
            $_SESSION['last_request_id'] = $requestId;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to insert request']);
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} elseif (isset($_POST['purpose']) && isset($_FILES['file']) && isset($_POST['docTypeId'])) {
    if ($_FILES['file']['error'] == 0) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedfileExtensions = array('jpg', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = 'uploaded_filesRequirements/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $resId = $_SESSION['res_ID'];
                $docTypeId = $_POST['docTypeId'];
                $purposeId = 5;
                $purposeName = $_POST['purpose'];
                $requestId = generateRandomString(8, 13);

                try {
                    $sql = "INSERT INTO request_doc (res_ID, docType_id, purpose_id, purpose_name, request_id, document_requirements) VALUES (:resId, :docTypeId, :purposeId, :purposeName, :requestId, :document_requirements)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':resId' => $resId,
                        ':docTypeId' => $docTypeId,
                        ':purposeId' => $purposeId,
                        ':purposeName' => $purposeName,
                        ':requestId' => $requestId,
                        ':document_requirements' => $newFileName
                    ]);

                    echo json_encode(['success' => true]);
                } catch (PDOException $e) {
                    error_log($e->getMessage());
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Error moving file to upload directory.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Error in file upload. Error code: ' . $_FILES['file']['error']]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

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
?>
