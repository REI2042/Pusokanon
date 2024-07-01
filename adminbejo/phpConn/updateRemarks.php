<?php
include '../../db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);

    if (isset($data['doc_ID'], $data['request_id'], $data['res_id'])) {
        $doc_ID = $data['doc_ID'];
        $request_id = $data['request_id'];
        $resident_id = $data['res_id'];
        
        // Update the database
        $sql = "UPDATE request_doc SET remarks = 'Released' WHERE doc_ID = ? AND request_id = ? AND res_id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$doc_ID,  $request_id, $resident_id]);

        if ($result) {
            echo json_encode(['stat' => 'success']);
        } else {
            echo json_encode(['stat' => 'error', 'message' => 'Failed to update remarks']);
        }
    } else {
        echo json_encode(['stat' => 'error', 'message' => 'Invalid input data']);
    }
}
?>
