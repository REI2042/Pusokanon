<?php

include '../../db/DBconn.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['complaint_id']) && isset($data['reason'])) {
        try {
            $complaint_id = $data['complaint_id'];
            $reason = $data['reason'];  // This is the decline reason from JavaScript

            // Begin a transaction to ensure atomicity
            $pdo->beginTransaction();

            // Update the complaints_tbl to set status to 'Declined', store the reason in 'comment',
            // update 'remarks' to 'CASE CLOSED', and set 'date_closed' to current timestamp
            $update_sql = "
                UPDATE complaints_tbl 
                SET status = 'Rejected',
                    comment = :comment,
                    remarks = 'CASE CLOSED',
                    date_closed = NOW()
                WHERE complaint_id = :complaint_id
            ";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $update_stmt->bindParam(':comment', $reason, PDO::PARAM_STR);
            $update_stmt->execute();

            // Commit the transaction
            $pdo->commit();

            // Fetch resident details for response
            $fetch_details_sql = "
                SELECT ru.res_email AS resident_email, 
                       ru.res_fname, 
                       ct.date_filed,
                       ct.case_type,
                       CONCAT(ct.respondent_fname, ' ', ct.respondent_mname, ' ', ct.respondent_lname, ' ', ct.respondent_suffix) AS respondent_name
                FROM resident_users ru 
                JOIN complaints_tbl ct ON ct.res_id = ru.res_ID
                WHERE ct.complaint_id = :complaint_id
            ";
            $fetch_details_stmt = $pdo->prepare($fetch_details_sql);
            $fetch_details_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $fetch_details_stmt->execute();
            $result = $fetch_details_stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                $response['message'] = 'No resident found for the given complaint ID.';
                error_log("No resident found for complaint ID: $complaint_id");
                echo json_encode($response);
                exit;
            }

            // Format date_filed
            $date_obj = new DateTime($result['date_filed']);
            $formatted_date = $date_obj->format('F j, Y'); // e.g., "July 12, 2023"

            // Decrypt the email using the existing function
            $decrypted_email = decryptData($result['resident_email']);

            // Prepare response
            $response['success'] = true;
            $response['message'] = 'Complaint declined successfully.';
            $response['to_email'] = $decrypted_email;
            $response['name'] = $result['res_fname'];
            $response['complaint_id'] = $complaint_id;
            $response['respondent_name'] = $result['respondent_name'];
            $response['date_filed'] = $formatted_date;
            $response['case_type'] = $result['case_type'];
            $response['reason'] = $reason;

            echo json_encode($response);
            exit;

        } catch (Exception $e) {
            // Rollback the transaction on error
            $pdo->rollBack();

            $response['message'] = 'An error occurred: ' . $e->getMessage();
            error_log("Error in decline_complaint.php: " . $e->getMessage());
        }
    }
}

echo json_encode($response);
exit;

?>
