<?php

include '../../db/DBconn.php'; // This now includes both database connection and encryption functions

header('Content-Type: application/json'); // Set the header to return JSON

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['complaint_id']) && isset($data['hearing_date']) && isset($data['hearing_time'])) {
        try {
            $complaint_id = $data['complaint_id'];
            $hearing_date = $data['hearing_date'];
            $hearing_time = $data['hearing_time'];

            // Fetch resident email based on complaint_id
            $fetch_email_sql = "
                SELECT ru.res_email AS resident_email
                FROM resident_users ru 
                JOIN complaints_tbl ct ON ct.res_id = ru.res_ID
                WHERE ct.complaint_id = :complaint_id
            ";
            $fetch_email_stmt = $pdo->prepare($fetch_email_sql);
            $fetch_email_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $fetch_email_stmt->execute();
            $result = $fetch_email_stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                $response['message'] = 'No resident found for the given complaint ID.';
                error_log("No resident found for complaint ID: $complaint_id");
                echo json_encode($response);
                exit;
            }

            $encrypted_email = $result['resident_email'];
            
            // Decrypt the email using the existing function
            $decrypted_email = decryptData($encrypted_email);
            
            error_log("Fetched and decrypted email for complaint ID $complaint_id: $decrypted_email");

            // Update the complaint status and hearing date/time
            $update_sql = "
                UPDATE complaints_tbl 
                SET status = 'Accepted', hearing_date = :hearing_date, hearing_time = :hearing_time 
                WHERE complaint_id = :complaint_id
            ";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $update_stmt->bindParam(':hearing_date', $hearing_date, PDO::PARAM_STR);
            $update_stmt->bindParam(':hearing_time', $hearing_time, PDO::PARAM_STR);
            $update_stmt->execute();

            $response['success'] = true;
            $response['resident_email'] = $decrypted_email; // Use the decrypted email in the response
            error_log("Complaint ID $complaint_id approved successfully");
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            error_log("Error in approve_complaint.php: " . $e->getMessage());
        }

        echo json_encode($response);
        exit;
    }
}

echo json_encode($response);
exit;

?>
