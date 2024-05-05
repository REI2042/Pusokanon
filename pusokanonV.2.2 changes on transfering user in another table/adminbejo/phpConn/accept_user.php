<?php
    include '../../db/DBconn.php'; // Adjust the path as needed

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Begin transaction
        $pdo->beginTransaction();
        try {
            // Fetch user from registration table
            $fetchSql = "SELECT * FROM registration_tbl WHERE res_ID = ?";
            $fetchStmt = $pdo->prepare($fetchSql);
            $fetchStmt->execute([$id]);
            $userData = $fetchStmt->fetch(PDO::FETCH_ASSOC);

            // Insert user into resident table
            $insertSql = "INSERT INTO resident_users (res_ID, res_fname, res_lname, res_midname, res_suffix, gender, birth_date, civil_status, registered_voter, citizenship, contact_no, place_birth, addr_sitio, addr_purok, res_email, res_password, userRole_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->execute([$userData['res_ID'], 
                                $userData['res_fname'], 
                                $userData['res_lname'], 
                                $userData['res_midname'],
                                $userData['res_suffix'],
                                $userData['gender'],
                                $userData['birth_date'],
                                $userData['civil_status'],
                                $userData['registered_voter'],
                                $userData['citizenship'],
                                $userData['contact_no'],
                                $userData['place_birth'],
                                $userData['addr_sitio'],
                                $userData['addr_purok'],
                                $userData['res_email'],
                                $userData['res_password'],
                                $userData['userRole_id']]);

            // Delete user from registration table
            $deleteSql = "DELETE FROM registration_tbl WHERE res_ID = ?";
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
