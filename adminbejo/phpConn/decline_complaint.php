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

            // Fetch resident email, name, date filed, and case type based on complaint_id
            $fetch_details_sql = "
                SELECT ru.res_email AS resident_email, 
                       ru.res_fname, 
                       ct.date_filed,
                       ct.case_type
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

            $encrypted_email = $result['resident_email'];
            $resident_name = $result['res_fname'];
            $date_filed = $result['date_filed'];
            $case_type = $result['case_type'];
            
            // Format the date_filed
            $date_obj = new DateTime($date_filed);
            $formatted_date = $date_obj->format('F j, Y'); // e.g., "July 12, 2023"

            // Decrypt the email using the existing function
            $decrypted_email = decryptData($encrypted_email);
            
            error_log("Fetched and decrypted email for complaint ID $complaint_id: $decrypted_email");

            // Update the complaint status and store the reason in the remarks column
            $update_sql = "
                UPDATE complaints_tbl 
                SET status = 'Declined', remarks = :remarks
                WHERE complaint_id = :complaint_id
            ";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $update_stmt->bindParam(':remarks', $reason, PDO::PARAM_STR);  // Store reason as remarks
            $update_stmt->execute();

            $response['success'] = true;
            $response['message'] = 'Complaint declined successfully.';
            $response['to_email'] = $decrypted_email;
            $response['name'] = $resident_name;
            $response['complaint_id'] = $complaint_id;
            $response['date_filed'] = $formatted_date;
            $response['case_type'] = $case_type;
            $response['reason'] = $reason;
            error_log("Complaint ID $complaint_id declined successfully");
        } catch (Exception $e) {
            $response['message'] = 'An error occurred: ' . $e->getMessage();
            error_log("Error in decline_complaint.php: " . $e->getMessage());
        }

        echo json_encode($response);
        exit;
    }
}

echo json_encode($response);
exit;

?>