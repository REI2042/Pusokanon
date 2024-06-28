<?php
require 'database.php'; // Make sure to include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    $doc_ID = $input['doc_ID'];
    $request_ID = $input['request_id'];
    $resident_id = $input['resident_id'];
    $remarks = 'released';

    $sql = "UPDATE request_doc SET remarks = :remarks WHERE doc_ID = :doc_ID AND res_id = :resident_id AND request_id = :request_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
    $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
    $stmt->bindParam(':resident_id', $resident_id, PDO::PARAM_INT);
    $stmt->bindParam(':request_ID', $request_ID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['stat' => 'success']);
    } else {
        echo json_encode(['stat' => 'fail']);
    }
}
?>
