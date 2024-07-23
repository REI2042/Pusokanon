<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    $newStatus = ($action === 'activate') ? 1 : 0;

    $sql = "UPDATE resident_users SET is_active = :status WHERE res_ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':status', $newStatus, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>