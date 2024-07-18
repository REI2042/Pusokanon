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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<link rel="stylesheet" href="css/changepass.css">
	<div class="content-wrapper mx-3">
		<div class="container">
			<div class="text-header row px-0">
				<a class="text-light" href="login.php">
				<div class="icon col-sm-1">
					<i class="fa-solid fa-chevron-left"></i>
				</div>
				</a>
				<div class="text-h1 col">
					<h3 class="header-text text-light">Change Password</h3>
				</div>
			</div>
			<hr>
			<div class="form-container">
				<form class="forgot-pass" id="forgotForm" method="POST" autocomplete="off">
					<div class="row mb-3">
						<div class="col">
							<label for="password" class="form-label">New Password:</label>
                        	<input type="password" class="form-control" id="password" name="password" placeholder="New Password" required autocomplete="off">
						</div><div class="w-100"></div>
						<div class="col mt-3">
							<label for="password" class="form-label">Confirm Password:</label>
                        	<input type="password" class="form-control" id="confirmPassword" placeholder="Comfirm Password" required autocomplete="off">
                            <div id="passwordMatchError" style="color: red; display: none;">Passwords do not match</div>
						</div>
						<div class="w-100"></div>
						<div class="col text-center">
							<button type="submit" class="btn text-light bg-success" id="submit">Change Password</button>
						</div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMatchError = document.getElementById('passwordMatchError');
        const submitButton = document.getElementById('submit');
        const forgotForm = document.getElementById("forgotForm");

        function validatePassword() {
            const isMatch = passwordInput.value === confirmPasswordInput.value;
            passwordMatchError.style.display = isMatch ? 'none' : 'block';
            submitButton.disabled = !isMatch;
        }

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validatePassword);

        forgotForm.addEventListener("submit", function(event) {
            event.preventDefault();
            if (passwordInput.value !== confirmPasswordInput.value) {
                passwordMatchError.style.display = 'block';
                return;
            }
            fetch('db/forget_create_newpass.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({
                    email: '<?php echo $_SESSION["email"]; ?>',
                    password: passwordInput.value
                })
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    icon: data.success ? 'success' : 'error',
                    title: data.success ? 'Success' : 'Error',
                    text: data.success ? 'Password changed successfully.' : 'Password change failed.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    if (data.success) window.location.href = "login.php";
                });
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</html>