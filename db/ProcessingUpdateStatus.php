<?php
include 'DBconn.php';
require_once '../vendor/autoload.php'; // Ensure this is the correct path to the autoload file for PhpOffice

use PhpOffice\PhpWord\TemplateProcessor;

header('Content-Type: application/json');

// if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['doc_ID'], $_GET['status'])) {
//     $doc_ID = $_GET['doc_ID'];
//     $status = $_GET['status'];

    // Retrieve resident information from the database based on doc_ID
    // $query = "SELECT res_fname, res_lname FROM residents WHERE doc_ID = ?";
    // $stmt = $conn->prepare($query);
    // $stmt->bind_param("i", $doc_ID);
    // $stmt->execute();
    // $result = $stmt->get_result();
    // $resident = $result->fetch_assoc();

    // if ($resident) {
    //     $day = date('jS');
    //     $month = date('F');
    //     $year = date('Y');
    //     $templateProcessor = new TemplateProcessor('../template.docx');
    //     $templateProcessor->setValue('name', $resident['res_fname'] . ' ' . $resident['res_lname']);
    //     $templateProcessor->setValue('date', $day);
    //     $templateProcessor->setValue('month', $month);
    //     $templateProcessor->setValue('year', $year);
    //     // Add other replacements as needed

    //     $pathtosave = 'output_' . $resident['res_fname'] . '_' . $resident['res_lname'] . '.docx';
    //     $templateProcessor->saveAs($pathtosave);

    //     // Provide file download (optional)
    //     header('Content-Description: File Transfer');
    //     header('Content-Disposition: attachment; filename="' . basename($pathtosave) . '"');
    //     header('Content-Length: ' . filesize($pathtosave));
    //     header('Pragma: public');
    //     if (readfile($pathtosave)) {
    //         // Redirect after file download
    //         header('Location: ../adminbejo/Barangay-Residency.php');
    //         exit;
    //     } else {
    //         echo json_encode(['stat' => 'error', 'message' => 'Error generating document.']);
    //     }
    // } else {
    //     echo json_encode(['stat' => 'error', 'message' => 'Resident not found.']);
    // }
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['doc_ID'], $_GET['status'])) {
        $doc_ID = $_GET['doc_ID'];
        $status = $_GET['status'];
    
        $sql = "UPDATE request_doc SET stat = :status WHERE doc_ID = :doc_ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
        if ($stmt->execute()) { 
            echo json_encode(['stat' => 'success']);
            header('location: ../adminbejo/Barangay-Residency.php');
            exit();
        } else {
            echo json_encode(['stat' => 'error', 'message' => 'Error updating record.']);
        }
    } else {
        echo json_encode(['stat' => 'error', 'message' => 'Invalid request.']);
    }

?>
