<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
?>  

<link rel="stylesheet" href="css/write.css">

<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-lg-8 col-md-10">
        <h1 class="text-center">File a Complaint</h1>
        <form class="text-white" id="complaintForm" enctype="multipart/form-data" method="POST" action="../db/DBconn_adminComplaints.php">
            <div class="row mt-5">
                <div class="col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <p>RESIDENT ID OF THE COMPLAINANT:</p>
                            <div class="row gy-2 gx-3 mt-3 px-3">
                                <div class="col-md-2 px-1">
                                    <label for="res_ID" class="form-label">Resident ID</label>
                                </div>
                                <div class="col-md-10 px-1">
                                    <input type="number" name="res_ID" class="form-control" id="res_ID" placeholder="Resident ID" required>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card pb-2">
                        <div class="card-body">
                            <p>INFORMATION OF THE RESPONDENT:</p>
                            <div class="row gy-2 gx-3 mt-3 px-3">
                                <div class="col-md-4 px-1">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" name="fname" class="form-control" id="firstname" placeholder="First Name" required>
                                </div>
                                <div class="col-md-4 px-1">
                                    <label for="middlename" class="form-label">Middle Name</label>
                                    <input type="text" name="mname" class="form-control" id="middlename" placeholder="Optional">
                                </div>
                                <div class="col-md-4 px-1">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lname" class="form-control" id="lastname" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="row gy-2 gx-3 mt-1 px-3">
                                <div class="col-md-4 px-1 mt-1">
                                    <label for="suffix" class="form-label">Suffix</label>
                                    <select class="form-select" name="sufname" id="suffix">
                                        <option value=" ">N/A</option>
                                        <option value="Jr">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-1 px-1">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" id="gender" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mt-1 px-1">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" name="age" class="form-control" id="age" placeholder="Age" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card pb-3 mt-3">
                        <div class="card-body">
                            <p>DETAILS OF THE REPORT:</p>
                            <div class="row px-3">
                                <div class="col-md-3 mt-3 px-1">
                                    <label for="incident-date" class="form-label">Date</label>
                                    <input type="date" name="incident-date" class="form-control" id="incident-date" required>
                                </div>
                                <div class="col-md-3 mt-3 px-1">
                                    <label for="incident-time" class="form-label">Time</label>
                                    <input type="time" name="incident-time" class="form-control" id="incident-time" required>
                                </div>
                                <div class="col-md-3 mt-3 px-1">
                                    <label for="sitio" class="form-label">Place of Incident</label>
                                    <select class="form-select" name="addsitio" id="sitio" required>
                                        <option value="Arca">Arca</option>
                                        <option value="Cemento">Cemento</option>
                                        <option value="Chumba-Chumba">Chumba-Chumba</option>
                                        <option value="Ibabao">Ibabao</option>
                                        <option value="Lawis">Lawis</option>
                                        <option value="Matumbo">Matumbo</option>
                                        <option value="Mustang">Mustang</option>
                                        <option value="New Lipata">New Lipata</option>
                                        <option value="San Roque">San Roque</option>
                                        <option value="Seabreeze">Seabreeze</option>
                                        <option value="Seaside">Seaside</option>
                                        <option value="Sewage">Sewage</option>
                                        <option value="Sta. Maria">Sta. Maria</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3 px-1">
                                    <label for="case_type" class="form-label">Case Type</label>
                                    <select class="form-select" name="case_type" id="case_type">
                                        <option value="Bullying">Bullying</option>
                                        <option value="Damaging Properties">Damaging Properties</option>
                                        <option value="Defamation">Defamation</option>
                                        <option value="Libel">Libel</option>
                                        <option value="Physical Abuse">Physical Abuse</option>
                                        <option value="Threat">Threat</option>
                                        <option value="Trespassing">Trespassing</option>
                                        <option value="Theft">Theft</option>
                                        <option value="Vandalism">Vandalism</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row px-3">
                                <div class="col-12 px-1 mt-1">
                                    <label for="evidence" class="form-label">Upload Image or File</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="evidence" id="evidence">
                                        <button type="button" class="btn btn-danger" id="removeFile">Remove</button>
                                    </div>
                                </div>
                                <div class="col-12 px-1">
                                    <label for="narrative" class="form-label">Narrative</label>
                                    <textarea class="form-control" rows="3" name="narrative" id="narrative" placeholder="Narrate what happened..."></textarea>
                                </div>
                            
                                <div class="text-center d-grid col-8 mx-auto mt-4">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('removeFile').addEventListener('click', function() {
        document.getElementById('evidence').value = '';
    });
</script>
<script src="../js/complaints_popUp.js"></script>

<?php include 'footerAdmin.php';?>
