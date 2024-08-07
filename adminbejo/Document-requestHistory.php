<?php 
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = :docType) AND stat = 'Done'");
    $stmt->bindParam(':docType', $docType, PDO::PARAM_STR);
    $stmt->execute();
    $number_of_pending_results = $stmt->fetchColumn();

    $results_per_page = 1;

    $number_of_residency_pages = ceil($number_of_pending_results / $results_per_page);
    $residency_page = isset($_GET['residency_page']) ? (int)$_GET['residency_page'] : 1;
    $residency_page = max(1, min($residency_page, $number_of_residency_pages));
    $residency_offset = ($residency_page - 1) * $results_per_page;


    // Retrieve the data to display for the current page
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if($search){
        $residency = fetchdocsRequestHistorySearch($pdo, 'Barangay Residency', 'Done', 'Released', $results_per_page, $residency_offset, $search);
    }else{
        $residency = fetchdocsRequestHistory($pdo, 'Barangay Residency', 'Done', 'Released', $results_per_page, $residency_offset);
    }
    

?>
</div>
<link rel="stylesheet" href="css/slidingtableResidency.css">
<main>
    <h1 class="text-center pt-3">Requested Document History </h1>
    <div class="d-flex justify-content-between align-items-center m-2">
        <a href="Admin-Document.php" class="back-button d-flex align-items-center">
            <i class="fa-solid fa-chevron-left fa-2x"></i>
            <span>Back</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="ScanQR.php" class="btn camera-btn">
                <i class="bi bi-camera" style="font-size: 1.2rem;"></i>&nbsp;Scan QR
            </a>
            <form method="GET" id="searchForm">
                <div class="input-group mb-0 custom-search">
                    <input type="search" class="form-control custom-search" name="search" placeholder="Search" aria-label="Search" id="searchInput" value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn search-btn" title="Search" id="search_btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="history-table container-fluid d-flex" style="border-radius: 10px; padding-left:0; background-color: darkgray; width: 1390px; max-height: 570px;  min-height: 530px; height: 100%;">
        <div class="history-selection">  
            <a href="#" id="Table1">
                <div class="select-docs text-center ">
                    Barangay Residency
                </div>
            </a>
            <a href="#" id="Table2">
                <div class="select-docs text-center mt-1">
                    Barangay Indigency
                </div>
            </a>
            <a href="#" id="Table3">
                <div class="select-docs text-center mt-1">
                    Barangay Certificate
                </div>
            </a>
            <a href="#" id="Table4">
                <div class="select-docs text-center mt-1">
                    Barangay Clearance
                </div>
            </a>
            <a href="#" id="Table5">
                <div class="select-docs text-center mt-1">
                    Barangay Electrical Permit
                </div>
            </a>
            <a href="#" id="Table6">
                <div class="select-docs text-center mt-1">
                    Barangay Construction Permit
                </div>
            </a>
            <a href="#" id="Table7">
                <div class="select-docs text-center mt-1">
                    Barangay Fencing Permit
                </div>
            </a>
            <a href="#" id="Table8">
                <div class="select-docs text-center mt-1">
                    Barangay Business Clearance
                </div>
            </a>
            <a href="#" id="Table9">
                <div class="select-docs text-center mt-1">
                    Cedula
                </div>
            </a>
        </div>

        <div class="vertical-line">
            <hr class="vertical" style="margin: 10px auto;">
        </div>

        <div class="history-tableholder" id="historyTable1">
            <table class="table-history table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Document ID</th>
                        <th>Name</th>
                        <th>Document Requested</th>
                        <th>Date & Time Requested</th>
                        <th>Purpose</th>
                        <th>Date & Time Released</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($residency)): ?>
                        <tr><td colspan="8">No Documents Yet</td></tr>
                    <?php else: ?>  
                        <?php foreach ($residency as $row): ?>
                            <tr>
                                <td><?php echo $row['doc_ID']?></td>
                                <td><?php echo $row['resident_name']?></td>
                                <td><?php echo $row['document_name']?></td>
                                <td><?php echo $row['date_req']?></td>
                                <td><?php echo $row['purpose_name']?></td>
                                <td><?php echo $row['date_processed']?></td>
                                <td><?php echo $row['remarks']?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <nav id="residencyPagination" aria-label="Residency Page Navigation" >
                    <ul class="pagination pagination-sm mb-4">
                        <li class="page-item">
                            <a class="page-link" href="?residency_page=1" aria-label="First">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?residency_page=<?= max(1, $residency_page - 1) ?>" aria-label="Previous">
                                <span aria-hidden="true">Prev</span>
                            </a>
                        </li>
                        <?php for ($i = max(1, $residency_page - 2); $i <= min($number_of_residency_pages, $residency_page + 2); $i++): ?>
                            <li class="page-item <?= ($i == $residency_page) ? 'active' : '' ?>">
                                <a class="page-link" href="?residency_page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="?residency_page=<?= min($number_of_residency_pages, $residency_page + 1) ?>" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?residency_page=<?= $number_of_residency_pages ?>" aria-label="Last">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
            </nav>
        </div>

        <div class="history-tableholder hidden" id="historyTable2">
            <table class="table-history table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Name</th>
                        <th>Document Requested</th>
                        <th>Date & Time Requested</th>
                        <th>Purpose</th>
                        <th>Date & Time Released</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2022-03-15</td>
                        <td>Johnny Dept</td>
                        <td>Pending</td>
                        <td><a href="#" class="btn btn-primary">View</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Add other tables similarly, keeping them hidden by default -->
        <div class="history-tableholder hidden" id="historyTable3">
            <!-- Barangay Certificate Table -->
        </div>
        <div class="history-tableholder hidden" id="historyTable4">
            <!-- Barangay Clearance Table -->
        </div>
        <div class="history-tableholder hidden" id="historyTable5">
            <!-- Barangay Electrical Permit Table -->
        </div>
        <div class="history-tableholder hidden" id="historyTable6">
            <!-- Barangay Construction Permit Table -->
        </div>
        <div class="history-tableholder hidden" id="historyTable7">
            <!-- Barangay Fencing Permit Table -->
        </div>
        <div class="history-tableholder hidden" id="historyTable8">
            <!-- Barangay Business Clearance Table -->
        </div>
        <div class="history-tableholder hidden" id="historyTable9">
            <!-- Cedula Table -->
        </div>

    <div>
    
</main>

<?php include 'footerAdmin.php'; ?>

<script>
    function showHistoryTable(tableId, paginationId) {
    // Hide all tables and paginations
    document.querySelectorAll('.history-tableholder').forEach(function(table) {
        table.classList.add('hidden');
    });
    document.querySelectorAll('.pagination').forEach(function(pagination) {
        pagination.classList.add('hidden');
    });

    // Show the selected table and its corresponding pagination
    document.getElementById(tableId).classList.remove('hidden');
    document.getElementById(paginationId).classList.remove('hidden');
}

// Event listeners for each document selection
document.getElementById('Table1').addEventListener('click', function() {
    showHistoryTable('historyTable1', 'residencyPagination');
    setActiveLink('Table1');
});

document.getElementById('Table2').addEventListener('click', function() {
    showHistoryTable('historyTable2', 'indigencyPagination');
    setActiveLink('Table2');
});

document.getElementById('Table3').addEventListener('click', function() {
    showHistoryTable('historyTable3', 'certificatePagination');
    setActiveLink('Table3');
});

document.getElementById('Table4').addEventListener('click', function() {
    showHistoryTable('historyTable4', 'clearancePagination');
    setActiveLink('Table4');
});

document.getElementById('Table5').addEventListener('click', function() {
    showHistoryTable('historyTable5', 'electricalPermitPagination');
    setActiveLink('Table5');
});

document.getElementById('Table6').addEventListener('click', function() {
    showHistoryTable('historyTable6', 'constructionPermitPagination');
    setActiveLink('Table6');
});

document.getElementById('Table7').addEventListener('click', function() {
    showHistoryTable('historyTable7', 'fencingPermitPagination');
    setActiveLink('Table7');
});

document.getElementById('Table8').addEventListener('click', function() {
    showHistoryTable('historyTable8', 'businessClearancePagination');
    setActiveLink('Table8');
});

document.getElementById('Table9').addEventListener('click', function() {
    showHistoryTable('historyTable9', 'cedulaPagination');
    setActiveLink('Table9');
});

function setActiveLink(activeLinkId) {
    // Remove active class from all links
    document.querySelectorAll('.select-docs').forEach(function(link) {
        link.classList.remove('active');
    });
    // Add active class to the clicked link
    document.getElementById(activeLinkId).classList.add('active');

    // Store the active link and table in session storage
    sessionStorage.setItem('activeTable', document.querySelector('.history-tableholder:not(.hidden)').id);
    sessionStorage.setItem('activePagination', document.querySelector('.pagination:not(.hidden)').id);
    sessionStorage.setItem('activeLink', activeLinkId);
}

// Set initial visibility based on session storage
let activeTable = sessionStorage.getItem('activeTable') || 'historyTable1';
let activePagination = sessionStorage.getItem('activePagination') || 'residencyPagination';
let activeLink = sessionStorage.getItem('activeLink') || 'Table1';

showHistoryTable(activeTable, activePagination);
document.getElementById(activeLink).classList.add('active');

// Initial page load: Show the Barangay Residency table and its pagination by default
document.addEventListener('DOMContentLoaded', function() {
    showHistoryTable('historyTable1', 'residencyPagination');
});


</script>
