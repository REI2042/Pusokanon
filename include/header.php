<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {// Check if the user is logged in
    
    $firstName = isset($_SESSION['res_fname'] ) ? $_SESSION['res_fname'] : '';// If logged in display the user's first name
} else {
    header("Location: login.php"); // redirect to login page if ot log in
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="PicturesNeeded/pusokLogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="css/navbarstyles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>Pusokanon</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="resident_landingPage.php"> 
                <img src="PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo"><span class> PUSOKANON</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="resident_landingPage.php">Home</a>
                    </li>

                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="requestDocument.php">Request Documents</a>
                            <a class="dropdown-item" href="residentComplaints.php">File Complaint</a>
                        </div>
                    </li>

                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="#">Updates</a>
                    </li>

                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <a class="dropdown-item" href="Resaboutus-barangayInfo.php">Barangay Info</a>
                            <a class="dropdown-item" href="Resaboutus-barangayOfficials.php">Barangay Officials</a>
                            <a class="dropdown-item" href="ResbarangayMap.php">Barangay Map</a>
                        </div>
                    </li>
    
                    <li class="nav-item mt-2 pt-1 me-3">
                        <a class="nav-link" href="Resemergency-hotlines.php">Hotlines</a>
                    </li>   
                    <li class="nav-item mt-1">
                        <div class="dropdown">
                            <a class="nav-link text-light" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="row">
                                    <div class="col px-1 mt-1 pt-1">
                                        <span class="login-text"><?php echo $firstName; ?></span>
                                    </div>
                                    <div class="col"><i class="bi-person-circle"></i></div>
                                </div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="loginDropdown">
                                <a class="dropdown-item" href="accountProfile.php">Settings</a>
                                <a class="dropdown-item" href="include/logout.php">Logout</a>
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
