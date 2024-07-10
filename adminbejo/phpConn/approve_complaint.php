<?php

    include '../../db/DBconn.php'; // Adjust the path as needed


    header('Content-Type: application/json'); // Set the header to return JSON

    $response = ['success' => false, 'message' => 'Invalid request.'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['complaint_id'])) {
            try {
                $complaint_id = $data['complaint_id'];

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

                $resident_email = $result['resident_email'];
                error_log("Fetched email for complaint ID $complaint_id: $resident_email");

                // Update the complaint status
                $update_sql = "UPDATE complaints_tbl SET status = 'Approved' WHERE complaint_id = :complaint_id";
                $update_stmt = $pdo->prepare($update_sql);
                $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
                $update_stmt->execute();

                $response['success'] = true;
                $response['resident_email'] = $resident_email;
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