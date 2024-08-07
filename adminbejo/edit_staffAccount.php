<?php 
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php'; 
include '../db/DBconn.php';

$staffId = $_GET['staff_id'] ?? null;
$staff = fetchStaffInfo($pdo, $staffId);
$accountRole = accountRole($pdo);





?>

<link rel="stylesheet" href="css/staff_creation.css">
</div>
<section class="gradient-custom">
    <div class="container py-4 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-3 p-md-4">
                        <h4 class="mb-3 pb-2 pb-md-0 mb-md-4 text-center">Edit Staff Account</h4>
                        <form id="editStaffAccount" method="POST" action="phpConn/update_staff.php">
                            <?php if (!empty($staff)): ?>
                                <?php $staffMember = $staff[0]; ?>
                                <input type="hidden" name="staff_id" value="<?= htmlspecialchars($staffId); ?>">
                                <div class="row">
                                    <div class="col-md-3 mb-3 ps-3 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="firstName" name="firstName" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_fname']); ?>">
                                            <label class="form-label" for="firstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 ps-1 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="lastName" name="lastName" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_lname']); ?>">
                                            <label class="form-label" for="lastName">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 ps-1 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="middleName" name="middleName" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_midname']); ?>">
                                            <label class="form-label" for="middleName">Middle Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 ps-1">
                                        <div data-mdb-input-init class="form-outline">
                                        <select id="suffix" name="suffix" class="form-control form-control-sm">
    <option value="">Select Suffix</option>
    <option value="Jr." <?= $staffMember['staff_suffix'] == 'Jr.' ? 'selected' : '' ?>>Jr.</option>
    <option value="Sr." <?= $staffMember['staff_suffix'] == 'Sr.' ? 'selected' : '' ?>>Sr.</option>
    <option value="II" <?= $staffMember['staff_suffix'] == 'II' ? 'selected' : '' ?>>II</option>
    <option value="III" <?= $staffMember['staff_suffix'] == 'III' ? 'selected' : '' ?>>III</option>
    <option value="IV" <?= $staffMember['staff_suffix'] == 'IV' ? 'selected' : '' ?>>IV</option>
</select>
                                            <label class="form-label" for="suffix">Suffix</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 d-flex align-items-center">
                                    <div class="form-outline w-100">
                                            <input type="date" name="birthdayDate" class="form-control form-control-sm" id="birthdayDate" max="<?= date('Y-m-d'); ?>" value="<?= htmlspecialchars($staffMember['birth_date']); ?>" />
                                            <label for="birthdayDate" class="form-label">Birthday</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 ps-0">
                                        <h6 class="mb-2 pb-1 ps-1" style="font-size: 0.9rem; color: white;">Gender: </h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" <?= strtolower($staffMember['gender']) == 'female' ? 'checked' : '' ?> autocomplete="off" />
                                            <label class="form-check-label" for="femaleGender" style="font-size: 0.9rem;">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" <?= strtolower($staffMember['gender']) == 'male' ? 'checked' : '' ?> autocomplete="off" />
                                            <label class="form-check-label" for="maleGender" style="font-size: 0.9rem;">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="otherGender" value="Other" <?= strtolower($staffMember['gender']) == 'other' ? 'checked' : '' ?> autocomplete="off" />
                                            <label class="form-check-label" for="otherGender" style="font-size: 0.9rem;">Other</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3 pb-2 pe-0">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="email" name="emailAddress" id="emailAddress" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_email']); ?>">
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3 pb-2 ps-2 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['contact_no']); ?>">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3 pb-2 ps-1 pe-0">
                                        <select class="select form-control-sm" name="accountType">
                                            <option value="" disabled>Choose option</option>
                                            <?php foreach ($accountRole as $accountRoles): ?>
                                                <option value="<?= htmlspecialchars($accountRoles['userRole_id']);?>" <?= decryptData($staffMember['userRole_id']) == $accountRoles['userRole_id'] ? 'selected' : '' ?>><?= htmlspecialchars($accountRoles['role_definition']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label class="form-label select-label" style="font-size: 0.9rem;">Choose Account Type</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="username" name="username" class="form-control mt-4" id="username" placeholder="Username" autocomplete="off" value="<?= htmlspecialchars($staffMember['user_name']); ?>"/>
                                        <label class="form-label" for="username">Username</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <div class="input-group">
                                                <input type="password" id="password" name="password" class="form-control" value="<?= htmlspecialchars($staffMember['staff_password']); ?>" autocomplete="off"/>
                                                <span class="input-group-text" id="togglePassword">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <div class="input-group">
                                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" autocomplete="off">
                                                <span class="input-group-text">
                                                    <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                                                </span>
                                            </div>
                                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('confirmPassword').addEventListener('input', function() {
                                        var password = document.getElementById('password').value;
                                        var confirmPassword = this.value;

                                        if (password !== confirmPassword) {
                                            this.classList.add('is-invalid');
                                        } else {
                                            this.classList.remove('is-invalid');
                                        }
                                    });

                                    function togglePasswordVisibility(inputId, toggleId) {
                                        const input = document.getElementById(inputId);
                                        const toggle = document.getElementById(toggleId);
                                        toggle.addEventListener('click', function() {
                                            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                                            input.setAttribute('type', type);
                                            this.querySelector('i').classList.toggle('fa-eye');
                                            this.querySelector('i').classList.toggle('fa-eye-slash');
                                        });
                                    }

                                    togglePasswordVisibility('password', 'togglePassword');
                                    togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword');
                                </script>
                                <div class="mt-3 pt-2 text-center d-grid col-5 mx-auto">
                                    <input data-mdb-ripple-init class="btn btn-success btn-sm" type="submit" value="Update Account" />
                                </div>
                            <?php else: ?>
                                <p class="text-center">No staff found with the provided ID.</p>
                            <?php endif; ?>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div>

<?php include 'footerAdmin.php'; ?>
