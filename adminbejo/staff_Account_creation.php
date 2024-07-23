<?php include 'headerAdmin.php'; ?>
<link rel="stylesheet" href="css/staff_creation.css">
</div>
<section class="gradient-custom">
    <div class="container py-4 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-3 p-md-4">
                        <h4 class="mb-3 pb-2 pb-md-0 mb-md-4 text-center">Create Staff Account</h4>
                        <form>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="firstName" class="form-control form-control-sm" />
                                        <label class="form-label" for="firstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="middleName" class="form-control form-control-sm" />
                                        <label class="form-label" for="middleName">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="lastName" class="form-control form-control-sm" />
                                        <label class="form-label" for="lastName"> Middle Name</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div data-mdb-input-init class="form-outline">
                                        <select id="suffix" class="form-control form-control-sm">
                                            <option value="">Select Suffix</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                        <label class="form-label" for="suffix">Suffix</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 d-flex align-items-center">

                                    <div data-mdb-input-init class="form-outline datepicker w-100">
                                        <input type="text" class="form-control form-control-sm" id="birthdayDate" />
                                        <label for="birthdayDate" class="form-label">Birthday</label>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3">

                                    <h6 class="mb-2 pb-1" style="font-size: 0.9rem;">Gender: </h6>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="option1" checked />
                                        <label class="form-check-label" for="femaleGender" style="font-size: 0.9rem;">Female</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="option2" />
                                        <label class="form-check-label" for="maleGender" style="font-size: 0.9rem;">Male</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender" value="option3" />
                                        <label class="form-check-label" for="otherGender" style="font-size: 0.9rem;">Other</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 pb-2">

                                    <div data-mdb-input-init class="form-outline">
                                        <input type="email" id="emailAddress" class="form-control form-control-sm" />
                                        <label class="form-label" for="emailAddress">Email</label>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3 pb-2">

                                    <div data-mdb-input-init class="form-outline">
                                        <input type="tel" id="phoneNumber" class="form-control form-control-sm" />
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">

                                    <select class="select form-control-sm">
                                        <option value="1" disabled>Choose option</option>
                                        <option value="2">Subject 1</option>
                                        <option value="3">Subject 2</option>
                                        <option value="4">Subject 3</option>
                                    </select>
                                    <label class="form-label select-label" style="font-size: 0.9rem;">Choose option</label>

                                </div>
                            </div>

                            <div class="mt-3 pt-2">
                                <input data-mdb-ripple-init class="btn btn-primary btn-sm" type="submit" value="Submit" />
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