<?php
include 'DBconn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST['username'];
    $password = $_POST['userPassword'];

    // Query to check barangay staff table
    $sqlStaff = "SELECT * FROM barangay_staff WHERE user_name = :userName";
    $stmtStaff = $pdo->prepare($sqlStaff);
    $stmtStaff->execute([':userName' => $email]);
    $staff = $stmtStaff->fetch();

    // Query to check resident user table
    $sqlResident = "SELECT * FROM resident_users WHERE res_email = :res_email AND is_active = TRUE"; // my changes
    $stmtResident = $pdo->prepare($sqlResident);
    $stmtResident->execute(['res_email' => encryptData($email)]);
    $resident = $stmtResident->fetch();

    // Check if either staff or resident exists
    if ($staff) {
        if ($staff['status'] === 'DEACTIVATED') {
            header("Location: ../login.php?status=deactivated");
            exit();
        } elseif (password_verify($password, $staff['staff_password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['userRole'] = $staff['userRole_id'];
            $_SESSION['username'] = $staff['user_name'];
            
            if ($staff['userRole_id'] == 1 || $staff['userRole_id'] == 3) { // Admin roles
                header("Location: ../adminbejo/Dashboard.php");
                exit();
            }
        }
    } elseif ($resident && password_verify($password, $resident['res_password'])) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['userRole'] = 2; // Resident
        $_SESSION['res_fname'] = $resident['res_fname'];
        $_SESSION['birth_date'] = $resident['birth_date']; 
        $_SESSION['res_midname'] = $resident['res_midname']; // Store user middle name in session
        $_SESSION['res_lname'] = $resident['res_lname']; // Store user last name in session
        $_SESSION['res_suffix'] = isset($resident['res_suffix']) ? $resident['res_suffix'] : '';
        $_SESSION['gender'] = $resident['gender']; 
        $_SESSION['civil_status'] = $resident['civil_status'];
        $_SESSION['contact_no'] = $resident['contact_no'];
        $_SESSION['citizenship'] = $resident['citizenship'];
        $_SESSION['place_birth'] = $resident['place_birth'];
        $_SESSION['registered_voter'] = $resident['registered_voter'];
        $_SESSION['addr_sitio'] = $resident['addr_sitio'];
        $_SESSION['res_email'] = decryptData($resident['res_email']); // Store user email in session
        $_SESSION['res_ID'] = $resident['res_ID']; // Store user ID in session
        $_SESSION['profile_picture'] = $resident['profile_picture'];
        
        // Redirect to resident landing page
        header("Location: ../resident_landingPage.php");
        exit();
    } else {
        // User not found
        header("Location: ../login.php?status=invalid");
        exit();
    }
}
?>
