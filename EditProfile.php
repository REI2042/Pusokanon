<?php
    include 'include/header.php';
    include 'db/DBconn.php';

	$birthDate = explode('-', $_SESSION['birth_date']);
    $birthYear = $birthDate[0];
    $birthMonth = $birthDate[1];
    $birthDay = $birthDate[2];
?>
<link rel="stylesheet" type="text/css" href="css/EditProfile.css">
<div class="container fluid d-flex justify-content-center">
<section class="main">
	<form class="form row text-white" action="db/update_profile.php" method="POST" enctype="multipart/form-data">
		<a href="Profile.php" class="back-button d-flex align-items-center text-white gap-2">
			<i class="fas fa-circle-chevron-left fa-2x"></i>
			<span>Back</span>
		</a>
		<div class="col-12 mt-2 d-flex justify-content-center align-items-center">
			<div class="user-profile">
				<img src="<?php echo $profilePicture ? 'db/ProfilePictures/' . htmlspecialchars($profilePicture) : 'PicturesNeeded/blank_profile.png'; ?>" class="profile-picture" id="profile-preview" alt="Profile Picture">
				<input type="file" id="file" name="profile_picture" accept="image/*" onchange="previewImage(this);">
				<label for="file" id="upload_button"><i class="fas fa-camera"></i></label>
			</div>
		</div>
		<div class="col-12 col-sm-6 px-1 mt-2">
			<label for="firstname" class="form-label">First Name</label>
			<input type="text" name="fname" class="form-control" id="firstname" placeholder="<?= htmlspecialchars($_SESSION['res_fname']); ?>" value="<?= htmlspecialchars($_SESSION['res_fname']); ?>" required>
		</div>
		<div class="col-6 col-sm-6 px-1 mt-2">
			<label for="lastname" class="form-label">Last Name</label>
			<input type="text" name="lname" class="form-control" id="lastname" placeholder="<?= htmlspecialchars($_SESSION['res_lname']); ?>" value="<?= htmlspecialchars($_SESSION['res_lname']); ?>" required>
		</div>
		<div class="col-6 col-sm-6 px-1 mt-2">
            <label for="midname" class="form-label">Middle Name</label>
            <input type="text" name="midname" class="form-control" id="midname" placeholder="<?= htmlspecialchars($_SESSION['res_midname']); ?>" value="<?= htmlspecialchars($_SESSION['res_midname']); ?>">
        </div>
		<div class="col-6 col-md-3 px-1 mt-2">
			<label for="Suffix" class="form-label">Suffix</label>
            <select class="form-select" name="sufname" id="Suffix">
                <option value=" " <?php if ($_SESSION['res_suffix'] == ' ') echo 'selected'; ?>>N/A</option>
                <option value="Jr" <?php if ($_SESSION['res_suffix'] == 'Jr') echo 'selected'; ?>>Jr.</option>
                <option value="Sr." <?php if ($_SESSION['res_suffix'] == 'Sr.') echo 'selected'; ?>>Sr.</option>
                <option value="I" <?php if ($_SESSION['res_suffix'] == 'I') echo 'selected'; ?>>I</option>
                <option value="II." <?php if ($_SESSION['res_suffix'] == 'II.') echo 'selected'; ?>>II</option>
                <option value="III" <?php if ($_SESSION['res_suffix'] == 'III.') echo 'selected'; ?>>III</option>
            </select>
        </div>
		<div class="col-6 col-md-3 px-1 mt-2">
			<label for="gender" class="form-label">Gender</label>
			<select class="form-select" name="gender" id="gender" required>
				<option value="Male" <?php if ($_SESSION['gender'] == 'Male') echo 'selected'; ?>>Male</option>
				<option value="Female" <?php if ($_SESSION['gender'] == 'Female') echo 'selected'; ?>>Female</option>
			</select>
		</div>
		<div class="col-3 col-md-3 px-1 mt-2">
	        <label for="day" class="form-label">Birthdate</label>
	    	<select class="form-select" name="bday" id="day" required>
	            <option value="">Day</option>
	            <?php for ($day = 1; $day <= 31; $day++): ?>
	                <option value="<?= $day ?>" <?php if ($day == $birthDay) echo 'selected'; ?>><?= $day ?></option>
	            <?php endfor; ?>
	        </select>
	    </div>
		<div class="col-5 col-md-3 px-1 mt-2">
	        <label for="birthMonth" class="form-label">&nbsp;</label>
			<select class="form-select" name="bmonth" id="birthMonth" required>
	            <option value="">Month</option>
	            <option value="01" <?php if ($birthMonth == '01') echo 'selected'; ?>>January</option>
	            <option value="02" <?php if ($birthMonth == '02') echo 'selected'; ?>>February</option>
			    <option value="03" <?php if ($birthMonth == '03') echo 'selected'; ?>>March</option>
			    <option value="04" <?php if ($birthMonth == '04') echo 'selected'; ?>>April</option>
			    <option value="05" <?php if ($birthMonth == '05') echo 'selected'; ?>>May</option>
			    <option value="06" <?php if ($birthMonth == '06') echo 'selected'; ?>>June</option>
			    <option value="07" <?php if ($birthMonth == '07') echo 'selected'; ?>>July</option>
			    <option value="08" <?php if ($birthMonth == '08') echo 'selected'; ?>>August</option>
			    <option value="09" <?php if ($birthMonth == '09') echo 'selected'; ?>>September</option>
			    <option value="10" <?php if ($birthMonth == '10') echo 'selected'; ?>>October</option>
			    <option value="11" <?php if ($birthMonth == '11') echo 'selected'; ?>>November</option>
			    <option value="12" <?php if ($birthMonth == '12') echo 'selected'; ?>>December</option>
			</select>
		</div>
		<div class="col-4 col-md-3 px-1 mt-2">
	            <label for="birthYear" class="form-label">&nbsp;</label>
	            <select class="form-select" name="byear" id="birthYear" required>
	                <option value="">Year</option>
	                <?php
	                    $currentYear = date('Y');
	                    $startYear = $currentYear - 100;
	                    for ($year = $currentYear; $year >= $startYear; $year--): ?>
	                        <option value="<?= $year ?>" <?php if ($year == $birthYear) echo 'selected'; ?>><?= $year ?></option>
	                <?php endfor; ?>
	            </select>
		</div>
		<div class="col-6 col-md-3 mt-2 px-1">
			<label for="status" class="form-label">Civil Status</label>
			<select class="form-select" name="civilStatus" id="status" required>
			    <option value="Single" <?php if ($_SESSION['civil_status'] == 'Single') echo 'selected'; ?>>Single</option>
			    <option value="Married" <?php if ($_SESSION['civil_status'] == 'Married') echo 'selected'; ?>>Married</option>
			    <option value="Widowed" <?php if ($_SESSION['civil_status'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
			</select>
		</div>
		<div class="col-6 col-md-3 mt-2 px-1">
		   	<label for="citizenship" class="form-label">Citizenship</label>
		   	<input class="form-control" type="text" id="citizenship" name="citizenship" placeholder="<?= htmlspecialchars($_SESSION['citizenship']); ?>" value="<?= htmlspecialchars($_SESSION['citizenship']); ?>" required>
		</div>
		<div class="col-12 col-md-3 mt-2 px-1">
			<label for="placeBirth" class="form-label">Place of birth</label>
			<input type="text" class="form-control" name="placeBirth" id="placeBirth" placeholder="<?= htmlspecialchars($_SESSION['place_birth']); ?>" value="<?= htmlspecialchars($_SESSION['place_birth']); ?>" required>
		</div>
		<div class="col-6 col-md-3 mt-2 px-1">
			<label for="voter" class="form-label">Registered Voter</label>
			<select class="form-select" name="voter" id="voter" required>
						<option value="Not-registered" <?php if ($_SESSION['registered_voter'] == 'Not-registered') echo 'selected'; ?>>Non-registered</option>
						<option value="Registered" <?php if ($_SESSION['registered_voter'] == 'Registered') echo 'selected'; ?>>Registered</option>
			 </select>
		</div>
		<div class="col-6 col-md-3 mt-2 px-1">
			<label for="sitio" class="form-label">Your Sitio</label>
			<select class="form-select" name="addsitio" id="sitio" required>
				<option value="Arca" <?php if ($_SESSION['addr_sitio'] == 'Arca') echo 'selected'; ?>>Arca</option>
				<option value="Cemento" <?php if ($_SESSION['addr_sitio'] == 'Cemento') echo 'selected'; ?>>Cemento</option>
				<option value="Chumba-Chumba" <?php if ($_SESSION['addr_sitio'] == 'Chumba-Chumba') echo 'selected'; ?>>Chumba-Chumba</option>
				<option value="Ibabao" <?php if ($_SESSION['addr_sitio'] == 'Ibabao') echo 'selected'; ?>>Ibabao</option>
				<option value="Lawis" <?php if ($_SESSION['addr_sitio'] == 'Lawis') echo 'selected'; ?>>Lawis</option>
				<option value="Matumbo" <?php if ($_SESSION['addr_sitio'] == 'Matumbo') echo 'selected'; ?>>Matumbo</option>
				<option value="Mustang" <?php if ($_SESSION['addr_sitio'] == 'Mustang') echo 'selected'; ?>>Mustang</option>
				<option value="New Lipata" <?php if ($_SESSION['addr_sitio'] == 'New Lipata') echo 'selected'; ?>>New Lipata</option>
				<option value="San Roque" <?php if ($_SESSION['addr_sitio'] == 'San Roque') echo 'selected'; ?>>San Roque</option>
				<option value="Seabreeze" <?php if ($_SESSION['addr_sitio'] == 'Seabreeze') echo 'selected'; ?>>Seabreeze</option>
				<option value="Seaside" <?php if ($_SESSION['addr_sitio'] == 'Seaside') echo 'selected'; ?>>Seaside</option>
				<option value="Sewage" <?php if ($_SESSION['addr_sitio'] == 'Sewage') echo 'selected'; ?>>Sewage</option>
				<option value="Sta. Maria" <?php if ($_SESSION['addr_sitio'] == 'Sta. Maria') echo 'selected'; ?>>Sta. Maria</option>
            </select>	
		</div>
		<div class="col-12 col-md-6 mt-2 px-1">
			<label for="Contact" class="form-label">Contact No</label>
			<input type="text" class="form-control" name="contactNo" id="Contact" placeholder="<?= htmlspecialchars($_SESSION['contact_no']); ?>" value="<?= htmlspecialchars($_SESSION['contact_no']); ?>" required>
		</div>
		<div class="col-12 col-md-6 mt-2 px-1">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="accemail" id="email" placeholder="<?= htmlspecialchars($_SESSION['res_email']); ?>" value="<?= htmlspecialchars($_SESSION['res_email']); ?>" required>
        </div>
		<div class="text-center col-12 mt-3 d-flex justify-content-center">
            <button type="submit" id="updateProfileBtn" name="update_account" class="btn btn-primary">Update Profile</button>
        </div>
	</form>
</section>
</div>
<script src="js/UpdateProfile.js"></script>
<?php include'include/footer.php'?>