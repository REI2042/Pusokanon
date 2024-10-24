
<?php 
    include '../include/staff_restrict_pages.php';
    include '../db/DBconn.php';
    include 'headerAdmin.php';

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $docType = 'Barangay Indigency';

    
    // Find out the number of Pending results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = :docType) AND stat = 'Pending'");
    $stmt->bindParam(':docType', $docType, PDO::PARAM_STR);
    $stmt->execute();
    $number_of_pending_results = $stmt->fetchColumn();
    
    // Find out the number of Processing results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = :docType) AND stat = 'Processing'");
    $stmt->bindParam(':docType', $docType, PDO::PARAM_STR);
    $stmt->execute();
    $number_of_processing_results = $stmt->fetchColumn();
    
    // Find out the number of Completed results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = :docType) AND stat = 'Ready to pickup'");
    $stmt->bindParam(':docType', $docType, PDO::PARAM_STR);
    $stmt->execute();
    $number_of_completed_results = $stmt->fetchColumn();

    // Define the number of results per page
    $results_per_page = 5;
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


    if($search != null) {
        $pending = fetchdocsRequestSearch($pdo, $docType,'Pending', $results_per_page, $pending_offset, $search);
        $Processing = fetchdocsRequestSearch($pdo, $docType,'Processing', $results_per_page, $processing_offset, $search);
        $completed = fetchdocsRequestSearch($pdo, $docType,'Ready to pickup', $results_per_page, $completed_offset, $search);
    } else {
        $pending = fetchdocsRequest($pdo, $docType,'Pending', $results_per_page, $pending_offset);
        $Processing = fetchdocsRequest($pdo, $docType,'Processing', $results_per_page, $processing_offset);
        $completed = fetchdocsRequest($pdo, $docType,'Ready to pickup', $results_per_page, $completed_offset);
    }
    
?>

<link rel="stylesheet" href="css/slidingtableResidency.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<main>
    <div class="row">
        <div class="col-12 pt-3 d-flex justify-content-center">
            <h1 class="title"><?php echo $docType; ?></h1>
        </div>
    </div>
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
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        if (this.value === '') {
            document.getElementById('searchForm').submit();
        }
    });
</script>
    <div id="searchresult" class="table-content" style="min-width: 92vw; width: 92vw; max-width: 95vw;">
        <div id="originalTable">
            <div class="controls text-center mt-3">
                <a id="showTable1" class="link1">-- Pending  -- </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a id="showTable2" class="link2">-- Processing  --</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a id="showTable3" class="link3">-- Ready to Pickup -- </a>
            </div>
            <div id="table1Container" class="small-font">
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
                            <tr><td colspan="8">No Pending Documents</td></tr>
                        <?php else: ?>    
                            <?php foreach ($pending as $pendings): ?>
                                <tr>
                                <?php $dataDecrypt = decryptData($pendings['res_email']); ?>
                                    <td><?= htmlspecialchars($pendings['res_id']); ?></td>
                                    <td><?= htmlspecialchars($pendings['resident_name']); ?></td>
                                    <td><?= htmlspecialchars($pendings['document_name']); ?></td>
                                    <td><?= htmlspecialchars($pendings['purpose_name']); ?></td>
                                    <td><?= htmlspecialchars($pendings['stat']); ?></td>
                                    <td><?= date('m/d/y h:i A', strtotime($pendings['date_req'])); ?></td>
                                    <td><?= htmlspecialchars($pendings['remarks']); ?></td>
                                    <td>
                                        <div class="inline-tools">
                                            <div title="Delete" class="btn btn-danger btn-sm btn-del" onclick="trashCancelDocument('<?= htmlspecialchars($pendings['doc_ID']); ?>', '<?= htmlspecialchars($pendings['request_id']); ?>')"><i class="bi bi-trash3-fill"></i></div>                                         
                                            <form class="status-form" action="../db/updateStatus.php" method="POST">
                                                <input type="hidden" name="doctype" value="<?= $docType;?>">
                                                <input type="hidden" name="res_email" value="<?= htmlspecialchars($dataDecrypt); ?>">
                                                <input type="hidden" name="resident_name" value="<?= htmlspecialchars($pendings['resident_name']); ?>">
                                                <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($pendings['doc_ID']); ?>">
                                                <input type="hidden" name="resident_id" value="<?= htmlspecialchars($pendings['res_id']); ?>">
                                                <button title="Download" type="submit" name="status" value="Processing" class="btn btn-sm <?= $pendings['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                                <button title="Approve" type="button" class="btn btn-sm <?= $pendings['stat'] == 'Ready to pickup' ? 'btn-success' : 'btn-success'; ?>" onclick="showSweetAlert('<?= htmlspecialchars($dataDecrypt); ?>', '<?= htmlspecialchars($pendings['resident_name']); ?>', '<?= htmlspecialchars($pendings['document_name']); ?>','<?= htmlspecialchars($pendings['doc_ID']); ?>', '<?= htmlspecialchars($pendings['res_id']); ?>')"><i class="fa-solid fa-check"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <nav id="pendingPagination" aria-label="Pending Page navigation">
                    <ul class="pagination pagination-sm ">
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

            <div id="table2Container" class="hidden small-font">
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
                            <tr><td colspan="8">No Processing Documents</td></tr>
                        <?php else: ?>    
                            <?php foreach ($Processing as $processings): ?>
                                <tr>
                                    <td><?= htmlspecialchars($processings['res_id']); ?></td>
                                    <td><?= htmlspecialchars($processings['resident_name']); ?></td>
                                    <td><?= htmlspecialchars($processings['document_name']); ?></td>
                                    <td><?= htmlspecialchars($processings['purpose_name']); ?></td>
                                    <td><?= htmlspecialchars($processings['stat']); ?></td>
                                    <td><?= date('m/d/y h:i A', strtotime($processings['date_req'])); ?></td>
                                    <td><?= htmlspecialchars($processings['remarks']); ?></td>
                                    <td>
                                        <div class="inline-tools">
                                            <div title="Delete" class="btn btn-danger btn-sm btn-del" onclick="trashCancelDocument('<?= htmlspecialchars($processings['doc_ID']); ?>', '<?= htmlspecialchars($processings['request_id']); ?>')"><i class="bi bi-trash3-fill"></i></div>
                                            <form class="status-form" action="../db/updateStatus.php" method="POST"> 
                                                <input type="hidden" name="doctype" value="<?= $docType;?>">                                           
                                                <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($processings['doc_ID']); ?>">
                                                <input type="hidden" name="resident_id" value="<?= htmlspecialchars($processings['res_id']); ?>">
                                                <button title="Download" type="submit" name="status" value="Processing" class="btn btn-sm <?= $processings['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <nav id="processingPagination" aria-label="Processing Page navigation">
                    <ul class="pagination pagination-sm">
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

            <div id="table3Container" class="hidden small-font">
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
                         <?php if (empty($completed)): ?>
                            <tr><td colspan="8">No Ready to Pick up Documents</td></tr>
                        <?php else: ?>    
                            <?php foreach ($completed as $completed): ?>
                                <tr>
                                    <td><?= htmlspecialchars($completed['res_id']); ?></td>
                                    <td><?= htmlspecialchars($completed['resident_name']); ?></td>
                                    <td><?= htmlspecialchars($completed['document_name']); ?></td>
                                    <td><?= htmlspecialchars($completed['purpose_name']); ?></td>
                                    <td><?= htmlspecialchars($completed['stat']); ?></td>
                                    <td><?= date('m/d/y h:i A', strtotime($completed['date_req'])); ?></td>
                                    <td><?= htmlspecialchars($completed['remarks']); ?></td>
                                    <td>
                                        <div class="inline-tools">
                                            <div title="Delete" class="btn btn-danger btn-sm btn-del" onclick="trashCancelDocument('<?= htmlspecialchars($completed['doc_ID']); ?>', '<?= htmlspecialchars($completed['request_id']); ?>')"><i class="bi bi-trash3-fill"></i></div>
                                            <form class="status-form" action="../db/updateStatus.php" method="POST">
                                                <input type="hidden" name="doctype" value="<?= $docType;?>">
                                                <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($completed['doc_ID']); ?>">
                                                <input type="hidden" name="resident_id" value="<?= htmlspecialchars($completed['res_id']); ?>">
                                                <button title="Download" type="submit" name="status" value="Processing" class="btn btn-sm <?= $completed['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                            </form>
                                        </div>
                                    </td>  
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <nav id="completedPagination" aria-label="Completed Page navigation">
                    <ul class="pagination pagination-sm">
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

<script src="phpConn/get_tables.js"></script>

<?php include 'footerAdmin.php';?>
