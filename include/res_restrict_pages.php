<?php

session_start();

// Check if user is not logged in
if (!isset($_SESSION['loggedin'])) {

    header("Location: login.php");
    exit();
}


if ($_SESSION['userRole'] != 2) {
  
    header("Location: include/logout.php");
    exit();
}

?>
