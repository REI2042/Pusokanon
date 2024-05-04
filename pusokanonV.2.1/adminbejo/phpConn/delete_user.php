<?php
    include '../db/DBconn.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM registration WHERE res_ID = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$id])) {
            echo "Success";
        } else {
            echo "Error";
        }
    }
?>