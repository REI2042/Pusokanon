<?php
session_start();
include 'DBconn.php';

// Receive and decode the JSON data
$data = json_decode(file_get_contents('php://input'), true);
$response = ['success' => false];

try {
    // Start transaction
    $pdo->beginTransaction();
    
    // Get the resident ID from the session
    $res_ID = $_SESSION['res_ID'];
    
    // Get date and time from the request
    $appt_date = $data['date'];
    $appt_time = $data['time'];
    $request_id = $data['request_id'];
    
    // First, get the doc_ID using the request_id
    $stmt = $pdo->prepare("SELECT doc_ID FROM request_doc WHERE request_id = ?");
    $stmt->execute([$request_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$result) {
        throw new Exception("No document request found for the given request ID");
    }
    
    $doc_ID = $result['doc_ID'];
    
    // Now insert into appointment_tbl
    $stmt = $pdo->prepare("
        INSERT INTO appointment_tbl (res_ID, doc_ID, appt_date, appt_time)
        VALUES (?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $res_ID,
        $doc_ID,
        $appt_date,
        $appt_time
    ]);
    
    // Commit transaction
    $pdo->commit();
    
    $response['success'] = true;
    $response['message'] = 'Appointment scheduled successfully';

} catch (Exception $e) {
    // Rollback transaction on error
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $response['error'] = $e->getMessage();
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>