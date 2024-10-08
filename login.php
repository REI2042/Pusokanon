<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['userRole'] == 2) { // Admin roles
        header("Location: resident_landingPage.php");
        exit();
    }else{
        header("Location: adminbejo/Dashboard.php");
        exit();
    }
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

    <link rel="stylesheet" href="css/navbarstyles.css">
    <link rel="stylesheet" href="css/stylesLogin.css">
    <title>Login to Pusokanon</title>
</head>
<body>
     <header>
        <nav class="navbar navbar-expand-lg" id="mainNavbar">
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
                        <a class="nav-link" href="Barangay-Announcements.php">Announcement</a>
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

    <div class="content-wrapper">
        <main>
            <section class="holder-section mt-4">
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header bg-#48BF91 text-white">
                            <h4 class="text-center mt-2" id="loginText">Login</h4>
                                <hr>
                        </div>
                        <div class="card-body mt-3">
                            <form action="db/check_user_login.php" method="POST">
                                <div class="mb-3">
                                    <label for="text" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="username" id="email" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-3" style="border-radius: 5px;">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="userPassword" id="password" placeholder="Enter your password" required>
                                        <div class="input-group-append" style="border: 1px solid #ced4da; border-radius: 0 5px 5px 0;">
                                            <button class="btn btn-white bg-white" type="button" id="togglePassword" style="border: none;">
                                                <i class="bi bi-eye" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <style>
                                        @media (max-width: 767px) {
                                            .input-group-append {
                                                position: absolute;
                                                right: 0;
                                                top: 0;
                                                bottom: 0;
                                                z-index: 3;
                                            }
                                            #togglePassword {
                                                height: 100%;
                                            }
                                        }
                                    </style>                                
                                </div>
                                <script>
                                    document.getElementById('togglePassword').addEventListener('click', function () {
                                        const password = document.getElementById('password');
                                        const icon = document.getElementById('toggleIcon');
                                        if (password.type === 'password') {
                                            password.type = 'text';
                                            icon.classList.remove('bi-eye');
                                            icon.classList.add('bi-eye-slash');
                                        } else {
                                            password.type = 'password';
                                            icon.classList.remove('bi-eye-slash');
                                            icon.classList.add('bi-eye');
                                        }
                                    });
                                </script>                                
                                <div class="text-center mt-4">
                                    <a href="forgotpass.php" class="link text-white"><small>Forgot Password</small></a>
                                </div>
                                <div class="text-center d-grid col-8 mx-auto mt-2">
                                    <button type="submit" class="btn btn-success">Login</button>
                                </div>
                                <div class="text-center mt-3">
                                    <small class="smallText">Don't have an account?</small><a href="registration.php" class="link-warning"> Sign Up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        <?php
        if (isset($_SESSION['login_error'])) {
            echo 'const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener("mouseenter", Swal.stopTimer)
                    toast.addEventListener("mouseleave", Swal.resumeTimer)
                }
            });
            
            Toast.fire({
                icon: "error",
                title: "Login Failed",
                text: "Invalid username or password.",
                customClass: {
                    container: "mt-5 pt-3"         
               }
            });';
            unset($_SESSION['login_error']);
        }
        ?>

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status === 'deactivated') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'error',
                    title: 'Account Deactivated',
                    text: 'Account has been deactivated. Please contact your Admin.',
                    customClass: {
                        container: "mt-5 pt-3"         
                    }
                });
            }        
        });

        document.addEventListener('click', function(event) {
            const navbar = document.getElementById('mainNavbar');
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            if (!navbar.contains(event.target) && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    </script>
</body></body>
</html>
