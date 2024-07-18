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

	<link rel="stylesheet" href="css/stylesRegistration2.css">
	<title>Register to Pusokanon</title>
	
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
	<?php
		if(isset($_GET['alert']) && $_GET['alert'] === 'exists') {
		    echo '<script>alert("Account has already been created");</script>';
		}
	?>	
<div class="container-fluid">
		<section class="holder-section">
			<div class="row container pb-3">
				<div class="row align-items-start holder-title mt-3 ">
					<div class="col">
						<h3 class=" text-center text-white">Register</h3><hr class="bg-white">
					</div>
				</div>
				<?php

					
				?>
				
				<form class="row gy-2 gx-3 text-white" action="db/data_SubmitToUpload.php" method="POST" enctype="multipart/form-data">
						<div class="col px-1">
	                  	    <label for="firstname" class="form-label">First Name</label>
                            <input type="text" name="fname" class="form-control" id="firstname" placeholder="First name" required>
	                    </div>
	                    <div class="col-md px-1 ">
	                        <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" name="lname" class="form-control" id="lastname" placeholder="Last name" required>
	                    </div>
	                    <div class="col px-1">
	                        <label for="midname" class="form-label">Middle Name</label>
                            <input type="text" name="mname" class="form-control" id="midname" placeholder="Middle name">
	                    </div>
	                    <div class="w-100"></div>
	                    <div class="col-6 px-1 mt-2">
                                    <label for="Suffix" class="form-label">Suffix</label>
                                    <select class="form-select" name="sufname" id="Suffix">
                                        <option value=" ">N/A</option>
                                        <option value="Jr">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II.">II</option>
                                        <option value="III">III</option>
                                    </select>
                                </div>
                        <div class="col-6 mt-2 px-1 ">
						    <label for="gender" class="form-label">Gender</label>
						    <select class="form-select" name="gender" id="gender" required>
						                <option value="Male">Male</option>
						                <option value="Female">Female</option>
						    </select>
						</div>
                        <div class="row">
	                        <div class="col-3 mt-2 px-1">
	                            <label for="quantity" class="form-label">Birthdate</label>
	                            <input class="form-control" type="number" id="quantity" name="bday" min="1" max="31" placeholder="Day" required>
	                        </div>
	                        <div class="col-4 mt-2 px-1">
	                            <label for="birthMonth" class="form-label">&nbsp;</label>
	                            <select class="form-select" name="bmonth" id="birthMonth" required>
	                                                <option value="">Month</option>
	                                                <option value="01">January</option>
								                    <option value="02">February</option>
								                    <option value="03">March</option>
								                    <option value="04">April</option>
								                    <option value="05">May</option>
								                    <option value="06">June</option>
								                    <option value="07">July</option>
								                    <option value="08">August</option>
								                    <option value="09">September</option>
								                    <option value="10">October</option>
								                    <option value="11">November</option>
								                    <option value="12">December</option>
							    </select>
							</div>
							<div class="col-4 mt-2 px-1" >
	                            <label for="birthYear" class="form-label">&nbsp;</label>
	                            <select class="form-select" name="byear" id="birthYear" required>
	                                <option value="">Year</option>
	                            </select>
							                <script>
							                    var select = document.getElementById("birthYear");
							                    var currentYear = new Date().getFullYear();
							                    var startYear = currentYear - 100;

							                    for (var year = currentYear; year >= startYear; year--) {
							                        var option = document.createElement("option");
							                        option.text = year;
							                        option.value = year;
							                        select.add(option);
							                    }
							                </script>
							</div>
						</div>
						<div class="col-6 mt-2 px-1">
						    <label for="status" class="form-label">Civil Status</label>
						    <select class="form-select" name="civilStatus" id="status" required>
						                <option value="Single">Single</option>
						                <option value="Married">Married</option>
						                <option value="Widowed">Widowed</option>
						    </select>
						</div>
						<div class="col-6 mt-2 px-1 ">
						    <label for="voter" class="form-label">Registered Voter</label>
						    <select class="form-select" name="voter" id="voter" required>
						                <option value="Not-registered">Non-registered</option>
						                <option value="Registered">Registered</option>
						    </select>
						</div>
						<div class="col-6 mt-2 px-1 ">
						   	<label for="citizenship" class="form-label">Citizenship</label>
						   	<input class="form-control" type="text" id="citizenship" name="citizenship" placeholder="Enter Citizenship" required>
						</div>
						<div class="col-6 mt-2 px-1">
						    <label for="Contact" class="form-label">Contact No</label>
						    <input type="text" class="form-control" name="contactNo" id="Contact" placeholder="Contact" required>
						</div>
						<div class="col-12 mt-2 px-1">
						    <label for="placeBirth" class="form-label">Place of birth</label>
						    <input type="text" class="form-control" name="placeBirth" id="placeBirth" placeholder="Place of Birth" required>
						</div>
						<div class="col-12 mt-2 px-1">
						    <small class="text-light">--Current Location in Pusok--</small>
						</div>
						<div class="w-100"></div>
						
						<div class="col px-1">
							<label for="sitio" class="form-label">Sitio</label>
							<select class="form-select" name="addsitio" id="sitio" required>
								<option value="Arca">Arca</option>
								<option value="Cemento">Cemento</option>
								<option value="Chumba-Chumba">Chumba-Chumba</option>
								<option value="Ibabao">Ibabao</option>
								<option value="Lawis">Lawis</option>
								<option value="Matumbo">Matumbo</option>
								<option value="Mustang">Mustang</option>
								<option value="New Lipata">New Lipata</option>
								<option value="San Roque">San Roque</option>
								<option value="Seabreeze">Seabreeze</option>
								<option value="Seaside">Seaside</option>
								<option value="Sewage">Sewage</option>
								<option value="Sta. Maria">Sta. Maria</option>
                        	</select>
							
						</div>
						<div class="col-12 px-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="accemail" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="col-12 px-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="accpassword" id="password" placeholder="Enter your password" required>
                        </div>
                        <div class="col-12 px-1">
						<label for="confirmPassword" class="form-label">Confirm Password</label>
							<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
							<div id="passwordMatchError" style="color: red; display: none;">Passwords do not match</div>
						</div>	
						<div class="text-center">
							<input class="form-check-input" type="checkbox" name="user_type" value="2" id="flexCheckIndeterminate" required>
							<label class="form-label" for="flexCheckIndeterminate">
							    I agree to <a href="#" class="link-warning">Terms & Conditions </a>
							</label>
						</div>
						<div class="text-center d-grid col-8 mx-auto">
                            <button type="submit" name="save_account" class="btn btn-success">Register</button>
                        </div>
				</form>
			</div>
		</section>
	</div>
	<script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMatchError = document.getElementById('passwordMatchError');
        const registerButton = document.getElementById('registerButton');

        function validatePassword() {
            if (confirmPasswordInput.value !== "" && passwordInput.value !== confirmPasswordInput.value) {
                passwordMatchError.style.display = 'block';
                registerButton.disabled = true;
            } else {
                passwordMatchError.style.display = 'none';
                registerButton.disabled = false;
            }
        }

        confirmPasswordInput.addEventListener('input', validatePassword);
	</script>	
<?php require_once 'include/footer.php'; ?>