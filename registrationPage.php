<?php
	include 'navbar.php';
	include("database/databaseConnect.php");
	if($_SERVER['REQUEST_METHOD'] == "POST") {
        $first_Name = $_POST['fname'];
        $last_Name = $_POST['lname'];
        $middle_Name = $_POST['mname'];
        $suffix_Name = $_POST['sufname'];
        $birth_Day = $_POST['bday'];
        $birth_Month = $_POST['bmonth'];
        $birth_Year = $_POST['byear'];
        $civil_Status = $_POST['civilStatus'];
        $acc_Citizenship = $_POST['citizenship'];
        $acc_Gender = $_POST['gender'];
        $place_Birth = $_POST['placeBirth'];
        $contact_No = $_POST['contactNo'];
        $address_Sitio = $_POST['addsitio'];
        $add_Purok = $_POST['addpurok'];
        $account_Email = $_POST['accemail'];
        $account_Password = $_POST['accpassword'];

        $request = mysqli_query($connect_db, "SELECT * FROM reg_table WHERE (firstName = '$first_Name' AND lastName = '$last_Name' AND midName = '$middle_Name' AND suffix = '$suffix_Name') OR user_email = '$account_Email'");
        $found = mysqli_num_rows($request);

        if($found < 1) {
        	echo "<script>alert('account has been created');</script>";
        }else{
        	header("Location: verifyUploadPage.php");
            exit();
        }
   	}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pusokanon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesRegistration.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
 
</head>
<body>
    <main>
    	<section class="holder-section" autocomplete="off">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-#48BF91 text-white">
                        <h4 align="center">Register</h4>
                        <hr>
                    </div>

                    <div class="card-body">
                        <form id="registrationForm" action="verifyUploadPage.php" method="POST">
                            <div class="row mb-2">
                                <div class="col-md-4 col-sm-6 px-1">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="firstname" placeholder="First name" required>
                                </div>
                                <div class="col-md-4 col-sm-6 px-1">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lastname" placeholder="Last name" required>
                                </div>
                                <div class="col-md-4 col-sm-6 px-1">
                                    <label for="midname" class="form-label">Middle Name</label>
                                    <input type="text" name="mname" class="form-control" id="midname" placeholder="Middle name" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-6 px-1">
                                    <label for="Suffix" class="form-label">Suffix</label>
                                    <select class="form-select" name="sufname" id="Suffix" required>
                                        <option value="N/A">N/A</option>
                                        <option value="Jr">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II.">II</option>
                                        <option value="III">III</option>
                                    </select>
                                </div>
                                <div class="col-md-9 col-sm-6 ">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4 px-1">
                                            <label for="quantity" class="form-label">Birthdate</label>
                                            <input class="form-control" type="number" id="quantity" name="bday" min="1" max="31" placeholder="Day">
                                        </div>
                                        <div class="col-md-5 col-sm-4 px-1">
                                            <label for="birthMonth" class="form-label d-none d-sm-block">&nbsp;</label>
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
                                        <div class="col-md-4 col-sm-4 px-1">
                                            <label for="birthYear" class="form-label d-none d-sm-block">&nbsp;</label>
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
                                </div>
                            </div>
                            <div class="row mb-2">
						        <div class="col-md-auto col-sm-6 px-1">
						            <label for="status" class="form-label">Civil Status</label>
						            <select class="form-select" name="civilStatus" id="status" required>
						                <option value="Single">Single</option>
						                <option value="Married">Married</option>
						                <option value="Widowed">Widowed</option>
						            </select>
						        </div>
						        <div class="col-md-auto ">
						            <div class="row">
						                <div class="col-md-auto px-1 ">
						                    <label for="citizenship" class="form-label">Citizenship</label>
						                    <input class="form-control" type="text" id="citizenship" name="citizenship" placeholder="Enter Citizenship">
						                </div>
						                <div class="col-md-auto col-sm-4 px-1 ">
						                    <label for="gender" class="form-label">Gender</label>
						                    <select class="form-select" name="gender" id="gender" required>
						                        <option value="Male">Male</option>
						                        <option value="Female">Female</option>
						                    </select>
						                </div>
						            </div>
						        </div>
						    </div>
						    <div class="row mb-2">
						        <div class="col px-1">
						            <label for="placeBirth" class="form-label">Place of birth</label>
						            <input type="text" class="form-control" name="placeBirth" id="placeBirth" placeholder="Place of Birth" required>
						        </div>
						        <div class="col px-1">
						            <label for="Contact" class="form-label">Contact No</label>
						            <input type="text" class="form-control" name="contactNo" id="Contact" placeholder="Contact" required>
						        </div>
						    </div>
                            
							<div class="row mb-2">
						        <div class="col ">
						            <small class="text-success">--Current Location in Pusok--</small>
						        </div>
						    </div>
                            <div class="container">
							    <div class="row mb-1">
							        <div class="col-md-auto col-sm-auto px-1">
							            <div class="row">
							                <div class="col-md-auto col-sm-6 px-1">
							                    <label for="sitio" class="form-label">Sitio</label>
							                    <input type="text" class="form-control" name="addsitio" id="sitio" placeholder="Sitio" required>
							                </div>
							                <div class="col-md-auto col-sm-6 px-1">
							                    <label for="purok" class="form-label">Purok</label>
							                    <input type="text" class="form-control" name="addpurok" id="purok" placeholder="Purok">
							                </div>
							            </div>
							        </div>
							    </div>
							</div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="accemail" id="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="accpassword" id="password" placeholder="Enter your password" required>
                            </div>
                            <div class="mb-3">
							    <label for="confirmPassword" class="form-label">Confirm Password</label>
							    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
							    <div id="passwordMatchError" style="color: red; display: none;">Passwords do not match</div>
							</div>
							<div class="text-center">
							  	<input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate" required>
							  	<label class="form-label" for="flexCheckIndeterminate">
							    I agree to <a href="#" class="link-warning">Terms & Conditions </a>
							  	</label>
							</div>
                            <div class="text-center d-grid col-8 mx-auto">
                                <button type="submit" name="save_account" class="btn btn-success">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
 	<footer class="footer mt-5">
        <div class="footerContainer">
            <p>&copy; 2024 Barangay Pusok, Lapu-Lapu City. All rights reserved. </p>  
        </div>
    </footer>
    <?php
        // Check if alert parameter exists and display the alert message accordingly
        if(isset($_GET['alert'])) {
            $alert = $_GET['alert'];
            if($alert === 'already_registered') {
                echo "<script>alert('You are already Registered!');</script>";
            }
        }
    ?>
            <!--- password check if same -->
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
</body>
</html>