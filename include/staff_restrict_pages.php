<?php

session_start();

// Check if user is not logged in
if (!isset($_SESSION['loggedin'])) {

    header("Location: ../login.php");
    exit();
}

// Check if user is a resident
if ($_SESSION['userRole'] == 2) {

    header("Location: ../resident_landingPage.php");
    exit();
}


?>