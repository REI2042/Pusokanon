<?php
    include 'include/header.php';
?>
<link rel="stylesheet" href="css/rescomplaints.css">

<div class="container-fluid mb-5">
    <div class="title-container px-3">
        <h1>File a Complaint</h1>
        <hr class="bg-dark">
    </div> 
    <div class="row container pb-3">
        <div class="row align-items-start holder-title mt-3">
            <div class="col">
                <h4 class="text-center text-white"><b>Complaint Form</b></h4>
                <hr class="bg-white">
            </div>
        </div>
        <p>INFORMATION OF THE RESPONDENT <i>(ang gireklamo):</i></p> 
        <form class="row gy-2 gx-3 text-white" id="complaintForm" enctype="multipart/form-data" method="POST">
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
            <div class="w-100"></div>
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
                <label for="gender" class="form-label">Sex</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-4 mt-1 mb-4 px-1">
                <label for="age" class="form-label">Age</label>
                <input type="number" name="age" class="form-control" id="age" placeholder="Age" required>
            </div>

            <p>DETAILS OF THE REPORT:</p>
            <div class="col-md-6 mt-3 px-1">
                <label for="incident-date" class="form-label">Date of Incident <i>(pyetsa sa insidente)</i></label>
                <input type="date" name="incident-date" class="form-control" id="incident-date" required>
            </div>
            <div class="col-md-6 mt-3 px-1">
                <label for="incident-time" class="form-label">Time of Incident <i>(oras sa insidente)</i></label>
                <input type="time" name="incident-time" class="form-control" id="incident-time" required>
            </div>
            <div class="col-md-5 px-1">
                <label for="sitio" class="form-label">Place of Incident <i>(lugar nahitabo ang insidente)</i></label>
                <select class="form-select" name="addsitio" id="sitio" required>
                    <option value="Arca">Arca</option>
                    <option value="Cemento">Cemento</option>
                    <option value="Chumba-Chumba">Chumba-Chumba</option>
                    <option value="Ibabao">Ibabao</option>
                    <option value="Lawis">Lawis</option>
                    <option value="Matumbo">Matumbo</option>
                    <option value="Mustang">Mustang</option>
                    <option value="Lipata">Lipata</option>
                    <option value="San Roque">San Roque</option>
                    <option value="Seabreeze">Seabreeze</option>
                    <option value="Seaside">Seaside</option>
                    <option value="Seawage">Seawage</option>
                    <option value="Sta. Maria">Sta. Maria</option>
                </select>
            </div>
            <div class="col-md-7 px-1 case-type">
                <label for="case_type" class="form-label">Case Type <i>(Klase sa Kaso)</i></label>
                <select class="form-select" name="case_type" id="case_type" required>
                    <option value="Bullying">Bullying <i>(Pang-bully)</i></option>
                    <option value="Damaging Properties">Damaging Properties <i>(Pagdaot sa mga Kabtangan)</i></option>
                    <option value="Defamation">Defamation <i>(Pagpasipala sa dungog)</i></option>
                    <option value="Libel">Libel </option>
                    <option value="Physical Abuse">Physical Abuse <i>(Pisikal nga Abuso)</i></option>
                    <option value="Threat">Threat <i>(Pagpahadlok or Hulga)</i></option>
                    <option value="Trespassing">Trespassing <i>( Pagsulod sa Pribadong Yuta or Establishmento)</i></option>
                    <option value="Theft">Theft <i>( Pagpangawat)</i></option>
                    <option value="Vandalism">Vandalism <i>(Pagpang- vandal)</i></option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-12 px-1">
                <label for="evidence" class="form-label">Upload Image or File of Evidence</label>
                <div class="input-group">
                    <input type="file" class="form-control" name="evidence" id="evidence">
                    <button type="button" class="btn btn-danger" id="removeFile">Remove</button>
                </div>
            </div>
            <div class="col-12 px-1">
                <label for="narrative" class="form-label">Narrative <i>(Pagsaysay sa nahitabo)</i></label>
                <textarea class="form-control" rows="3" name="narrative" id="narrative" placeholder="Isugid unsa ang nahitabo..."></textarea>
            </div>
        
            <div class="text-center d-grid col-8 mx-auto mt-4">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="js/custom_caseType.js"></script>
<script>
    document.getElementById('removeFile').addEventListener('click', function() {
        document.getElementById('evidence').value = '';
    });
</script>


<?php
    include 'include/footer.php';
?>