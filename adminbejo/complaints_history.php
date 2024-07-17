<?php
include 'headerAdmin.php';
?>
<link rel="stylesheet" href="css/list.css">

<div class="container-fluid">
    <h1>Complaints History</h1>
    <div class="card-body">
        <div class="table-responsive">
            <table id="complaints-history-table" class="table mx-auto" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Case Type</th>
                        <th>Place of Incident</th>
                        <th>Date/Time Reported</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- This will be populated by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../js/complaints_popUp.js"></script>

<?php require_once 'footerAdmin.php'; ?>