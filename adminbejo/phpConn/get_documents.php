<?php
include '../../../db/DBconn.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Resident ID not provided']);
    exit;
}

$residentId = $_GET['id'];

try {
    $stmt = $pdo->prepare("
        SELECT r.resident_name, r.res_email, rd.purpose_name, rd.attachments
        FROM request_doc rd
        JOIN residents r ON rd.res_id = r.res_id
        WHERE r.res_id = :residentId
    ");
    $stmt->bindParam(':residentId', $residentId, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $email = decryptData($result['res_email']);
        
        $attachedFiles = [];
        if ($result['attachments']) {
            $attachments = json_decode($result['attachments'], true);
            if (is_array($attachments)) {
                foreach ($attachments as $attachment) {
                    $attachedFiles[] = [
                        'url' => '../../db/uploaded_filesRequirements/' . $attachment,
                        'name' => $attachment
                    ];
                }
            }
        }
        
        echo json_encode([
            'success' => true,
            'data' => [
                'residentName' => $result['resident_name'],
                'email' => $email,
                'purpose' => $result['purpose_name'],
                'attachedFiles' => $attachedFiles
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'error' => 'Resident not found']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}

?>