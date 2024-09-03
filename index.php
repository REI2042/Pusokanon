<?php

session_start();

// Check if user is logged in
if (isset($_SESSION['loggedin'])) {

    header("Location: resident_landingPage.php");
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


    <title>Pusokanon</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="index.php"> 
                <img src="PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo"><span > PUSOKANON</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="requestDocument.php">Request Documents</a>
                            <a class="dropdown-item" href="#">File Complaint</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="Announcement.php">Announcement</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <a class="dropdown-item" href="aboutus-barangayInfo.php">Barangay Info</a>
                            <a class="dropdown-item" href="aboutus-barangayOfficials.php">Barangay Officials</a>
                            <a class="dropdown-item" href="barangayMap.php">Barangay Map</a>
                        </div>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link" href="emergency-hotlines.php">Hotlines</a>
                    </li>   
                    <li class="nav-item1">
                        <a class="nav-link" href="login.php">
                        <div class="row align-items-center">
                            <div class="col-6 pr-0"><span class="login-text">Login</span></div>
                            <div class="col-6"><i class="bi-person-circle"></i></div>
                        </div>
                    </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
<link rel="stylesheet" href="css/indexstyles.css">

	<main>
        <section class="welcome-section">
            <div class="text-center">
                <div class="banner">
                    <span class="text-center">WELCOME <br>PUSOKANON</span><br>
                    <button class="text-center" type="button" onclick="toServices()">Padayon</button>
                </div>
            </div>
        </section>

        <section class="services" id="services-box">
        <div class="container">
                <div class="row">
                    <div class="col-md-4 btn" onclick="requestDoc()">
                        <div class="service-card">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <h3 class="mt-1 p-1">Request Documents</h3>
                            <p>Request official documents such as barangay clearance, certificates, Cedukla and other important papers through online.</p>                       
                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toHotlines()">
                        <div class="service-card">
                            <i class="fa-solid fa-phone-volume m-2"></i>
                            <h3>Emergency Hotlines</h3>
                            <p>Access important emergency contact numbers for quick response in case of urgent situations within the barangay.</p>                        
                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toMap()">
                        <div class="service-card">
                            <i class="fa-solid fa-map-location-dot fa-sm " style="color: white; margin:2rem"></i>
                            <h3>Barangay Map</h3>
                            <p>View an interactive map of the barangay to locate important landmarks, facilities, and services within our community.</p>                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 btn" onclick="toFileComplaints()">
                        <div class="service-card">
                            <i class="fa-solid fa-file-pen"></i>
                            <h3>File Complain</h3>
                            <p>Submit complaints or concerns about community issues directly to the barangay officials for prompt attention and resolution.</p>                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toNews()">
                        <div class="service-card">
                            <i class="bi bi-megaphone-fill m-2" style="font-size: 2.9rem;"></i>  
                            <h3>News & Updates</h3>
                            <p>Stay informed about the latest news, announcements, and events happening in Barangay Pusok through Pusokanon</p>      
                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toOfficials()">
                        <div class="service-card">
                            <i class="fa-solid fa-users-line"></i>
                            <h3>Barangay Officials</h3>
                            <p>View information about Barangay Pusok officials, their roles, and responsibilities in our community.</p>                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<script>
    function toServices() {
        window.location.href = "#services-box";
    }

    function requestDoc(){
        window.location.href = 'requestDocument.php';
    }
    function toHotlines(){
        window.location.href = 'emergency-hotlines.php';
    }
    function toMap(){
        window.location.href = 'barangayMap.php';
    }
    function toFileComplaints(){
        window.location.href ='residentComplaints.php';
    }
    function toNews(){
        window.location.href = '#';
    }
    function toOfficials(){
        window.location.href = 'aboutus-barangayOfficials.php';
    }
</script>
        <footer class="" id="footer">
            <div class="footerContainer">
                <p>&copy; 2024 Barangay Pusok, Lapu-Lapu City. All rights reserved. </p>  
            </div>
        </footer>
        
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>