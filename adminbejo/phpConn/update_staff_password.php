<?php

include '../../db/DBconn.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['staff_id'], $data['password'])) {
        $staff_id = $data['staff_id'];
        $password = hashPassword($data['password']);

        try {
            $sql = "UPDATE barangay_staff SET staff_password = :password WHERE staff_id = :staff_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':staff_id', $staff_id);

            if ($stmt->execute()) {
                echo json_encode(['success' => 'Password updated successfully']);
            } else {
                echo json_encode(['error' => 'Error updating password']);
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

?>
