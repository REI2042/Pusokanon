<?php
require_once '../../db/DBconn.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['staff_id'])) {
    $staff_id = $_POST['staff_id'];

    $query = "UPDATE barangay_staff SET status = 'ACTIVE' WHERE staff_id = :staff_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "Error";
    }
}
?>
