<?php
    include '../../db/DBconn.php'; // Adjust the path as needed

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_id'], $_POST['date'], $_POST['email'])) {
        try {
            $complaint_id = $_POST['complaint_id'];
            $hearing_date = $_POST['date'];
            $resident_email = $_POST['email'];
    
            // Update the complaint status
            $update_sql = "UPDATE complaints_tbl SET status = 'Approved' WHERE complaint_id = :complaint_id";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $update_stmt->execute();
    
            // Prepare the email
            $message = "Dear Resident,\n\nYour complaint has been approved. The hearing is scheduled on: $hearing_date.\n\nThank you.";
            $subject = "Complaint Hearing Date";
    
            // Send the email
            $headers = 'From: peace.mari@gmail.com' . "\r\n" .
                'Reply-To: peace.mari@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
    
            if (mail($resident_email, $subject, $message, $headers)) {
                echo json_encode(['success' => true, 'message' => 'Complaint approved and email sent.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to send email.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        exit;
    }
?>
