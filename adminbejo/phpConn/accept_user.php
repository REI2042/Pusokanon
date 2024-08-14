<?php
    include '../../db/DBconn.php'; // Adjust the path as needed

    if (isset($_POST['res_id'])) {
        $res_id = $_POST['res_id'];

        // Begin transaction
        $pdo->beginTransaction();
        try {
            // Fetch user from registration table 
            $sql = "UPDATE resident_users SET account_active_status = 'Active' WHERE res_ID = :res_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':res_id', $res_id, PDO::PARAM_INT);
            $stmt->execute();

            $pdo->commit();
            
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
?>