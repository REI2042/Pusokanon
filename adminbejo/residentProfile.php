<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    $residentId = $_GET['id'];
    
    $resident = fetchResidentDetails($pdo, $residentId);
    $decryptedEmail = decryptData($resident['res_email']);
    $birthdate = new DateTime($resident['birth_date']);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;
    $profilePicture = $resident['profile_picture'];
    $formattedBirthdate = $birthdate->format('F j, Y');
    $suffix = $resident['res_suffix'] !== ' ' ? htmlspecialchars($resident['res_suffix']) : 'N/A';
    $registeredVoter = $resident['registered_voter'] === 'Registered' ? 'Yes' : 'No';
        
?>  
    <link rel="stylesheet" href="css/residentProfile.css" type="text/css">
    <section class="main">
        <div class="row mx-0">
            <div class="col-12">
                <div class="profile-information">
                    <a href="javascript:history.back()" class="back-button d-flex align-items-center text-white gap-2">
                        <i class="fas fa-circle-chevron-left fa-2x"></i>
                        <span>Back</span>
                    </a>
                    <div class="row mx-0">
                        <h1 class="title text-center">Resident's Profile Information</h1>
                    </div>
                    <div class="row mx-0">
                        <div class="col-12 text-center">
                            <img src="<?php echo $profilePicture ? '../db/ProfilePictures/' . htmlspecialchars($profilePicture) : '../PicturesNeeded/blank_profile.png'; ?>" class="profile-picture m-1" alt="Profile Picture"/>
                            <p class="resident-id my-1"><strong>ID Number:</strong> <?php echo htmlspecialchars($resident['res_ID']); ?></p>
                            <p class="account-status my-1"><strong>Account Status:</strong> <?php echo $resident['is_active'] ? 'Active' : 'Deactivated'; ?></p>
                        </div>
                    </div>
                    <div class="row mx-0 mx-sm-3 my-3">
                        <p class="first-name col-12 col-sm-6 mb-2"><strong>First Name:</strong> <?php echo htmlspecialchars($resident['res_fname']); ?></p>
                        <p class="last-name col-12 col-sm-6 mb-2"><strong>Last Name:</strong> <?php echo htmlspecialchars($resident['res_lname']); ?></p>
                        <p class="middle-name col-12 col-sm-6 mb-2"><strong>Middle Name:</strong> <?php echo htmlspecialchars($resident['res_midname']); ?></p>
                        <p class="suffix col-12 col-sm-6 mb-2"><strong>Suffix:</strong> <?php echo htmlspecialchars($suffix); ?></p>
                        <p class="gender col-12 col-sm-6 mb-2"><strong>Gender:</strong> <?php echo htmlspecialchars($resident['gender']); ?></p>
                        <p class="birth-date col-12 col-sm-6 mb-2"><strong>Birthdate:</strong> <?php echo htmlspecialchars($formattedBirthdate); ?></p>
                        <p class="age col-12 col-sm-6 mb-2"><strong>Age:</strong> <?php echo $age; ?></p>
                        <p class="voter col-12 col-sm-6 mb-2"><strong>Registered Voter:</strong> <?php echo htmlspecialchars($registeredVoter); ?></p>
                        <p class="voter col-12 col-sm-6 mb-2"><strong>Civil Status:</strong> <?php echo htmlspecialchars($resident['civil_status']); ?></p>
                        <p class="voter col-12 col-sm-6 mb-2"><strong>Citizenship:</strong> <?php echo htmlspecialchars($resident['citizenship']); ?></p>
                        <p class="voter col-12 mb-2"><strong>Place of Birth:</strong> <?php echo htmlspecialchars($resident['place_birth']); ?></p>
                        <p class="voter col-12 mb-2"><strong>Contact Number:</strong> <?php echo htmlspecialchars($resident['contact_no']); ?></p>                                
                        <p class="voter col-12 mb-2"><strong>Email Address:</strong> <?php echo htmlspecialchars($decryptedEmail); ?></p>
                        <p class="voter col-12 mb-2"><strong>Address:</strong> <?php echo htmlspecialchars($resident['addr_sitio'] . ', ' . $resident['addr_purok']); ?> Barangay Pusok, Lapu - Lapu City</p>
                        <div class="text-center col-12 my-3 d-flex justify-content-center">
                            <button class="btn edit-button" data-res-id="<?php echo htmlspecialchars($resident['res_ID']); ?>">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include 'footerAdmin.php';?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const resId = this.getAttribute('data-res-id');
                window.location.href = `EditResidentProfile.php?id=${resId}`;
            });
        });
    });
</script>