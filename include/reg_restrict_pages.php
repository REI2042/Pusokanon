<?php

session_start();


// Check if user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['userRole'] == 2) {

        header("Location: index.php");
        exit();
    }
?>
