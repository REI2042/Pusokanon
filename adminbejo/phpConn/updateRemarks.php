<?php
require 'database.php'; // Make sure to include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doc_ID = $_POST['doc_ID'];
    $request_ID = $_POST['request_ID'];
    $remarks = 'released';

    $sql = "UPDATE request_doc SET remarks = :remarks WHERE doc_ID = :doc_ID AND request_id = :request_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
    $stmt->bindParam(':request_ID', $request_ID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['stat' => 'success']);
        header('Location: Barangay-residency.php');
    } else {
        echo json_encode(['stat' => 'fail']);
    }
}
?>
