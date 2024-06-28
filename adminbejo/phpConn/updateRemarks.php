<?php
include '../../db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $doc_ID = $data['document_id'];
    $resident_id = $data['resident_id'];
    $request_id = $data['request_id'];
    

    // Update the database
    $sql = "UPDATE request_doc SET remarks = 'Released' WHERE doc_ID = ? AND res_id = ? AND request_id = ? ";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$doc_ID, $resident_id, $request_id]);

    if ($result) {
        echo json_encode(['stat' => 'success']);

    } else {
        echo json_encode(['stat' => 'error', 'message' => 'Failed to update remarks']);
    }
}
?>