<?php 
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php'; 
include '../db/DBconn.php';

$staffId = $_GET['staff_id'] ?? null;
$staff = fetchStaffInfo($pdo, $staffId);
$accountRole = accountRole($pdo);
?>
</div>
<link rel="stylesheet" href="css/staff_creation.css">

<section class="gradient-custom">
    <div class="container py-4 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <a href="manage_staff_account.php" class="btn btn-link"> <i class="fa-solid fa-chevron-left"></i> Back</a>
                            <h4 class="mb-0 mx-auto">Edit Staff Account</h4>
                        </div>                       
                        <form id="editStaffAccount" method="POST" action="phpConn/update_staff.php">
                            <?php if (!empty($staff)): ?>
                                <?php $staffMember = $staff[0]; ?>
                                <input type="hidden" name="staff_id" value="<?= htmlspecialchars($staffId); ?>">
                                <div class="row">
                                    <div class="col-md-3 mb-3 ps-3 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="firstName" name="firstName" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_fname']); ?>" placeholder="<?= htmlspecialchars($staffMember['staff_fname']); ?>">
                                            <label class="form-label" for="firstName">First Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 ps-1 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_lname']); ?>" placeholder="<?= htmlspecialchars($staffMember['staff_lname']); ?>">
                                            <label class="form-label" for="lastName">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 ps-1 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="middleName" name="middleName" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_midname']); ?>" placeholder="<?= htmlspecialchars($staffMember['staff_midname']); ?>">
                                            <label class="form-label" for="middleName">Middle Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3 ps-1">
                                        <div data-mdb-input-init class="form-outline">
                                        <select id="suffix" name="suffix" placeholder="<?= htmlspecialchars($staffMember['staff_suffix']); ?>" class="form-control form-control-sm">
                                            <option value="">N/A</option>
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
                                    <div class="form-outline w-100 ">
                                            <input type="date" name="birthdayDate" class="form-control form-control-sm" id="birthdayDate" max="<?= date('Y-m-d'); ?>" value="<?= htmlspecialchars($staffMember['birth_date']) ;?>" />
                                            <label for="birthdayDate" class="form-label">Birthday</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 ps-0">
                                        <h6 class="mb-2 pb-1 ps-1 form-check-inline" style="font-size: 0.9rem; font-weight:500">Gender: </h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Female" <?= strtolower($staffMember['gender']) == 'female' ? 'checked' : '' ?> autocomplete="off" />
                                            <label class="form-check-label" for="femaleGender" style="font-size: 0.9rem;">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Male" <?= strtolower($staffMember['gender']) == 'male' ? 'checked' : '' ?> autocomplete="off" />
                                            <label class="form-check-label" for="maleGender" style="font-size: 0.9rem;">Male</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3 pb-2 pe-0">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="email" name="emailAddress" id="emailAddress" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['staff_email']); ?>" placeholder="<?= htmlspecialchars($staffMember['staff_email']);?>" >
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3 pb-2 ps-2 pe-1">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="phoneNumber" name="phoneNumber" class="form-control form-control-sm" autocomplete="off" value="<?= htmlspecialchars($staffMember['contact_no']); ?>">
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
                                <div class="row mt-4 mb-5">
                                    <div class="col-8">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="username" name="username" class="form-control" id="username" autocomplete="off" value="<?= htmlspecialchars($staffMember['user_name']); ?>" placeholder="<?= htmlspecialchars($staffMember['user_name']); ?>"/>
                                    </div>
                                    <div class="col-4 mt-4 pt-3 ">
                                        <a href="#" onclick="changepass('<?= htmlspecialchars($staffMember['staff_password']);?>')">Change Password</a>
                                    </div>
                                </div>
                                
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
<script>
    function changepass(staff_password) {
    Swal.fire({
        title: 'Change Password',
        html: `
            <div class="form-group">
                <label for="password">New Password</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" placeholder="Enter new password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <div class="input-group">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm new password">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Change Password',
        confirmButtonColor: '#3085d6',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                Swal.showValidationMessage('Passwords do not match');
                return false;
            }

            return { password };
        },
        didOpen: () => {
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            toggleConfirmPassword.addEventListener('click', function () {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const password = result.value.password;
            fetch('phpConn/update_staff_password.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    password: password,
                    staff_id: '<?= htmlspecialchars($staffId); ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Changed',
                        text: 'Password changed successfully.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error || 'Failed to change password. Please try again.',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again later.',
                });
            });
        }
    });
}

</script>

