<?php
date_default_timezone_set('Asia/Manila');
session_start();
require_once 'DBconn.php'; 

if (isset($_SESSION['res_ID'])) {
    $res_id = $_SESSION['res_ID'];
    
    if (isset($_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['sufname'], $_POST['gender'], $_POST['age'], $_POST['incident-date'], $_POST['incident-time'], $_POST['addsitio'], $_POST['case_type'], $_POST['narrative'])) {
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
        $staff_id = 2; 

        $sql = "INSERT INTO complaints_tbl (res_id, staff_id, respondent_fname, respondent_mname, respondent_lname, respondent_suffix, respondent_gender, respondent_age, incident_date, incident_time, incident_place, date_filed, case_type, narrative, status) 
                VALUES (:res_id, :staff_id, :fname, :mname, :lname, :sufname, :gender, :age, :incident_date, :incident_time, :addsitio, :date_filed, :case_type, :narrative, :status)";

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
            $stmt->bindParam(':status', $status);

            if ($stmt->execute()) {
                $complaint_id = $pdo->lastInsertId();
                echo json_encode(['success' => true, 'message' => 'Complaint submitted successfully.', 'complaint_id' => $complaint_id]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error submitting complaint.']);
            }
        } else {
            echo "Database connection error.";
        }
    } else {
        echo "Missing required form fields.";
    }
} else {
    echo "User not logged in or session expired.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_id'], $_POST['status'])) {
    try {
        $complaint_id = $_POST['complaint_id'];
        $new_status = $_POST['status'];

        $update_sql = "UPDATE complaints_tbl SET status = :new_status WHERE complaint_id = :complaint_id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->bindParam(':new_status', $new_status, PDO::PARAM_STR);
        $update_stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
        
        $update_stmt->execute();
        
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

?>

