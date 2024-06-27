<?php
session_start();
include 'DBconn.php';

error_log(print_r($_POST, true)); // Debug statement

if (isset($_POST['docTypeId']) && isset($_POST['purposeId']) && isset($_POST['purposeName'])) {
    $resId = $_SESSION['res_ID'];
    $docTypeId = $_POST['docTypeId'];
    $purposeId = $_POST['purposeId'];
    $purposeName = $_POST['purposeName']; 
    $stat = 'pending';
    // $dateReq = date('Y-m-d H:i:s');
    $remarks = 'Not released';

    try {
        $sql = "INSERT INTO request_doc (res_ID, docType_id, purpose_id, purpose_name, stat,  remarks) VALUES (:resId, :docTypeId, :purposeId, :purposeName, :stat, :remarks)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':resId' => $resId,
            ':docTypeId' => $docTypeId,
            ':purposeId' => $purposeId,
            ':purposeName' => $purposeName, 
            ':stat' => $stat,
            // ':dateReq' => $dateReq,
            ':remarks' => $remarks
        ]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log the error for debugging
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}
?>
