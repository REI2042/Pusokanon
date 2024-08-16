<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    $residentId = $_GET['id'];
    $returnUrl = isset($_GET['return_url']) ? $_GET['return_url'] : 'Manage-Users.php';
    
    $resident = fetchResidentDetails($pdo, $residentId);
    $decryptedEmail = decryptData($resident['res_email']);
    $profilePicture = $resident['profile_picture'];


    $birthdate = $resident['birth_date'];
    $birthDate = explode('-', $birthdate);
    $birthYear = $birthDate[0];
    $birthMonth = $birthDate[1];
    $birthDay = $birthDate[2];
        
?>  
    <link rel="stylesheet" href="css/Edit-Resident.css" type="text/css">
    <section class="main">
        <form class="form row " action="phpConn/update_resident_profile.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="res_ID" value="<?php echo $residentId; ?>">
            <input type="hidden" name="old_profile_picture" value="<?php echo htmlspecialchars($profilePicture); ?>">
            <input type="hidden" name="return_url" value="<?= htmlspecialchars($returnUrl) ?>">
            <div class="col-12 mt-5 mt-sm-2 d-flex justify-content-center align-items-center">
                <h1 class="title">Update Resident Profile</h1>
            </div>
            <a href="<?= htmlspecialchars(urldecode($returnUrl))?>" class="back-button d-flex align-items-center gap-2">
                <i class="fas fa-chevron-left"></i>
                <span>Back</span>
            </a>
            <div class="col-12 mt-2 d-flex justify-content-center align-items-center">
                <div class="user-profile">
                    <img src="<?php echo $profilePicture ? '../db/ProfilePictures/' . htmlspecialchars($profilePicture) : '../PicturesNeeded/blank_profile.png'; ?>" class="profile-picture" id="profile-preview" alt="Profile Picture">
                    <input type="file" id="file" name="profile_picture" accept="image/*" onchange="handleFileSelect(this);">
                    <label for="file" id="upload_button" title="Select Picture">
                        <i class="fas fa-camera" id="camera-icon"></i>
                        <i class="fa-solid fa-x" id="remove-icon" style="display: none;" title="Remove Picture"></i>
                    </label>
                </div>
            </div>
            <div class="col-12 text-center mt-2">
                <p class="resident-id my-1"><strong>ID Number:</strong> <?= htmlspecialchars($resident['res_ID']); ?> &nbsp; | &nbsp; <strong>Account Status:</strong> <?php echo $resident['account_active_status'] === 'Active' ? 'Active' : 'Deactivated'; ?></p>            </div>
            <div class="col-12 col-sm-4 px-1 mt-2">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" id="firstname" placeholder="<?= htmlspecialchars($resident['res_fname']); ?>" value="<?= htmlspecialchars($resident['res_fname']); ?>" required>
            </div>
            <div class="col-6 col-sm-3 px-1 mt-2">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" id="lastname" placeholder="<?= htmlspecialchars($resident['res_lname']); ?>" value="<?= htmlspecialchars($resident['res_lname']); ?>" required>
            </div>
            <div class="col-6 col-sm-3 px-1 mt-2">
                <label for="midname" class="form-label">Middle Name</label>
                <input type="text" name="midname" class="form-control" id="midname" placeholder="<?= htmlspecialchars($resident['res_midname']); ?>" value="<?= htmlspecialchars($resident['res_midname']); ?>">
            </div>
            <div class="col-6 col-md-2 px-1 mt-2">
                <label for="Suffix" class="form-label">Suffix</label>
                <select class="form-select" name="sufname" id="Suffix">
                    <option value=" " <?php if ($resident['res_suffix'] == ' ') echo 'selected'; ?>>N/A</option>
                    <option value="Jr" <?php if ($resident['res_suffix'] == 'Jr') echo 'selected'; ?>>Jr.</option>
                    <option value="Sr." <?php if ($resident['res_suffix'] == 'Sr.') echo 'selected'; ?>>Sr.</option>
                    <option value="I" <?php if ($resident['res_suffix'] == 'I') echo 'selected'; ?>>I</option>
                    <option value="II." <?php if ($resident['res_suffix'] == 'II.') echo 'selected'; ?>>II</option>
                    <option value="III" <?php if ($resident['res_suffix'] == 'III.') echo 'selected'; ?>>III</option>
                </select>
            </div>
            <div class="col-6 col-md-2 px-1 mt-2">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="Male" <?php if ($resident['gender'] == 'Male') echo 'selected'; ?>>Male</option>
				    <option value="Female" <?php if ($resident['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            <div class="col-3 col-md-2 px-1 mt-2">
                <label for="day" class="form-label">Birthdate</label>
                <select class="form-select" name="bday" id="day" required>
                    <?php for ($day = 1; $day <= 31; $day++): ?>
                        <option value="<?= $day ?>" <?php if ($day == $birthDay) echo 'selected'; ?>><?= $day ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-5 col-md-3 px-1 mt-2">
                <label for="birthMonth" class="form-label">&nbsp;</label>
                <select class="form-select" name="bmonth" id="birthMonth" required>
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
            <div class="col-4 col-md-2 px-1 mt-2">
                    <label for="birthYear" class="form-label">&nbsp;</label>
                    <select class="form-select" name="byear" id="birthYear" required>
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
                    <option value="Single" <?php if ($resident['civil_status'] == 'Single') echo 'selected'; ?>>Single</option>
			        <option value="Married" <?php if ($resident['civil_status'] == 'Married') echo 'selected'; ?>>Married</option>
			        <option value="Widowed" <?php if ($resident['civil_status'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                </select>
            </div>
            <div class="col-6 col-md-3 mt-2 px-1">
                <label for="citizenship" class="form-label">Citizenship</label>
                <select class="form-select" name="citizenship" id="citizenship" required>
                    <option value="Filipino" <?php if ($resident['citizenship'] == 'Filipino') echo 'selected'; ?>>Filipino</option>
                    <option value="American" <?php if ($resident['citizenship'] == 'American') echo 'selected'; ?>>American</option>
                    <option value="Chinese" <?php if ($resident['citizenship'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
                    <option value="Japanese" <?php if ($resident['citizenship'] == 'Japanese') echo 'selected'; ?>>Japanese</option>
                    <option value="Korean" <?php if ($resident['citizenship'] == 'Korean') echo 'selected'; ?>>Korean</option>
                    <option value="British" <?php if ($resident['citizenship'] == 'British') echo 'selected'; ?>>British</option>
                    <option value="Canadian" <?php if ($resident['citizenship'] == 'Canadian') echo 'selected'; ?>>Canadian</option>
                    <option value="Australian" <?php if ($resident['citizenship'] == 'Australian') echo 'selected'; ?>>Australian</option>
                    <option value="German" <?php if ($resident['citizenship'] == 'German') echo 'selected'; ?>>German</option>
                    <option value="French" <?php if ($resident['citizenship'] == 'French') echo 'selected'; ?>>French</option>
                    <option value="Other" <?php if ($resident['citizenship'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>
            <div class="col-12 col-md-3 mt-2 px-1">
                <label for="placeBirth" class="form-label">Place of birth</label>
                <input type="text" class="form-control" name="placeBirth" id="placeBirth" placeholder="<?= htmlspecialchars($resident['place_birth']); ?>" value="<?= htmlspecialchars($resident['place_birth']); ?>" required>
            </div>
            <div class="col-6 col-md-3 mt-2 px-1">
                <label for="voter" class="form-label">Registered Voter</label>
                <select class="form-select" name="voter" id="voter" required>
                    <option value="Not-registered" <?php if ($resident['registered_voter'] == 'Not-registered') echo 'selected'; ?>>Non-registered</option>
                    <option value="Registered" <?php if ($resident['registered_voter'] == 'Registered') echo 'selected'; ?>>Registered</option>
                </select>
            </div>
            <div class="col-6 col-md-3 mt-2 px-1">
                <label for="sitio" class="form-label">Sitio</label>
                <select class="form-select" name="addsitio" id="sitio" required>
                    <option value="Arca" <?php if ($resident['addr_sitio'] == 'Arca') echo 'selected'; ?>>Arca</option>
                    <option value="Cemento" <?php if ($resident['addr_sitio'] == 'Cemento') echo 'selected'; ?>>Cemento</option>
                    <option value="Chumba-Chumba" <?php if ($resident['addr_sitio'] == 'Chumba-Chumba') echo 'selected'; ?>>Chumba-Chumba</option>
                    <option value="Ibabao" <?php if ($resident['addr_sitio'] == 'Ibabao') echo 'selected'; ?>>Ibabao</option>
                    <option value="Lawis" <?php if ($resident['addr_sitio'] == 'Lawis') echo 'selected'; ?>>Lawis</option>
                    <option value="Matumbo" <?php if ($resident['addr_sitio'] == 'Matumbo') echo 'selected'; ?>>Matumbo</option>
                    <option value="Mustang" <?php if ($resident['addr_sitio'] == 'Mustang') echo 'selected'; ?>>Mustang</option>
                    <option value="New Lipata" <?php if ($resident['addr_sitio'] == 'New Lipata') echo 'selected'; ?>>New Lipata</option>
                    <option value="San Roque" <?php if ($resident['addr_sitio'] == 'San Roque') echo 'selected'; ?>>San Roque</option>
                    <option value="Seabreeze" <?php if ($resident['addr_sitio'] == 'Seabreeze') echo 'selected'; ?>>Seabreeze</option>
                    <option value="Seaside" <?php if ($resident['addr_sitio'] == 'Seaside') echo 'selected'; ?>>Seaside</option>
                    <option value="Sewage" <?php if ($resident['addr_sitio'] == 'Sewage') echo 'selected'; ?>>Sewage</option>
                    <option value="Sta. Maria" <?php if ($resident['addr_sitio'] == 'Sta. Maria') echo 'selected'; ?>>Sta. Maria</option>
                </select>	
            </div>
            <div class="col-12 col-md-6 mt-2 px-1">
                <label for="Contact" class="form-label">Contact No</label>
                <input type="text" class="form-control" name="contactNo" id="Contact" placeholder="<?= htmlspecialchars($resident['contact_no']); ?>" value="<?= htmlspecialchars($resident['contact_no']); ?>" oninput="this.value = this.value.replace(/[^0-9\s]/g, '')" required>
            </div>
            <div class="col-12 col-md-6 mt-2 px-1">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="accemail" id="email" placeholder="<?= htmlspecialchars($decryptedEmail); ?>" value="<?= htmlspecialchars($decryptedEmail); ?>" required>
            </div>
            <div class="text-center col-12 mt-3 d-flex justify-content-center">
                <button type="submit" id="updateProfileBtn" name="update_account" class="btn btn-primary">Update Profile</button>
            </div>
        </form>
    </section>
<script src="EditResidentProfile.js"></script>
<?php include 'footerAdmin.php';?>
