<?php
include '../../db/DBconn.php';

header('Content-Type: application/json');



$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

// Check if all required data is present
if (isset($data['complaint_id']) && isset($data['hearing_date']) && isset($data['hearing_time'])) {
    try {
        // Prepare the SQL statement
        $sql = "UPDATE complaints_tbl SET hearing_date = :hearing_date, hearing_time = :hearing_time WHERE complaint_id = :complaint_id";
        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute([
            ':hearing_date' => $data['hearing_date'],
            ':hearing_time' => $data['hearing_time'],
            ':complaint_id' => $data['complaint_id']
        ]);

        if ($result) {
            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Hearing date and time updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No records were updated']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error executing query']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
}


?>