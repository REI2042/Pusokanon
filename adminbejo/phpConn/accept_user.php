<?php
    include '../../db/DBconn.php'; // Adjust the path as needed

    if (isset($_POST['res_id'])) {
        $res_id = $_POST['res_id'];

        // Begin transaction
        $pdo->beginTransaction();
        try {
            // Fetch user from registration table
            $fetchSql = "SELECT res_ID, res_fname, res_lname, res_midname, res_suffix, gender, birth_date, civil_status, registered_voter, citizenship, contact_no, place_birth, addr_sitio, res_email, res_password, userRole_id FROM registration_tbl WHERE res_ID = ?";
            $fetchStmt = $pdo->prepare($fetchSql);
            $fetchStmt->execute([$res_id]);
            $userData = $fetchStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($userData) {
                // Insert user into resident table
                $insertSql = "INSERT INTO resident_users (res_ID, res_fname, res_lname, res_midname, res_suffix, gender, birth_date, civil_status, registered_voter, citizenship, contact_no, place_birth, addr_sitio, res_email, res_password, userRole_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $insertStmt = $pdo->prepare($insertSql);
                $insertStmt->execute([
                    $userData['res_ID'], 
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
                    $userData['res_email'],
                    $userData['res_password'],
                    $userData['userRole_id']
                ]);

                // Delete user from registration table
                $deleteSql = "DELETE FROM registration_tbl WHERE res_ID = ?";
                $deleteStmt = $pdo->prepare($deleteSql);
                $deleteStmt->execute([$res_id]);

                // Commit transaction
                $pdo->commit();
                echo "Success";
            } else {
                throw new Exception("User not found in registration table");
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
?>