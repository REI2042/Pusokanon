<?php
    include '../../db/DBconn.php'; // Adjust the path as needed

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM resident_users WHERE res_ID = ? AND account_active_status = 'Unregistered'";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
?>
