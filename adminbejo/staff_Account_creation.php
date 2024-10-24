<?php 
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php'; 
    include '../db/DBconn.php';
    
    
    $accountRole = accountRole($pdo);
?>
<link rel="stylesheet" href="css/staff_creation.css">
</div>
<section class="gradient-custom">
    <div class="container py-4 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration">
                    <div class="card-body p-3 p-md-4 text">
                        <h4 class="mb-3 pb-2 pb-md-0 mb-md-4 text-center">Create Staff Account</h4>
                        <form id="staffAccountForm" method="POST">

                            <div class="row">
                                <div class="col-md-3 mb-3 ps-3 pe-1">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="firstName">First Name</label>
                                        <input type="text" id="firstName" name="firstName" class="form-control form-control-sm" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3 ps-1 pe-1">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="lastName">Last Name</label>
                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-sm" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3 ps-1 pe-1">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="middleName">Middle Name</label>
                                        <input type="text" id="middleName" name="middleName" class="form-control form-control-sm" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3 ps-1">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="suffix">Suffix</label>
                                        <select id="suffix" type="text" name="suffix" class="form-control form-control-sm">
                                            <option value="">Select Suffix</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 d-flex align-items-center">
                                    <div class="form-outline w-100">
                                        <label for="birthdayDate" class="form-label">Birthday</label>
                                        <input type="date" name="birthdayDate" class="form-control form-control-sm" autocomplete="off" id="birthdayDate" max="<?php echo date('Y-m-d'); ?>" />                      
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 ps-0">

                                    <h6 class="mb-2 pb-1 ps-1 form-check-inline" style="font-size: 0.9rem; font-weight: 400; ">Gender: </h6>

                                    <div class="form-check form-check-inline ">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="Male"autocomplete="off" checked />
                                        <label class="form-check-label" for="femaleGender" style="font-size: 0.9rem;">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="Female" autocomplete="off"  />
                                        <label class="form-check-label" for="maleGender" style="font-size: 0.9rem;">Female</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3 pb-2 pe-0">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="emailAddress">Email</label>
                                        <input type="email" name="emailAddress" id="emailAddress" class="form-control form-control-sm" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 pb-2 ps-2 pe-1">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <input type="tel" class="form-control" name="phoneNumber" autocomplete="off" id="phoneNumber" placeholder="09XX XXX XXXX" pattern="09[0-9]{2}\s[0-9]{3}\s[0-9]{4}" title="Please enter a valid Philippine phone number starting with 09" required oninput="this.value = this.value.replace(/[^0-9\s]/g, '')">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 pb-2 ps-1 pe-0">
                                <label class="form-label select-label" style="font-size: 0.9rem;">Choose Account Type</label>
                                    <select class="select form-control-sm" name="accountType">
                                        <option value="" disabled>Choose option</option>
                                        <?php foreach ($accountRole as $accountRoles): ?>
                                            <option value="<?= htmlspecialchars($accountRoles['userRole_id']);?>"><?= htmlspecialchars($accountRoles['role_definition']);?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="username" name="username" class="form-control mb-2" id="username" placeholder="Username" autocomplete="off"/>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" class="form-control" required autocomplete="off"/>
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                    <label class="form-label" for="confirmPassword">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required autocomplete="off">
                                            <span class="input-group-text">
                                                <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                                            </span>
                                        </div>
                                        
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
                                <input data-mdb-ripple-init class="btn btn-success btn-sm" type="submit" value="Create Account" />
                            </div>

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
   document.getElementById('staffAccountForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('phpConn/process_staff_account.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(text => {
        try {
            return JSON.parse(text);
        } catch (error) {
            throw new Error('Invalid JSON response: ' + text);
        }
    })
    .then(data => {
        if (data.error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error
            });
        } else if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.success
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred. Please try again.'
        });
    });
});
      
</script>   