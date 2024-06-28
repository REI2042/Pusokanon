<?php
include '../../db/DBconn.php';

$data = json_decode(file_get_contents('php://input'), true);

$docTypeId = $data['docTypeId'];
$newPrice = $data['newPrice'];

try {
    $sql = "UPDATE doc_type SET doc_amount = :newPrice WHERE docType_id = :docTypeId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':newPrice', $newPrice, PDO::PARAM_INT);
    $stmt->bindParam(':docTypeId', $docTypeId, PDO::PARAM_INT);
    $stmt->execute();

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
