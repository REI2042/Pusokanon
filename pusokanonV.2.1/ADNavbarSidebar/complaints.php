<?php
    include 'headerAdmin.php';
?>  

<link rel="stylesheet" href="../css/write.css">

<div class="main-container">
    <div class="d-flex justify-content-center">
        <h1>Write Complaints</h1>
    </div>
    <div class="row mx-auto p-3">
            <div class="col">
                <div class="card card1 mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Respondent</h5>
                        <form class="row g-3">
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
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card1 mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Details about the Report</h5>
                            <form class="row g-3">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card2 mt-4 ml-4">
            <div class="card-body">
                <h5 class="card-title">Narrative/More Details</h5>
                <textarea type="text" class="form-control" id="inputCity"> </textarea>
            </div>
        </div>
        <div class="text-center col-8 mx-auto mt-5">
            <button type="submit" name="save_account" class="submit">SUBMIT</button>
        </div>
    </div>    
</div>


<?php include 'footerAdmin.php'; ?>