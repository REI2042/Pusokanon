<?php
    include 'include/header.php';
    include 'db/DBconn.php';
    
    $suffix = isset($_SESSION['res_suffix']) ? $_SESSION['res_suffix'] : '';
    $fullName = trim($_SESSION['res_fname'] . ' ' . $_SESSION['res_midname'] . ' ' . $_SESSION['res_lname'] . ' ' . $suffix);
    
    // $userId = $_SESSION['res_ID'];
    // $requests = fetchResdocsRequest($pdo, $userId);
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
                            <p class="gender">Male</p>
                            <p class="age">20</p>
                            <p class="voter">Registered Voter</p>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 px-4">
                    <div class="additional-information">
                        <p>Birthday: <span>April 14, 2003</span></p>
                        <p>Contact Number: <span>0912 345 6789</span></p>
                        <p>Civil Status: <span>Married</span></p>
                        <p>Citizenship: <span>Filipino</span></p>
                        <p>Place of Birth: <span>Cebu</span></p>
                        <p>Address: <span>Sewage Barangay Pusok, Lapu - Lapu City</span></p>
                        <p>Email Address: <span>juan.delacruz@gmail.com</span></p>
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