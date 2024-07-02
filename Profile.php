<?php
    include 'include/header.php';
    include 'db/DBconn.php';
    
    $suffix = isset($_SESSION['res_suffix']) ? $_SESSION['res_suffix'] : '';
    $fullName = trim($_SESSION['res_fname'] . ' ' . $_SESSION['res_midname'] . ' ' . $_SESSION['res_lname'] . ' ' . $suffix);

    $birthdateStr = $_SESSION['birth_date'];
    $birthdate = DateTime::createFromFormat('Y-m-d', $birthdateStr);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;
    
    // $userId = $_SESSION['res_ID'];
    // $requests = fetchResdocsRequest($pdo, $userId);

    $birthdate = $_SESSION['birth_date'];
    $date = DateTime::createFromFormat('Y-m-d', $birthdate);
    $formattedBirthdate = $date->format('F j, Y');
    
?>
<link rel="stylesheet" href="css/Profile.css">
<section class="main">
    <div class="row">
        <div class="col-12 col-sm-5 p-3">
            <div class="profile-box">
                <div class="row p-3 m-0">
                    <div class="profile-information my-3">
                        <img src="PicturesNeeded/profile-pic.jpg"  class="profile-picture" alt="Profile Picture"/>
                        <div class="">
                            <p class="name"><?= htmlspecialchars($fullName); ?></p>
                            <p class="gender"><?= htmlspecialchars($_SESSION['gender']); ?></p>
                            <p class="age"><?= htmlspecialchars($age); ?></p>
                            <p class="voter"><?= htmlspecialchars($_SESSION['registered_voter']); ?> Voter</p>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 px-4">
                    <div class="additional-information">
                        <p>Birthday: <?= htmlspecialchars($formattedBirthdate); ?></p>
                        <p>Contact Number: <?= htmlspecialchars($_SESSION['contact_no']); ?></p>
                        <p>Civil Status: <?= htmlspecialchars($_SESSION['civil_status']); ?></p>
                        <p>Citizenship: <?= htmlspecialchars($_SESSION['citizenship']); ?></p>
                        <p>Place of Birth: <?= htmlspecialchars($_SESSION['place_birth']); ?></p>
                        <p>Address: <?= htmlspecialchars($_SESSION['addr_sitio']); ?> Barangay Pusok, Lapu - Lapu City</span></p>
                        <p>Email Address: <?= htmlspecialchars($_SESSION['res_email']); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="buttons text-center my-3">
                        <button class="change-button">Change Password</button>
                        <button class="edit-button">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 p-3">
            <div class="request-box">
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
                <p>Placeholder</p>
            </div>
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>