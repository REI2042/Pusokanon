<?php 
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';
    
    $doctype = isset($_GET['doctype']) ? $_GET['doctype'] : 'Barangay Residency';

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = :docType) AND stat = 'Done'");
    $stmt->bindParam(':docType', $doctype, PDO::PARAM_STR);
    $stmt->execute();
    $number_of_results = $stmt->fetchColumn();

    $results_per_page = 7;
    $number_of_pages = ceil($number_of_results / $results_per_page);
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, min($page, $number_of_pages));
    $offset = ($page - 1) * $results_per_page;

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    if($search){
        $docs = fetchdocsRequestHistorySearch($pdo, $doctype, 'Done', 'Released', $results_per_page, $offset, $search);
    }else{
        $docs = fetchdocsRequestHistory($pdo, $doctype, 'Done', 'Released', $results_per_page, $offset);
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
                <i class="bi bi-camera" style="font-size: 1.2rem;"></i>Scan QR
            </a>
            <form method="GET" id="searchForm">
                <div class="input-group mb-0 custom-search">
                    <input type="search" class="form-control custom-search" name="search" placeholder="Search" aria-label="Search" id="searchInput" value="<?php echo htmlspecialchars($search); ?>">
                    <input type="hidden" name="doctype" value="<?php echo htmlspecialchars($doctype); ?>">
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

    <div class="history-table container-fluid d-flex" style="border-radius: 10px; padding-left:0; background-color: darkgray; max-height: 570px;  min-height: 530px; height: 100%;">
        <div class="history-selection">  
            <form method="GET" id="doctypeForm">
                <a href="#" class="table-link" data-doctype="Barangay Residency">
                    <div class="select-docs text-center">
                        Barangay Residency
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Indigency">
                    <div class="select-docs text-center mt-1">
                        Barangay Indigency
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Certificate">
                    <div class="select-docs text-center mt-1">
                        Barangay Certificate
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Clearance">
                    <div class="select-docs text-center mt-1">
                        Barangay Clearance
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Electrical Permit">
                    <div class="select-docs text-center mt-1">
                        Barangay Electrical Permit
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Construction Permit">
                    <div class="select-docs text-center mt-1">
                        Barangay Construction Permit
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Fencing Permit">
                    <div class="select-docs text-center mt-1">
                        Barangay Fencing Permit
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Barangay Business Clearance">
                    <div class="select-docs text-center mt-1">
                        Barangay Business Clearance
                    </div>
                </a>
                <a href="#" class="table-link" data-doctype="Cedula"> 
                    <div class="select-docs text-center mt-1">
                        Cedula
                    </div>
                </a>
                <input type="hidden" name="doctype" id="doctypeInput" value="<?php echo htmlspecialchars($doctype); ?>">
            </form> 
        </div>

        <div class="vertical-line">
            <hr class="vertical" style="margin: 10px auto;">
        </div>
          <div class="history-tableholder">
              <table class="table-history" style="width: 100%; border-color: #007bff;">
                  <thead class="table-head">                    
                    <tr class="history-docs">
                        <th>Doc ID</th>
                        <th>Name</th>
                        <th>Document Requested</th>
                        <th>Date & Time Requested</th>
                        <th>Purpose</th>
                        <th>Date & Time Released</th>
                        <th>Remarks</th>
                    </tr>
                </thead >
                <tbody class="table-body">
                    <?php if (empty($docs)): ?>
                        <tr><td colspan="8">No Documents </td></tr>
                    <?php else: ?>  
                        <?php foreach ($docs as $row): ?>
                            <tr title="Click to View <?php echo $row['resident_name']?>" class="clickable-row" data-res-id="<?php echo $row['res_id']?>">
                                <td><?php echo $row['doc_ID']?></td>
                                <td><?php echo $row['resident_name']?></td>
                                <td><?php echo $row['document_name']?></td>
                                <td><?php echo date('m/d/y h:i A', strtotime($row['date_req']))?></td>
                                <td><?php echo $row['purpose_name']?></td>
                                <td><?php echo date('m/d/y h:i A', strtotime($row['date_processed']))?></td>
                                <td><?php echo $row['remarks']?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm mb-4">
                    <li class="page-item">
                        <a class="page-link" href="?doctype=<?= urlencode($doctype) ?>&page=1" aria-label="First">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?doctype=<?= urlencode($doctype) ?>&page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                    <?php for ($i = max(1, $page - 2); $i <= min($number_of_pages, $page + 2); $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?doctype=<?= urlencode($doctype) ?>&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?doctype=<?= urlencode($doctype) ?>&page=<?= min($number_of_pages, $page + 1) ?>" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?doctype=<?= urlencode($doctype) ?>&page=<?= $number_of_pages ?>" aria-label="Last">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>

<?php include 'footerAdmin.php'; ?>
<script src="../js/sweetAlert.js"></script>
<script>
    document.querySelectorAll('.table-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            let doctype = this.getAttribute('data-doctype');
            document.getElementById('doctypeInput').value = doctype;
            
            // Remove 'active' class from all links
            document.querySelectorAll('.table-link').forEach(l => {
                l.querySelector('.select-docs').classList.remove('active');
            });
            
            // Add 'active' class to the clicked link
            this.querySelector('.select-docs').classList.add('active');
            
            document.getElementById('doctypeForm').submit();
        });
    });

    // Set active class for the current document type
    document.querySelectorAll('.table-link').forEach(link => {
        if (link.getAttribute('data-doctype') === '<?php echo htmlspecialchars($doctype); ?>') {
            link.querySelector('.select-docs').classList.add('active');
        }
    });
</script>
