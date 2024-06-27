<?php
session_start();
include 'db_connect.php';

require_once 'vendor/autoload.php';
use PhpOffice\PhpWord\TemplateProcessor;

if (!isset($_SESSION['resident_id'])) {
    die("Please login first.");
}

$resident_id = $_SESSION['resident_id'];
$document_type = $_POST['document_type'];

$sql = "INSERT INTO requests (resident_id, document_type) VALUES ('$resident_id', '$document_type')";
if ($conn->query($sql) === TRUE) {
    echo "Document request submitted successfully.";
    
    // Generate the word document
    $resident_sql = "SELECT name FROM residents WHERE id = '$resident_id'";
    $resident_result = $conn->query($resident_sql);
    $resident = $resident_result->fetch_assoc();
    
    $name = $resident['name'];
    
    // Load the template and replace the placeholder
    $templateProcessor = new TemplateProcessor('template.docx');
    $templateProcessor->setValue('name', $name);
    
    $pathtosave = 'output_' . $resident_id . '.docx';
    
    // Send the generated document to the user
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="' . basename($pathtosave) . '"');
    header('Content-Length: ' . filesize($pathtosave));
    header('Pragma: public');

    readfile($pathtosave);
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
