<?php
    include '../db/DBconn.php';
    include 'headerAdmin.php';

    // Define the number of results per page
    $results_per_page = 3;

    // Find out the number of Pending results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Pending'");
    $stmt->execute();
    $number_of_pending_results = $stmt->fetchColumn();

    // Find out the number of Processing results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Processing'");
    $stmt->execute();
    $number_of_processing_results = $stmt->fetchColumn();

    // Determine the total number of pages available for Pending and Processing
    $number_of_pending_pages = ceil($number_of_pending_results / $results_per_page);
    $number_of_processing_pages = ceil($number_of_processing_results / $results_per_page);

    // Determine which page number visitor is currently on for Pending and Processing
    $pending_page = isset($_GET['pending_page']) ? (int)$_GET['pending_page'] : 1;
    $processing_page = isset($_GET['processing_page']) ? (int)$_GET['processing_page'] : 1;

    // Ensure the page number is within the valid range
    $pending_page = max(1, min($pending_page, $number_of_pending_pages));
    $processing_page = max(1, min($processing_page, $number_of_processing_pages));

    // Determine the SQL LIMIT starting number for the results on the displaying page
    $pending_offset = ($pending_page - 1) * $results_per_page;
    $processing_offset = ($processing_page - 1) * $results_per_page;

    // Retrieve the data to display for the current page
    $pending = fetchdocsRequest($pdo, 'Pending', $results_per_page, $pending_offset);
    $Processing = fetchdocsRequest($pdo, 'Processing', $results_per_page, $processing_offset);
?>

</div>
<link rel="stylesheet" href="css/slidingtableResidency.css">

<main> 
    <div class="row">
        <div class="col-12 pt-3 d-flex justify-content-center">
            <h1 class="title">BARANGAY RESIDENCY</h1>
        </div>
    </div>
    <div class="controls text-center mt-3">
        <a id="showTable1" class="link1">-- Pending Documents -- </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a id="showTable2" class="link2">-- Processing Documents --</a>
    </div>

    <div class="table-content">
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
                                        <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($pendings['doc_ID']); ?>">
                                        <input type="hidden" name="resident_id" value="<?= htmlspecialchars($pendings['res_id']); ?>">
                                        <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $pendings['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                        <button type="submit" name="status" value="Ready to pickup" class="btn btn-sm <?= $pendings['stat'] == 'Ready to pickup' ? 'btn-success' : 'btn-success'; ?>"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav id="pendingPagination" aria-label="Pending Page navigation">
                <ul class="pagination">
                    <?php if ($pending_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pending_page=1" aria-label="First">
                                <span aria-hidden="true">Start</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pending_page=<?= $pending_page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $number_of_pending_pages; $i++): ?>
                        <li class="page-item <?= ($i == $pending_page) ? 'active' : '' ?>">
                            <a class="page-link" href="?pending_page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($pending_page < $number_of_pending_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pending_page=<?= $pending_page + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pending_page=<?= $number_of_pending_pages ?>" aria-label="Last">
                                <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                    <?php endif; ?>
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
                                        <button type="submit" name="status" value="download" class="btn btn-sm <?= $processings['stat'] == 'download' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                        <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $processings['stat'] == 'Processing' ? 'btn-success' : 'btn-success'; ?>"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <nav id="processingPagination" aria-label="Processing Page navigation">
            <ul class="pagination">
                <?php if ($processing_page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=1" aria-label="First">
                            <span aria-hidden="true">Start</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=<?= $processing_page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $number_of_processing_pages; $i++): ?>
                    <li class="page-item <?= ($i == $processing_page) ? 'active' : '' ?>">
                        <a class="page-link" href="?processing_page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($processing_page < $number_of_processing_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=<?= $processing_page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?processing_page=<?= $number_of_processing_pages ?>" aria-label="Last">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>    
</main>

<script>
    function showTable(tableId, paginationId) {
        document.getElementById('table1Container').classList.add('hidden');
        document.getElementById('table2Container').classList.add('hidden');
        document.getElementById('pendingPagination').classList.add('hidden');
        document.getElementById('processingPagination').classList.add('hidden');
        document.getElementById(tableId).classList.remove('hidden');
        document.getElementById(paginationId).classList.remove('hidden');
    }

    document.getElementById('showTable1').addEventListener('click', function() {
        showTable('table1Container', 'pendingPagination');
        document.getElementById('showTable1').classList.add('active');
        document.getElementById('showTable2').classList.remove('active');
    });

    document.getElementById('showTable2').addEventListener('click', function() {
        showTable('table2Container', 'processingPagination');
        document.getElementById('showTable2').classList.add('active');
        document.getElementById('showTable1').classList.remove('active');
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
</script>


<?php include 'footerAdmin.php'; ?>
