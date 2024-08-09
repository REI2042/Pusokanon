<?php
    date_default_timezone_set('Asia/Manila');
    error_log("Script started");

    session_start();
    error_log("Session started");

    require_once 'DBconn.php';
    error_log("DBconn.php included");

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    error_log("Error reporting set up");

    header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Form submitted successfully']);


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
            $staff_id = 18; 
            $comment = '--'; // Default value for comment

            // Handle file upload
            $evidence = NULL;
            if (isset($_FILES['evidence'])) {
                if ($_FILES['evidence']['error'] == 0) {
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
                            // File uploaded successfully
                            $evidence = $file_path;
                        } else {
                            error_log("Error uploading file.");
                            echo json_encode(['success' => false, 'message' => 'Error uploading file.']);
                            exit;
                        }
                    } else {
                        error_log("Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed.");
                        echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed.']);
                        exit;
                    }
                } else {
                    error_log("File upload error: " . $_FILES['evidence']['error']);
                    echo json_encode(['success' => false, 'message' => 'File upload error.']);
                    exit;
                }
            }

            // Check if PDO is set
            if (!isset($pdo)) {
                error_log("PDO connection not established.");
                echo json_encode(['success' => false, 'message' => 'Database connection error.']);
                exit;
            }

            $sql = "INSERT INTO complaints_tbl (res_id, staff_id, respondent_fname, respondent_mname, respondent_lname, respondent_suffix, respondent_gender, respondent_age, incident_date, incident_time, incident_place, date_filed, case_type, narrative, evidence, status, comment) 
                    VALUES (:res_id, :staff_id, :fname, :mname, :lname, :sufname, :gender, :age, :incident_date, :incident_time, :addsitio, :date_filed, :case_type, :narrative, :evidence, :status, :comment)";

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
                    error_log("SQL Error: " . $errorInfo[2]);
                    echo json_encode(['success' => false, 'message' => 'Error submitting complaint.', 'error' => $errorInfo[2]]);
                }
            } catch (Exception $e) {
                error_log("Exception: " . $e->getMessage());
                echo json_encode(['success' => false, 'message' => 'Exception occurred.', 'error' => $e->getMessage()]);
            }
        } else {
            error_log("Missing required form fields.");
            echo json_encode(['success' => false, 'message' => 'Missing required form fields.']);
        }
    } else {
        error_log("User not logged in or session expired.");
        echo json_encode(['success' => false, 'message' => 'User not logged in or session expired.']);
    }
?>
