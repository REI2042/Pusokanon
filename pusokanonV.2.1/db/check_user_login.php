<?php
include 'DBconn.php'; // Include your PDO connection script

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
        // Start session
        session_start();
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['userRole'] = $staff['userRole_id']; // Assuming 'userRole_id' is the column containing the user's role
        // Redirect to appropriate dashboard based on role
        if ($_SESSION['userRole'] == 1) {
            header("Location: adminbejo/Admin-Dashboard.php");
            exit();
        } else {

            header("Location: restrict_users_pages.php");
            exit();
        }
    } elseif ($resident) {
        // Start session
        session_start();
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['userRole'] = 2; // Assuming '2' represents the resident role
        // Redirect to resident dashboard
        header("Location: resident_landingPage.php");
        exit();
    } else {
        // User not found or incorrect credentials
        echo "Invalid username or password";
    }
}
?>
