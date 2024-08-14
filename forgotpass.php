<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header("Location: resident_landingPage.php");
    exit();
}

include 'db/check_user_login.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/navbarstyles.css">
    <link rel="stylesheet" href="css/forgotpass.css">
    <title>Login to Pusokanon</title>
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
                    <li class="nav-item1">
                        <a class="nav-link" href="#">Updates</a>
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
                    <li class="nav-item">
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
    
    <div class="container">
        <h3>Forgot Password</h3>
        <p class="text-center">Please enter your email for the verification process. A 4-digit code will be sent to your email.</p>
        <form id="emailForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success">Send Verification Code</button>
            </div>
        </form>
    </div>

   
</body>
</html>
<script>
    (function () {
        emailjs.init('-eg-XfJjgYaCKpd3Q');
    })();

    document.getElementById('emailForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value;
        const code = Math.floor(100000 + Math.random() * 900000); // 6-digit code

        fetch('db/send_forgotCode.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email, code: code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                emailjs.send('service_uhvx5cl', 'template_50i4ter', {
                    to_email: email,
                    code: code
                }).then(() => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Code sent to your email!"
                    });
                    setTimeout(() => {
                        window.location.href = 'forgot_verifyPassCode.php';
                    }, 3000);
                }).catch(error => {
                    console.error('EmailJS Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to send email: ' + error,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
        });
    });
</script>