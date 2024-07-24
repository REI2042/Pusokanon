<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    $profilePicture = 'null';
?>  
    <link rel="stylesheet" href="css/residentProfile.css" type="text/css">
    <section class="main">
        <div class="row mx-0">
            <div class="col-12">
                <div class="profile-information">
                    <a href="Manage-Users.php" class="back-button d-flex align-items-center text-white gap-2">
                        <i class="fas fa-circle-chevron-left fa-2x"></i>
                        <span>Back</span>
                    </a>
                    <div class="row mx-0">
                        <h1 class="title text-center">Resident's Profile Information</h1>
                    </div>
                    <div class="row mx-0">
                        <div class="col-12 text-center">
                            <img src="../PicturesNeeded/blank_profile.png" class="profile-picture m-1" alt="Profile Picture"/>
                            <p class="resident-id my-1"><strong>ID Number:</strong> [Placeholder]</p>
                            <p class="account-status my-1"><strong>Account Status:</strong> [Placeholder]</p>
                        </div>
                    </div>
                    <div class="row mx-0 mx-sm-3 my-3">
                        <p class="first-name col-12 col-sm-6 mb-2"><strong>First Name:</strong> [Placeholder]</p>
                        <p class="last-name col-12 col-sm-6 mb-2"><strong>Last Name:</strong> [Placeholder]</p>
                        <p class="middle-name col-12 col-sm-6 mb-2"><strong>Middle Name:</strong> [Placeholder]</p>
                        <p class="suffix col-12 col-sm-6 mb-2"><strong>Suffix:</strong> [Placeholder]</p>
                        <p class="gender col-12 col-sm-6 mb-2"><strong>Gender:</strong> [Placeholder]</p>
                        <p class="birth-date col-12 col-sm-6 mb-2"><strong>Birthdate:</strong> [Placeholder]</p>
                        <p class="age col-12 col-sm-6 mb-2"><strong>Age:</strong> [Placeholder]</p>
                        <p class="voter col-12 col-sm-6 mb-2"><strong>Registered Voter:</strong> [Placeholder]</p>
                        <p class="voter col-12 col-sm-6 mb-2"><strong>Civil Status:</strong> [Placeholder]</p>
                        <p class="voter col-12 col-sm-6 mb-2"><strong>Citizenship:</strong> [Placeholder]</p>
                        <p class="voter col-12 mb-2"><strong>Place of Birth:</strong> [Placeholder]</p>
                        <p class="voter col-12 mb-2"><strong>Contact Number:</strong> [Placeholder]</p>                                
                        <p class="voter col-12 mb-2"><strong>Email Address:</strong> [Placeholder]</p>
                        <p class="voter col-12 mb-2"><strong>Address:</strong> [Placeholder] Barangay Pusok, Lapu - Lapu City</p>
                        <div class="text-center col-12 my-3 d-flex justify-content-center">
                            <button class="btn edit-button">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include 'footerAdmin.php';?>