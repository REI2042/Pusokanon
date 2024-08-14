<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resId = $_POST['resId'];
    $newStatus = $_POST['newStatus'] === 'Activate' ? 1 : 0;

    try {
        $sql = "UPDATE resident_users SET account_active_status = :newStatus WHERE res_ID = :resId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
        $stmt->bindParam(':resId', $resId, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}