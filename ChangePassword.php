<?php
    include 'include/header.php';
    include 'db/DBconn.php';
    
?>
<link rel="stylesheet" href="css/ChangePassword.css">
<section class="main d-flex justify-content-center">
    <div class="form-container">
        <form class="change-pass" action="#" method="POST" autocomplete="off">
            <a href="Profile.php" class="back-button d-flex align-items-center text-white gap-2">
                <i class="fas fa-circle-chevron-left fa-2x"></i>
                <span>Back</span>
            </a>
            <div class="row mb-3">
                <div class="col-12 text-light mt-3">
                    <h3 class="text-center">Change Password</h3>
                    <hr>
                </div>
                <div class="col-12 mb-3">
                    <label for="currentpassword" class="form-label text-light">Current Password:</label>
                    <div class="d-flex align-items-center">
                        <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="Current password" required>
                        <i class="fa-solid fa-eye-slash text-secondary" id="eyeicon"></i>
                    </div>
                    <div id="current-password-error" class="text-danger mt-2" style="display: none;">Current Password is Incorrect</div>
                </div>
                <div class="col-12 mb-3">
                    <label for="newpassword" class="form-label text-light">New Password:</label>
                    <div class="d-flex align-items-center">
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New password" required>
                        <i class="fa-solid fa-eye-slash text-secondary" id="eyeicon"></i>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <label for="repeatpassword" class="form-label text-light">Confirm Password:</label>
                    <div class="d-flex align-items-center">
                        <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Re-type new password" required>
                        <i class="fa-solid fa-eye-slash text-secondary" id="eyeicon"></i>
                    </div>
                    <div id="password-error" class="text-danger mt-2" style="display: none;">New Password do not match. Please enter again.</div>
                </div>
                <div class="col-12 my-1 text-center">
                    <button type="submit" class="submit btn text-light" id="submit" style="background: #005BB5">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="js/ChangePassword.js"></script>
<?php include 'include/footer.php'; ?>