<?php
    include 'include/header.php';
    include 'db/DBconn.php';
?>
<link rel="stylesheet" type="text/css" href="#">
	
	<div>
		<form class="row gy-2 gx-3 text-white" action="#" method="POST" enctype="multipart/form-data">
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
            	<input type="text" name="mname" class="form-control" id="midname" placeholder="Middle name" required>
	        </div>
	        <div class="w-100"></div>
	        <div class="col-6 px-1 mt-2">
                <label for="Suffix" class="form-label">Suffix</label>
                <select class="form-select" name="sufname" id="Suffix" required>
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
									<option value="01">January</option>
									<option value="">Month</option>
									<option value="03">March</option>
									<option value="02">February</option>
									<option value="05">May</option>
									<option value="04">April</option>
									<option value="07">July</option>
									<option value="06">June</option>
									<option value="09">September</option>
									<option value="08">August</option>
									<option value="11">November</option>
									<option value="10">October</option>
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
							<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
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




<?php include'include/footer.php'?>