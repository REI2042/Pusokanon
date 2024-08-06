<?php 
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';
    
?>
</div>
<link rel="stylesheet" href="css/slidingtableResidency.css">
<main>
    <h1 class="text-center pt-3">Requested Document History </h1>
    <div class="history-table container-fluid d-flex" style="border-radius: 10px; padding-left:0; background-color: darkgray; width: 1390px; height: 570px;">
        <div class="history-selection">  
            <a href="#">
                <div class="select-docs text-center ">
                    Barangay Residency
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Barangay Indigency
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Barangay Certificate
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Barangay CLearance
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                   Barangay Electrical Permit
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Barangay Construction Permit
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Barangay Fencing Permit
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Barangay Business Clearance
                </div>
            </a>
            <a href="#">
                <div class="select-docs text-center mt-1">
                    Cedula
                </div>
            </a>
        </div>
        <div class="vertical-line">
            <hr class="vertical" style="margin: 10px auto;">
        </div>

        <div class="history-tableholder" >
            <table class="table-history table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Account No.</th>
                        <th>Name</th>
                        <th>Document Requested</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Date & Time Requested</th>
                        <th>Remarks</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2022-03-15</td>
                        <td>John Doe</td>
                        <td>Pending</td>
                        <td><a href="#" class="btn btn-primary">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <div>
    
</main>

<?php include 'footerAdmin.php'; ?>