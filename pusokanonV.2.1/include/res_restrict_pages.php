<?php

session_start();

// Check if user is not logged in
if (!isset($_SESSION['loggedin'])) {

    header("Location: login.php");
    exit();
}

// if ($_SESSION['userRole'] == 3) {
 
//     header("Location: pendingUsers.php");
//     exit();
// }


if ($_SESSION['userRole'] != 2) {
  
    
    echo "<script>alert('You do not have access on that page');</script>";
    header("Location: logout.php");
    exit();
}

?>
