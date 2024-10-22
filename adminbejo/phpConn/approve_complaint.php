<?php
session_start(); 

include '../../db/DBconn.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if staff is logged in
    if (!isset($_SESSION['staff_id'])) {
        $response['message'] = 'Staff not logged in.';
        echo json_encode($response);
        exit;
    }

    $staff_id = $_SESSION['staff_id']; // Get staff_id from session

    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['complaint_id']) && isset($data['hearing_date']) && isset($data['hearing_time'])) {
        try {
            $complaint_id = $data['complaint_id'];
            $hearing_date = $data['hearing_date'];
            $hearing_time = $data['hearing_time'];

            // Parse the date
            $date_parts = explode('-', $hearing_date);
            $year = $date_parts[0];
            $month_num = $date_parts[1];
            $day = $date_parts[2];

            $dateObj = DateTime::createFromFormat('!m', $month_num);
            $month = $dateObj->format('F'); 

            $formatted_time = date('h:i A', strtotime($hearing_time)); // Format to 12-hour format
            
            // Fetch resident email, respondent name, and other details based on complaint_id
            $fetch_details_sql = "
            SELECT ru.res_email AS resident_email,
                ru.res_fname,
                ct.complaint_id,
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

            $encrypted_email = $result['resident_email'];
            $resident_name = $result['res_fname'];
            $complaint_id = $result['complaint_id'];
            $complaint = $result['case_type'];
            $respondent_name = $result['respondent_name'];
            
            // Decrypt the email using the existing function
            $decrypted_email = decryptData($encrypted_email);
            
            error_log("Fetched and decrypted email for complaint ID $complaint_id: $decrypted_email");

            $update_sql = "
                UPDATE complaints_tbl 
                SET status = 'Approved', 
                    hearing_date = :hearing_date, 
                    hearing_time = :hearing_time,
                    staff_id = :staff_id 
                WHERE complaint_id = :complaint_id
            ";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $update_stmt->bindParam(':hearing_date', $hearing_date, PDO::PARAM_STR);
            $update_stmt->bindParam(':hearing_time', $hearing_time, PDO::PARAM_STR);
            $update_stmt->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);
            $update_stmt->execute();

            $response['success'] = true;
            $response['resident_email'] = $decrypted_email;
            $response['resident_name'] = $resident_name;
            $response['complaint'] = $complaint;
            $response['complaint_id'] = $complaint_id;
            $response['respondent_name'] = $respondent_name;
            $response['hearing_day'] = $day;
            $response['hearing_month'] = $month;
            $response['hearing_year'] = $year;
            $response['hearing_time'] = $formatted_time;  
            $response['staff_id'] = $staff_id; 
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