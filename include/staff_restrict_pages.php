<?php

session_start();

// Check if user is not logged in
if (!isset($_SESSION['loggedin'])) {

    header("Location: ../login.php");
    exit();
}

// Check if user is a resident
if ($_SESSION['userRole'] == 2) {

    header("Location: resident_landingPage.php");
    exit();
}

if ($_SESSION['userRole'] == 3) {
 
    header("Location: pendingUsers.php");
    exit();
}


if ($_SESSION['userRole'] != 1) {
  
    
    echo "<script>alert('You do not have access on that page');</script>";
}

?>