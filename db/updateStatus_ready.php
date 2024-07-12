<?php
include 'DBconn.php';
date_default_timezone_set('Asia/Manila');

if (isset($_GET['doc_ID'], $_GET['status'], $_GET['seconds'])) {
    $doc_ID = $_GET['doc_ID'];
    $status = $_GET['status'];
    $seconds = (int)$_GET['seconds'];

    ignore_user_abort(true);
    set_time_limit(0);

    // Sleep for the specified number of seconds
    sleep($seconds);

    // Update status after sleep
    $sql = "UPDATE request_doc SET stat = :status WHERE doc_ID = :doc_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':doc_ID', $doc_ID, PDO::PARAM_INT);
    $stmt->execute();
}
?>
