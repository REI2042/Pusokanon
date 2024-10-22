<?php
date_default_timezone_set('Asia/Manila');
session_start();
require_once 'DBconn.php'; 

if (isset($_POST['res_ID'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['sufname'], $_POST['gender'], $_POST['age'], $_POST['incident-date'], $_POST['incident-time'], $_POST['addsitio'], $_POST['case_type'], $_POST['narrative'])) {
    $res_id = $_POST['res_ID'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $sufname = $_POST['sufname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $incident_date = $_POST['incident-date'];
    $incident_time = $_POST['incident-time'];
    $addsitio = $_POST['addsitio'];
    $date_filed = date('Y-m-d H:i:s');
    $case_type = $_POST['case_type'];
    $narrative = $_POST['narrative'];

    $status = 'Pending'; 
    $staff_id = Null; 
    $comment = '--';

    // Check if resident ID exists
    $check_res_id_sql = "SELECT COUNT(*) FROM resident_users WHERE res_ID = :res_id";
    $check_stmt = $pdo->prepare($check_res_id_sql);
    $check_stmt->bindParam(':res_id', $res_id);
    $check_stmt->execute();
    $count = $check_stmt->fetchColumn();

    if ($count == 0) {
        echo json_encode(['success' => false, 'message' => 'Resident ID does not exist.']);
        exit;
    }

    $evidence = NULL;
    if (isset($_FILES['evidence']) && $_FILES['evidence']['error'] == 0) {
        $file_tmp = $_FILES['evidence']['tmp_name'];
        $file_name = basename($_FILES['evidence']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'pdf'];

        if (in_array($file_ext, $allowed_exts)) {
            $upload_dir = 'complaints_evidence/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_path = $upload_dir . uniqid() . '.' . $file_ext;

            if (move_uploaded_file($file_tmp, $file_path)) {
                $evidence = $file_path;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error uploading file.']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed.']);
            exit;
        }
    }

    $sql = "INSERT INTO complaints_tbl (res_id, staff_id, respondent_fname, respondent_mname, respondent_lname, respondent_suffix, respondent_gender, respondent_age, incident_date, incident_time, incident_place, date_filed, case_type, narrative, evidence, status, comment) 
            VALUES (:res_id, :staff_id, :fname, :mname, :lname, :sufname, :gender, :age, :incident_date, :incident_time, :addsitio, :date_filed, :case_type, :narrative, :evidence, :status, :comment)";

    if (isset($pdo)) {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':res_id', $res_id);
        $stmt->bindParam(':staff_id', $staff_id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':sufname', $sufname);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':incident_date', $incident_date);
        $stmt->bindParam(':incident_time', $incident_time);
        $stmt->bindParam(':addsitio', $addsitio);
        $stmt->bindParam(':date_filed', $date_filed);
        $stmt->bindParam(':case_type', $case_type);
        $stmt->bindParam(':narrative', $narrative);
        $stmt->bindParam(':evidence', $evidence);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':comment', $comment);

        try {
            if ($stmt->execute()) {
                $complaint_id = $pdo->lastInsertId();
                echo json_encode(['success' => true, 'message' => 'Thank you for filling up the form. Kindly check your email from time to time for updates.', 'complaint_id' => $complaint_id]);
            } else {
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['success' => false, 'message' => 'Error submitting complaint. Please try again later.', 'error' => $errorInfo[2]]);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Exception occurred.', 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Database connection error.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required form fields.']);
}
?>
