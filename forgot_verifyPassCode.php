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

    <link rel="stylesheet" href="css/navbarstyles.css">
    <link rel="stylesheet" href="css/stylesLogin.css">
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
	<link rel="stylesheet" href="css/enterVerify.css">
    <div class="container">
        <h3>Enter Verification Code</h3>
        <p>Please enter the 6-digit verification code sent to your email.</p>
        <form id="codeForm">
            <div class="mb-3 row justify-content-center">
                <label for="code" class="form-label"></label>
                <div class="d-flex justify-content-center gap-2">
                    <input type="text" class="form-control text-center" id="code1" required maxlength="1" inputmode="numeric" autocomplete="off">
                    <input type="text" class="form-control text-center" id="code2" required maxlength="1" inputmode="numeric" autocomplete="off">
                    <input type="text" class="form-control text-center" id="code3" required maxlength="1" inputmode="numeric" autocomplete="off">
                    <input type="text" class="form-control text-center" id="code4" required maxlength="1" inputmode="numeric" autocomplete="off">
                    <input type="text" class="form-control text-center" id="code5" required maxlength="1" inputmode="numeric" autocomplete="off">
                    <input type="text" class="form-control text-center" id="code6" required maxlength="1" inputmode="numeric" autocomplete="off">
                </div>
            </div>
            <button type="submit" class="btn btn-success w-100">Verify Code</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        document.getElementById('codeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const inputs = [
                document.getElementById('code1'),
                document.getElementById('code2'),
                document.getElementById('code3'),
                document.getElementById('code4'),
                document.getElementById('code5'),
                document.getElementById('code6')
            ];

            const code = inputs.map(input => input.value).join('');

            if (!/^\d{6}$/.test(code)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Please enter 6 digits only.',
                });
                return;
            }

            fetch('db/verify_forgotCode.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ code: code })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Code verified successfully!',
                    }).then(() => {
                        window.location.href = 'Forgot_changePass.php';
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message,
                });
            });
        });

        // Add input validation for each input field
        const inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach(input => {
            input.addEventListener('input', function(e) {
                if (!/^\d*$/.test(e.target.value)) {
                    e.target.value = e.target.value.replace(/[^\d]/g, '');
                }
            });
        });
    </script>
</body>
</html>
