<?php
include '../../db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);

    if (isset($data['doc_ID'], $data['request_id'], $data['res_id'],$data['stat'],$data['remarks'])) {
        $doc_ID = $data['doc_ID'];
        $request_id = $data['request_id'];
        $resident_id = $data['res_id'];
        $stat = $data['stat'];
        $remarks = $data['remarks'];

        $sql = "SELECT stat, remarks FROM request_doc WHERE doc_ID = ? AND request_id = ? AND res_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$doc_ID, $request_id, $resident_id]);
        $currentStatus = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($currentStatus) {
            if ($currentStatus['stat'] == $stat && $currentStatus['remarks'] == $remarks ) {
                // Update the database
                $sql = "UPDATE request_doc SET stat = 'Done', remarks = 'Released'
                        WHERE doc_ID = ? AND request_id = ? AND res_id = ?";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$doc_ID, $request_id, $resident_id]);

                if ($result) {
                    $sql = "SELECT rd.docType_id, dt.doc_name 
                            FROM request_doc rd 
                            INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
                            WHERE doc_id = ? AND request_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$doc_ID, $request_id]);
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    if ($data) {
                        echo json_encode(['stat' => 'success', 'doc_name' => $data['doc_name']]);
                    } else {
                        echo json_encode(['stat' => 'error', 'message' => 'Document not found']);
                    }
                } else {
                    echo json_encode(['stat' => 'error', 'message' => 'Failed to update remarks']);
                }
            } elseif ($currentStatus['stat'] == 'Done' && $currentStatus['remarks'] == 'Released') {
                echo json_encode(['stat' => 'error', 'message' => 'QR has been scanned']);
            } else {
                echo json_encode(['stat' => 'error', 'message' => 'Invalid status or remarks']);
            }
        } else {
            echo json_encode(['stat' => 'error', 'message' => 'Document not found']);
        }
        
    } else {
        echo json_encode(['stat' => 'error', 'message' => 'Invalid input data']);
    }
}
?>