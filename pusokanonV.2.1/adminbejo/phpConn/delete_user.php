<?php
    include '../../db/DBconn.php'; // Adjust the path as needed

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM registration_tbl WHERE res_ID = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
?>
