<?php include 'navbar.php'; ?>

<link rel="stylesheet" type="text/css" href="../css/rescomplaints.css">


<div class="container-fluid">
	<div class="title-container pl-5">
		<h1>Write Complaints</h1>
	</div> 
    <div class="main-container mr-5">
        <div class="row justify-content-center"> <!-- Center content horizontally -->
            <div class="col-lg-8"> <!-- Use grid classes for responsiveness -->
                <div class="card mt-4">
                    <div class="card-body card1">
                        <h5 class="card-title">Respondent</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" placeholder="Enter First Name" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="Suffix" class="form-label">Suffix</label>
                                    <select class="form-select" name="sufname" id="Suffix">
                                        <option value="N/A">N/A</option>
                                        <option value="Jr">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II.">II</option>
                                        <option value="III">III</option>
                                    </select>
                                </div>
                                <div class="col-8">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Enter address">
                                </div>
                                <div class="col-md-4">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" placeholder="Enter Age">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-4"> <!-- Use grid classes for responsiveness -->
                <div class="card">
                    <div class="card-body card1">
                        <h5 class="card-title">Details about the Report</h5>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" placeholder="Enter Date of Incident" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="time" class="form-label">Time</label>
                                    <input type="time" class="form-control" id="time" placeholder="Enter Time of Incident" required>
                                </div>
                                <div class="col-md-8">
                                    <label for="place" class="form-label">Place</label>
                                    <input type="text" class="form-control" id="place" placeholder="Enter Place of Incident" required>
                                </div>
                                <div class="col-4">
                                    <label for="caseType" class="form-label">Case Type</label>
                                    <select class="form-select" name="sufname" id="caseType" required>
                                        <option value="Jr">Blotter</option>
                                        <option value="Sr.">Complaint</option>
                                        <option value="I">WCP</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-4">
                <div class="card">
                    <div class="card-body card2">
                        <h5 class="card-title">Narrative/More Details</h5>
                        <textarea class="form-control" rows="3"></textarea> <!-- Use rows attribute for textarea height -->
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-4 mb-5">
                <div class="text-center">
                    <button type="submit" name="save_account" class="btn submit">SUBMIT</button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footerAdmin.php'; ?>
