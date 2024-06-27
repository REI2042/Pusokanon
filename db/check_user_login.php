<?php
include 'DBconn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST['username'];
    $password = $_POST['userPassword'];

    // Query to check barangay staff table
    $sqlStaff = "SELECT * FROM barangay_staff WHERE staff_email = :staff_email AND staff_password = :staff_password";
    $stmtStaff = $pdo->prepare($sqlStaff);
    $stmtStaff->execute(['staff_email' => $email, 'staff_password' => $password]);
    $staff = $stmtStaff->fetch();

    // Query to check resident user table
    $sqlResident = "SELECT * FROM resident_users WHERE res_email = :res_email AND res_password = :res_password";
    $stmtResident = $pdo->prepare($sqlResident);
    $stmtResident->execute(['res_email' => $email, 'res_password' => $password]);
    $resident = $stmtResident->fetch();

    // Check if either staff or resident exists
    if ($staff) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['userRole'] = $staff['userRole_id'];

        if ($_SESSION['userRole'] == 1) { // Admin
            header("Location: adminbejo/Admin-Dashboard.php");
            exit();
        } else {
            header("Location: ../include/staff_restrict_pages.php");
            exit();
        }
    } elseif ($resident) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['userRole'] = 2; // Resident
        $_SESSION['res_fname'] = $resident['res_fname'];
        $_SESSION['birth_date'] = $resident['birth_date']; 
        $_SESSION['res_midname'] = $resident['res_midname']; // Store user middle name in session
        $_SESSION['res_lname'] = $resident['res_lname']; // Store user last name in session
        $_SESSION['gender'] = $resident['gender']; 
        $_SESSION['civil_status'] = $resident['civil_status']; 
        $_SESSION['res_email'] = $resident['res_email']; // Store user email in session
        $_SESSION['res_ID'] = $resident['res_ID']; // Store user ID in session
        // Redirect to resident landing page
        header("Location: resident_landingPage.php");
        exit();
    } else {
        // User not found 
        echo "Invalid username or password";
    }
}
?>
