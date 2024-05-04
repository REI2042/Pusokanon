<?php
    include '../db/DBconn.php'; // Adjust the path as needed

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Begin transaction
        $pdo->beginTransaction();
        try {
            // Fetch user from registration table
            $fetchSql = "SELECT * FROM registration WHERE res_id = ?";
            $fetchStmt = $pdo->prepare($fetchSql);
            $fetchStmt->execute([$id]);
            $userData = $fetchStmt->fetch(PDO::FETCH_ASSOC);

            // Insert user into resident table
            $insertSql = "INSERT INTO resident (name, age, sitio, registered_voter) VALUES (?, ?, ?, ?)";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute([$userData['name'], $userData['age'], $userData['sitio'], $userData['registered_voter']]);

            // Delete user from registration table
            $deleteSql = "DELETE FROM registration WHERE res_id = ?";
            $deleteStmt = $pdo->prepare($deleteSql);
            $deleteStmt->execute([$id]);

            // Commit transaction
            $pdo->commit();
            echo "Success";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
?>
