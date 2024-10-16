<?php
include '../../db/DBconn.php';
header('Content-Type: application/json');

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if (isset($data['complaint_id']) && isset($data['hearing_date']) && isset($data['hearing_time'])) {
    try {
        $sql = "UPDATE complaints_tbl SET hearing_date = :hearing_date, hearing_time = :hearing_time WHERE complaint_id = :complaint_id";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':hearing_date' => $data['hearing_date'],
            ':hearing_time' => $data['hearing_time'],
            ':complaint_id' => $data['complaint_id']
        ]);

        if ($result && $stmt->rowCount() > 0) {
            $fetchSql = "SELECT ru.res_email AS resident_email, ru.res_fname AS resident_name, 
                                ct.case_type AS complaint, 
                                CONCAT(ct.respondent_fname, ' ', ct.respondent_mname, ' ', ct.respondent_lname, ' ', ct.respondent_suffix) AS respondent_name 
                         FROM resident_users ru 
                         JOIN complaints_tbl ct ON ct.res_id = ru.res_ID 
                         WHERE ct.complaint_id = :complaint_id";
            $fetchStmt = $pdo->prepare($fetchSql);
            $fetchStmt->execute([':complaint_id' => $data['complaint_id']]);
            $residentData = $fetchStmt->fetch(PDO::FETCH_ASSOC);

            if ($residentData) {
                // Decrypt the email if necessary
                $decrypted_email = decryptData($residentData['resident_email']);

                // Format the date and time
                $hearingDate = date('F j, Y', strtotime($data['hearing_date']));
                $hearingTime = date('g:i A', strtotime($data['hearing_time']));

                echo json_encode([
                    'status' => 'success',
                    'message' => 'Hearing date and time updated successfully',
                    'resident_email' => $decrypted_email,
                    'resident_name' => $residentData['resident_name'],
                    'respondent_name' => $residentData['respondent_name'],
                    'complaint' => $residentData['complaint'],
                    'hearing_date' => $hearingDate, // Formatted date
                    'hearing_time' => $hearingTime // Formatted time
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Resident data not found']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No records were updated']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required data']);
}
?>