<?php
include 'DBconn.php';
require_once '../vendor/autoload.php'; // Ensure this is the correct path to the autoload file for PhpOffice
date_default_timezone_set('Asia/Manila');
use PhpOffice\PhpWord\TemplateProcessor;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doc_ID'], $_POST['status'], $_POST['resident_id'])) {
    $doc_ID = $_POST['doc_ID'];
    $status = $_POST['status'];
    $resident_id = $_POST['resident_id'];

    if ($status == 'Processing') {
        // Fetch resident details
        $sql = "SELECT ru.res_id, ru.res_fname, ru.res_lname, rd.doc_ID, rd.purpose_name,
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
            $templateProcessor = new TemplateProcessor('../template.docx');
            $templateProcessor->setValue('name', htmlspecialchars($resident['res_fname'] . ' ' . $resident['res_lname']));
            $templateProcessor->setValue('purpose', htmlspecialchars($resident['purpose_name']));
            $templateProcessor->setValue('date', htmlspecialchars($resident['Day']));
            $templateProcessor->setValue('month', htmlspecialchars($resident['Month']));
            $templateProcessor->setValue('year', htmlspecialchars($resident['Year']));
            // Add other replacements as needed

            // Save the file in memory and send it for download
            $tempFile = tempnam(sys_get_temp_dir(), 'word');
            $templateProcessor->saveAs($tempFile);

            if (file_exists($tempFile)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                header('Content-Disposition: attachment; filename="' . htmlspecialchars($resident['doc_name'] . '_' . $resident['res_fname'] . '_' . $resident['res_lname'] . '_' . date('d-M-Y')) . '.docx"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($tempFile));
                readfile($tempFile);
                unlink($tempFile); // delete the temporary file
                exit; // Ensure script stops here after download
            } else {
                echo json_encode(['stat' => 'error', 'message' => 'Error generating document.']);
            }
        } else {
            echo json_encode(['stat' => 'error', 'message' => 'Resident not found.']);
        }
    } else {
        echo json_encode(['stat' => 'error', 'message' => 'Invalid status.']);
    }
} else {
    echo json_encode(['stat' => 'error', 'message' => 'Invalid request.']);
}
?>
