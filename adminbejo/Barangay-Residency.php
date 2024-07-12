<?php
include '../db/DBconn.php';
include 'headerAdmin.php';



// Find out the number of Pending results stored in the database
$stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Pending'");
$stmt->execute();
$number_of_pending_results = $stmt->fetchColumn();

// Find out the number of Processing results stored in the database
$stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Processing '");
$stmt->execute();
$number_of_processing_results = $stmt->fetchColumn();

// Find out the number of Completed results stored in the database
$stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Ready to pickup'");
$stmt->execute();
$number_of_completed_results = $stmt->fetchColumn();


// Define the number of results per page
$results_per_page = 2;
// Determine the total number of pages available for Pending, Processing, and Completed
$number_of_pending_pages = ceil($number_of_pending_results / $results_per_page);
$number_of_processing_pages = ceil($number_of_processing_results / $results_per_page);
$number_of_completed_pages = ceil($number_of_completed_results / $results_per_page);

// Determine which page number visitor is currently on for Pending, Processing, and Completed
$pending_page = isset($_GET['pending_page']) ? (int)$_GET['pending_page'] : 1;
$processing_page = isset($_GET['processing_page']) ? (int)$_GET['processing_page'] : 1;
$completed_page = isset($_GET['completed_page']) ? (int)$_GET['completed_page'] : 1;

// Ensure the page number is within the valid range
$pending_page = max(1, min($pending_page, $number_of_pending_pages));
$processing_page = max(1, min($processing_page, $number_of_processing_pages));
$completed_page = max(1, min($completed_page, $number_of_completed_pages));

// Determine the SQL LIMIT starting number for the results on the displaying page
$pending_offset = ($pending_page - 1) * $results_per_page;
$processing_offset = ($processing_page - 1) * $results_per_page;
$completed_offset = ($completed_page - 1) * $results_per_page;

// Retrieve the data to display for the current page
$pending = fetchdocsRequest($pdo, 'Pending', $results_per_page, $pending_offset);
$Processing = fetchdocsRequest($pdo, 'Processing', $results_per_page, $processing_offset);
$completed = fetchdocsRequest($pdo, 'Ready to pickup', $results_per_page, $completed_offset);


?>

</div>
<link rel="stylesheet" href="css/slidingtableResidency.css">
<script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>

<main>
    <div class="row">
        <div class="col-12 pt-3 d-flex justify-content-center">
            <h1 class="title">BARANGAY RESIDENCY</h1>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center m-2">
        <a href="Admin-Document.php" class="back-button d-flex align-items-center">
            <i class="fa-solid fa-chevron-left fa-2x"></i>
            <span>Back</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="ScanQR.php" class="btn camera-btn ">
                <i class="bi bi-camera" style="font-size: 1.2rem;"></i>&nbsp;Scan QR
            </a>
            <div class="input-group mb-0 custom-search">
                <input type="search" class="form-control custom-search" placeholder="Search" aria-label="Search">
                <button class="btn search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            
        </div>
    </div>

    <div class="table-content">
        <div class="controls text-center mt-3">
            <a id="showTable1" class="link1">-- Pending Documents -- </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="showTable2" class="link2">-- Processing Documents --</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="showTable3" class="link3">-- Ready to Pickup Documents -- </a>
        </div>
        <div id="table1Container">
            <table id="table1">
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
                    <?php if (empty($pending)): ?>
                        <tr><td colspan="8">No user registered</td></tr>
                    <?php else: ?>    
                        <?php foreach ($pending as $pendings): ?>
                            <tr>
                                <td><?= htmlspecialchars($pendings['res_id']); ?></td>
                                <td><?= htmlspecialchars($pendings['resident_name']); ?></td>
                                <td><?= htmlspecialchars($pendings['document_name']); ?></td>
                                <td><?= htmlspecialchars($pendings['purpose_name']); ?></td>
                                <td><?= htmlspecialchars($pendings['stat']); ?></td>
                                <td><?= htmlspecialchars($pendings['date_req']); ?></td>
                                <td><?= htmlspecialchars($pendings['remarks']); ?></td>
                                <td>
                                    <div class="inline-tools">
                                        <div class="btn btn-danger btn-sm btn-1"><i class="bi bi-trash3-fill"></i></div>
                                        <form class="status-form" action="../db/updateStatus.php" method="POST">
                                            <?php $dataDecrypt = decryptData($pendings['res_email']); ?>
                                            <input type="hidden" name="res_email" value="<?= htmlspecialchars($dataDecrypt); ?>">
                                            <input type="hidden" name="resident_name" value="<?= htmlspecialchars($pendings['resident_name']); ?>">
                                            <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($pendings['doc_ID']); ?>">
                                            <input type="hidden" name="resident_id" value="<?= htmlspecialchars($pendings['res_id']); ?>">
                                            <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $pendings['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                            <button type="button" class="btn btn-sm <?= $pendings['stat'] == 'Ready to pickup' ? 'btn-success' : 'btn-success'; ?>" onclick="showSweetAlert('<?= htmlspecialchars($dataDecrypt); ?>', '<?= htmlspecialchars($pendings['resident_name']); ?>', '<?= htmlspecialchars($pendings['document_name']); ?>','<?= htmlspecialchars($pendings['doc_ID']); ?>', '<?= htmlspecialchars($pendings['res_id']); ?>')"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <nav id="pendingPagination" aria-label="Pending Page navigation">
                <ul class="pagination ">
                    <li class="page-item">
                        <a class="page-link" href="?pending_page=1" aria-label="First">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?pending_page=<?= max(1, $pending_page - 1) ?>" aria-label="Previous">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                    <?php for ($i = max(1, $pending_page - 2); $i <= min($number_of_pending_pages, $pending_page + 2); $i++): ?>
                        <li class="page-item <?= ($i == $pending_page) ? 'active' : '' ?>">
                            <a class="page-link" href="?pending_page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?pending_page=<?= min($number_of_pending_pages, $pending_page + 1) ?>" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?pending_page=<?= $number_of_pending_pages ?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div id="table2Container" class="hidden">
            <table id="table2">
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
                    <?php if (empty($Processing)): ?>
                        <tr><td colspan="8">No user registered</td></tr>
                    <?php else: ?>    
                        <?php foreach ($Processing as $processings): ?>
                            <tr>
                                <td><?= htmlspecialchars($processings['res_id']); ?></td>
                                <td><?= htmlspecialchars($processings['resident_name']); ?></td>
                                <td><?= htmlspecialchars($processings['document_name']); ?></td>
                                <td><?= htmlspecialchars($processings['purpose_name']); ?></td>
                                <td><?= htmlspecialchars($processings['stat']); ?></td>
                                <td><?= htmlspecialchars($processings['date_req']); ?></td>
                                <td><?= htmlspecialchars($processings['remarks']); ?></td>
                                <td>
                                    <div class="inline-tools">
                                        <div class="btn btn-danger btn-sm btn-1"><i class="bi bi-trash3-fill"></i></div>
                                        <form class="status-form" action="../db/updateStatus.php" method="POST">                                            
                                            <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($processings['doc_ID']); ?>">
                                            <input type="hidden" name="resident_id" value="<?= htmlspecialchars($processings['res_id']); ?>">
                                            <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $pendings['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <nav id="processingPagination" aria-label="Processing Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=1" aria-label="First">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=<?= max(1, $processing_page - 1) ?>" aria-label="Previous">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                    <?php for ($i = max(1, $processing_page - 2); $i <= min($number_of_processing_pages, $processing_page + 2); $i++): ?>
                        <li class="page-item <?= ($i == $processing_page) ? 'active' : '' ?>">
                            <a class="page-link" href="?processing_page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=<?= min($number_of_processing_pages, $processing_page + 1) ?>" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=<?= $number_of_processing_pages ?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div id="table3Container" class="hidden">
            <table id="table3">
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
                    <?php foreach ($completed as $completeds): ?>
                        <tr>
                            <td><?= htmlspecialchars($completeds['res_id']); ?></td>
                            <td><?= htmlspecialchars($completeds['resident_name']); ?></td>
                            <td><?= htmlspecialchars($completeds['document_name']); ?></td>
                            <td><?= htmlspecialchars($completeds['purpose_name']); ?></td>
                            <td><?= htmlspecialchars($completeds['stat']); ?></td>
                            <td><?= htmlspecialchars($completeds['date_req']); ?></td>
                            <td><?= htmlspecialchars($completeds['remarks']); ?></td>
                            <td>
                                <div class="inline-tools">
                                    <div class="btn btn-danger btn-sm btn-1"><i class="bi bi-trash3-fill"></i></div>
                                    <form class="status-form" action="../db/updateStatus.php" method="POST">
                                        <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($completeds['doc_ID']); ?>">
                                        <input type="hidden" name="resident_id" value="<?= htmlspecialchars($completeds['res_id']); ?>">
                                        <button type="submit" name="status" value="download" class="btn btn-sm <?= $completeds['stat'] == 'download' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav id="completedPagination" aria-label="Completed Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="?completed_page=1" aria-label="First">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?completed_page=<?= max(1, $completed_page - 1) ?>" aria-label="Previous">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                    <?php for ($i = max(1, $completed_page - 2); $i <= min($number_of_completed_pages, $completed_page + 2); $i++): ?>
                        <li class="page-item <?= ($i == $completed_page) ? 'active' : '' ?>">
                            <a class="page-link" href="?completed_page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?completed_page=<?= min($number_of_completed_pages, $completed_page + 1) ?>" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?completed_page=<?= $number_of_completed_pages ?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>
<script src="../js/sweetAlert.js"></script>
<script type="text/javascript">
   (function(){
      emailjs.init({
        publicKey: "-eg-XfJjgYaCKpd3Q",
      });
   })();
</script>
<script>
    // function showTable(tableId, paginationId) {
    //     document.getElementById('table1Container').classList.add('hidden');
    //     document.getElementById('table2Container').classList.add('hidden');
    //     document.getElementById('pendingPagination').classList.add('hidden');
    //     document.getElementById('processingPagination').classList.add('hidden');
    //     document.getElementById(tableId).classList.remove('hidden');
    //     document.getElementById(paginationId).classList.remove('hidden');
    // }

    // document.getElementById('showTable1').addEventListener('click', function() {
    //     showTable('table1Container', 'pendingPagination');
    //     document.getElementById('showTable1').classList.add('active');
    //     document.getElementById('showTable2').classList.remove('active');
    // });

    // document.getElementById('showTable2').addEventListener('click', function() {
    //     showTable('table2Container', 'processingPagination');
    //     document.getElementById('showTable2').classList.add('active');
    //     document.getElementById('showTable1').classList.remove('active');

    // });


    // // Set initial visibility based on session storage
    // let activeTable = sessionStorage.getItem('activeTable') || 'table1Container';
    // let activePagination = sessionStorage.getItem('activePagination') || 'pendingPagination';
    // let activeLink = sessionStorage.getItem('activeLink') || 'showTable1';
    
    // showTable(activeTable, activePagination);
    // document.getElementById(activeLink).classList.add('active');
    

    // // Store the active table in session storage on click
    // document.getElementById('showTable1').addEventListener('click', function() {
    //     sessionStorage.setItem('activeTable', 'table1Container');
    //     sessionStorage.setItem('activePagination', 'pendingPagination');
    //     sessionStorage.setItem('activeLink', 'showTable1');
    // });

    // document.getElementById('showTable2').addEventListener('click', function() {
    //     sessionStorage.setItem('activeTable', 'table2Container');
    //     sessionStorage.setItem('activePagination', 'processingPagination');
    //     sessionStorage.setItem('activeLink', 'showTable2');
    // });
    function showTable(tableId, paginationId) {
        document.getElementById('table1Container').classList.add('hidden');
        document.getElementById('table2Container').classList.add('hidden');
        document.getElementById('table3Container').classList.add('hidden');
        document.getElementById('pendingPagination').classList.add('hidden');
        document.getElementById('processingPagination').classList.add('hidden');
        document.getElementById('completedPagination').classList.add('hidden');
        document.getElementById(tableId).classList.remove('hidden');
        document.getElementById(paginationId).classList.remove('hidden');
    }

    document.getElementById('showTable1').addEventListener('click', function() {
        showTable('table1Container', 'pendingPagination');
        document.getElementById('showTable1').classList.add('active');
        document.getElementById('showTable2').classList.remove('active');
        document.getElementById('showTable3').classList.remove('active');
    });

    document.getElementById('showTable2').addEventListener('click', function() {
        showTable('table2Container', 'processingPagination');
        document.getElementById('showTable2').classList.add('active');
        document.getElementById('showTable1').classList.remove('active');
        document.getElementById('showTable3').classList.remove('active');
    });

    document.getElementById('showTable3').addEventListener('click', function() {
        showTable('table3Container', 'completedPagination');
        document.getElementById('showTable3').classList.add('active');
        document.getElementById('showTable1').classList.remove('active');
        document.getElementById('showTable2').classList.remove('active');
    });

    // Set initial visibility based on session storage
    let activeTable = sessionStorage.getItem('activeTable') || 'table1Container';
    let activePagination = sessionStorage.getItem('activePagination') || 'pendingPagination';
    let activeLink = sessionStorage.getItem('activeLink') || 'showTable1';
    
    showTable(activeTable, activePagination);
    document.getElementById(activeLink).classList.add('active');
    

    // Store the active table in session storage on click
    document.getElementById('showTable1').addEventListener('click', function() {
        sessionStorage.setItem('activeTable', 'table1Container');
        sessionStorage.setItem('activePagination', 'pendingPagination');
        sessionStorage.setItem('activeLink', 'showTable1');
    });

    document.getElementById('showTable2').addEventListener('click', function() {
        sessionStorage.setItem('activeTable', 'table2Container');
        sessionStorage.setItem('activePagination', 'processingPagination');
        sessionStorage.setItem('activeLink', 'showTable2');
    });

    document.getElementById('showTable3').addEventListener('click', function() {
        sessionStorage.setItem('activeTable', 'table3Container');
        sessionStorage.setItem('activePagination', 'completedPagination');
        sessionStorage.setItem('activeLink', 'showTable3');
    });
</script>

<?php include 'footerAdmin.php'; ?>
