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
            <div class="row align-items-start holder-title mt-3 ">
                <div class="col">
                    <h4 class=" text-center text-white"><b>Complaint Form</b></h4><hr class="bg-white">
                </div>
            </div>
            <p>INFORMATION OF THE RESPONDENT:</p>
            <form class="row gy-2 gx-3 text-white" action="db/DBconn_complaints.php" method="POST" enctype="multipart/form-data">
                    <div class="col px-1">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" name="fname" class="form-control" id="firstname" placeholder="First Name" required>
                    </div>
                    <div class="col-md px-1 ">
                        <label for="lastname" class="form-label">Middle Name</label>
                        <input type="text" name="mname" class="form-control" id="lastname" placeholder="Optional" required>
                    </div>
                    <div class="col px-1">
                        <label for="midname" class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" id="midname" placeholder="Last Name">
                    </div>
                    <div class="w-100"></div>
                    <div class="col-4 px-1 mt-1">
                                <label for="Suffix" class="form-label">Suffix</label>
                                <select class="form-select" name="sufname" id="Suffix">
                                    <option value=" ">N/A</option>
                                    <option value="Jr">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="I">I</option>
                                    <option value="II.">II</option>
                                    <option value="III">III</option>
                                </select>
                            </div>
                    <div class="col-4 mt-1 px-1 ">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-4 mt-1 mb-2 px-1">
                            <label for="quantity" class="form-label">Age</label>
                            <input class="form-control" type="integer" id="age" placeholder="Age" required>
                    </div>

                    <p>DETAILS OF THE REPORT:</p>
                    <div class="col-6 mt-3 px-1">
                        <label for="incident-date" class="form-label">Date</label>
                        <input type="date" class="form-select" name="incident-date" id="incident-date" required>
                    </div>
                    <div class="col-6 mt-3 px-1 ">
                        <label for="incident-time" class="form-label">Time</label>
                        <input type="time" class="form-select" name="incident-time" id="incident-time" required>
                    </div>
                    <div class="col-5 px-1">
                        <label for="sitio" class="form-label">Place of incident</label>
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
                    <div class="col-7 px-1">
                    <label for="case_type" class="form-label">Case Type</label>
                        <select class="form-select" name="case_type" id="case_type" required>
                            <option value="Bullying">Bullying</option>
                            <option value="Damaging Properties">Damaging Properties</option>
                            <option value="Physical Abuse">Physical Abuse</option>
                            <option value="Threat">Threat</option>
                            <option value="Trespassing">Trespassing</option>
                            <option value="Thief">Thief</option>
                        </select>
                    </div>  
                    <div class="col-12 px-1">
                        <label for="narrative" class="form-label">Narrative</label>
                        <textarea class="form-control" rows="3" name="narrative" id="narrative" placeholder="Narrate what happened..." optional></textarea>
                    </div>
                    
                    <div class="text-center d-grid col-8 mx-auto">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
            </form>
        </div>
	</div>

    

<?php
    include 'include/footer.php';
?>
