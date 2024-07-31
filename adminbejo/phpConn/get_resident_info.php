<?php
    include '../../db/DBconn.php';

    if (isset($_GET['id'])) {
        $resId = $_GET['id'];
        
        $sql = "SELECT * FROM resident_users WHERE res_ID = :resId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':resId', $resId, PDO::PARAM_INT);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            $user['res_email'] = decryptData($user['res_email']);

            $birthDate = new DateTime($user['birth_date']);
            $user['formatted_birth_date'] = $birthDate->format('F j, Y');

            $birthDate = new DateTime($user['birth_date']);
            $user['formatted_birth_date'] = $birthDate->format('F j, Y');

            $today = new DateTime();
            $age = $today->diff($birthDate)->y;
            $user['age'] = $age;

            $user['formatted_voter_status'] = ($user['registered_voter'] === 'Registered') ? 'Yes' : 'No';
            
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        echo json_encode(['error' => 'No ID provided']);
    }
?>