<?php
    include '../../db/DBconn.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resID = $_POST["resID"];
        $newStatus = $_POST["newStatus"];

        // Update the database
        $sql = "UPDATE registration_tbl SET registered_voter = ? WHERE res_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newStatus, $resID]);

        // Send response
        echo "Status updated successfully";
    }
?>