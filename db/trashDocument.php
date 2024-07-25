<?php require_once 'DBconn.php'; 

header('Content-Type: application/json'); // Ensure the content type is JSON

if (isset($_POST['doc_ID'])) {
    $documentId = $_POST['doc_ID'];
    $request_id = $_POST['request_id'];
    
    // Update the status to 'trash'

    $sql = "UPDATE request_doc SET stat = 'Trash', remarks = 'Trash', request_id = NULL WHERE doc_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $documentId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Document moved to trash successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error moving document to trash']);
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Error']);
}

?>