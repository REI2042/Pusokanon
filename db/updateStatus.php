<?php
include 'DBconn.php';
require_once '../vendor/autoload.php'; // Ensure this is the correct path to the autoload file for PhpOffice
date_default_timezone_set('Asia/Manila');
use PhpOffice\PhpWord\TemplateProcessor;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doc_ID'], $_POST['status'], $_POST['resident_id'])) {
    $doc_ID = $_POST['doc_ID'];
    $status = $_POST['status'];
    $resident_id = $_POST['resident_id'];
    

    if ($status == 'Processing' && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doctype'])) {
        // Fetch resident details
        $doctype = $_POST['doctype'];
        $sql = "SELECT ru.res_id, ru.res_fname, ru.res_lname, ru.civil_status, rd.doc_ID, rd.purpose_name, ru.gender, ru.addr_sitio, ru.birth_date,
                       DAY(rd.date_req) AS Day, MONTHNAME(rd.date_req) AS Month, YEAR(rd.date_req) AS Year,
                       dt.docType_id, dt.doc_name
                FROM request_doc rd 
                INNER JOIN resident_users ru ON rd.res_id = ru.res_id
                INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
                WHERE ru.res_id = :resident_id AND rd.doc_ID = :doc_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':resident_id', $resident_id, PDO::PARAM_INT);
        $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
        $stmt->execute();
        $resident = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resident) {
            // Generate the word document
            if($doctype == 'Barangay Certificate'){
                $templateProcessor = new TemplateProcessor('../File_Templates/template_Certificate.docx');
                $templateProcessor->setValue('name', htmlspecialchars($resident['res_fname'] . ' ' . $resident['res_lname']));
                $templateProcessor->setValue('gender', htmlspecialchars($resident['gender']));
                $templateProcessor->setValue('purpose', htmlspecialchars($resident['purpose_name']));
                $templateProcessor->setValue('date', htmlspecialchars($resident['Day']));
                $templateProcessor->setValue('month', htmlspecialchars($resident['Month']));
                $templateProcessor->setValue('year', htmlspecialchars($resident['Year']));
            }  elseif ($doctype == 'Barangay Clearance'){
                $templateProcessor = new TemplateProcessor('../File_Templates/template_Clearance.docx');
                $templateProcessor->setValue('name', htmlspecialchars($resident['res_fname'] . ' ' . $resident['res_lname']));
                $templateProcessor->setValue('gender', htmlspecialchars($resident['gender']));
                $templateProcessor->setValue('sitio', htmlspecialchars($resident['addr_sitio']));
                $templateProcessor->setValue('purpose', htmlspecialchars($resident['purpose_name']));
                $templateProcessor->setValue('date', htmlspecialchars($resident['Day']));
                $templateProcessor->setValue('month', htmlspecialchars($resident['Month']));
                $templateProcessor->setValue('year', htmlspecialchars($resident['Year']));
                $birthDate = new DateTime($resident['birth_date']);
                $currentDate = new DateTime();
                $age = $currentDate->diff($birthDate)->y;
                $templateProcessor->setValue('age', $age);
            } elseif ($doctype == 'Barangay Indigency'){
                $templateProcessor = new TemplateProcessor('../File_Templates/Template_Certificate_of_Indigency.docx');
                $templateProcessor->setValue('name', htmlspecialchars($resident['res_fname'] . ' ' . $resident['res_lname']));
                $templateProcessor->setValue('civil_status', htmlspecialchars($resident['civil_status']));
                $templateProcessor->setValue('gender', htmlspecialchars($resident['gender']));
                $templateProcessor->setValue('sitio', htmlspecialchars($resident['addr_sitio']));
                $templateProcessor->setValue('purpose', htmlspecialchars($resident['purpose_name']));
                $templateProcessor->setValue('date', htmlspecialchars($resident['Day']));
                $templateProcessor->setValue('month', htmlspecialchars($resident['Month']));
                $templateProcessor->setValue('year', htmlspecialchars($resident['Year']));
                $birthDate = new DateTime($resident['birth_date']);
                $currentDate = new DateTime();
                $age = $currentDate->diff($birthDate)->y;
                $templateProcessor->setValue('age', $age);
            } elseif ($doctype == 'Barangay Residency'){
                $templateProcessor = new TemplateProcessor('../File_Templates/Template_Certificate_of_Residency.docx');
                $templateProcessor->setValue('name', htmlspecialchars($resident['res_fname'] . ' ' . $resident['res_lname']));
                $templateProcessor->setValue('gender', htmlspecialchars($resident['gender']));
                $templateProcessor->setValue('purpose', htmlspecialchars($resident['purpose_name']));
                $templateProcessor->setValue('sitio', htmlspecialchars($resident['addr_sitio']));
                $templateProcessor->setValue('date', htmlspecialchars($resident['Day']));
                $templateProcessor->setValue('month', htmlspecialchars($resident['Month']));
                $templateProcessor->setValue('year', htmlspecialchars($resident['Year']));
                $birthDate = new DateTime($resident['birth_date']);
                $currentDate = new DateTime();
                $age = $currentDate->diff($birthDate)->y;
                $templateProcessor->setValue('age', $age);
            }
            // Save the file in memory and send it for download
            $tempFile = tempnam(sys_get_temp_dir(), 'word');
            $templateProcessor->saveAs($tempFile);

            if (file_exists($tempFile)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                header('Content-Disposition: attachment; filename="' . htmlspecialchars($resident['doc_name'] . '_' . $resident['res_lname'] . '_' . date('d-M-Y')) . '.docx"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($tempFile));
                readfile($tempFile);
                unlink($tempFile); // delete the temporary file
                exit; 

            } else {
                $stats = 'Pending';
                $sql = "UPDATE request_doc SET stat = :stats WHERE doc_ID = :doc_ID";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':stats', $stats, PDO::PARAM_STR);
                $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
                $stmt->execute();
                header('Location:../adminbejo/Barangay-Residency.php');
                exit;
            }
        }else {
            echo json_encode(['stat' => 'error', 'message' => 'Resident not found.']);
        }
    } elseif($status == 'Ready to pickup') {

        if (!isset($_POST['hours']) || !is_numeric($_POST['hours'])) {
            echo json_encode(['stat' => 'error', 'message' => 'Invalid number of hours.']);
            exit;
        }

        // $hours = (int) $_POST['hours'];
        // $seconds = $hours * 3600; // Convert hours to seconds
        $seconds = (int) $_POST['hours'];


        $sql = "UPDATE request_doc SET stat = 'Processing' WHERE doc_ID = :doc_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
        $stmt->execute();

        ignore_user_abort(true);
        set_time_limit(0);
        
        // Sleep for the specified number of seconds
        sleep($seconds);

        $sql = "UPDATE request_doc SET stat = :status WHERE doc_ID = :doc_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
        $stmt->execute();
        
        exit;
    } else {
        echo json_encode(['stat' => 'error', 'message' => 'Invalid status.']);
    }
} else {
    echo json_encode(['stat' => 'error', 'message' => 'Invalid request.']);
}
?>
