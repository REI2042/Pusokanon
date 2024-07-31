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
}elseif(isset($_POST['purpose']) && isset($_POST['file']) && isset($_POST['docTypeId'])){
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Sanitize file name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Check if the file type is allowed
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Directory in which the uploaded file will be moved
            $uploadFileDir = './uploaded_filesRequirements/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        } else {
            $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $message = 'There is some error in the file upload. Please check the following error.<br>';
        $message .= 'Error:' . $_FILES['file']['error'];
    }

    // Save the purpose and document type ID
    $purpose = $_POST['purpose'];
    $docTypeId = $_POST['docTypeId'];

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


