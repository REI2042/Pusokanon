<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../db/DBconn.php'; // Ensure this includes a valid PDO connection

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $complaint_id = $data['complaint_id'] ?? null;
        $remarks = $data['remarks'] ?? null;
        $comment = $data['comment'] ?? '';

        if (!empty($complaint_id) && !empty($remarks)) {
            $date_closed = date('Y-m-d H:i:s');

            try {
                global $pdo;

                $sql = "UPDATE complaints_tbl
                        SET remarks = :remarks, 
                            date_closed = :date_closed, 
                            comment = :comment 
                        WHERE complaint_id = :complaint_id";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':remarks', $remarks);
                $stmt->bindParam(':date_closed', $date_closed);
                $stmt->bindParam(':comment', $comment);
                $stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    $response = ['success' => true, 'message' => 'Case closed successfully.'];
                } else {
                    $response['message'] = 'Failed to execute update statement.';
                }
            } catch (PDOException $e) {
                $response['message'] = 'Database error: ' . $e->getMessage();
                error_log("Error in close_complaint.php: " . $e->getMessage());
            }
        } else {
            $response['message'] = 'Invalid request: Missing complaint_id or remarks.';
        }
    } else {
        $response['message'] = 'Invalid JSON data.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
exit;
?>
