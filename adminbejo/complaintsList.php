    <?php
        include '../include/staff_restrict_pages.php';
        include 'headerAdmin.php';
        include '../db/DBconn.php';

        
        // Retrieve query parameters
$caseType = $_GET['case_type'] ?? '';
$incidentPlace = $_GET['incident_place'] ?? '';
$searchTerm = trim($_GET['searchTerm'] ?? '');
$status = $_GET['status'] ?? '';

// Fetch counts for each status
// $stmt = $pdo->prepare("SELECT COUNT(*) FROM complaints_tbl WHERE status = ?");

// $stmt->execute(['Pending']);
// $num_pendingComplaints = $stmt->fetchColumn();

// $stmt->execute(['Approved']);
// $num_approvedComplaints = $stmt->fetchColumn();

// $stmt->execute(['Rejected']);
// $num_rejectedComplaints = $stmt->fetchColumn();



$limit = 5; // Number of complaints per page

// Total number of pages available for Pending, Approved, and Rejected
// Fetch total number of complaints for each status
$total_pending = fetchTotalPendingComp($pdo);
$total_approved = fetchTotalApprovedComp($pdo);
$total_rejected = fetchTotalRejectedComp($pdo);

// Determine which page number visitor is currently on
$pendingPage = max(1, min((int)($_GET['pendingPage'] ?? 1), ceil($total_pending / $limit)));
$approvedPage = max(1, min((int)($_GET['approvedPage'] ?? 1), ceil($total_approved / $limit)));
$rejectedPage = max(1, min((int)($_GET['rejectedPage'] ?? 1), ceil($total_rejected / $limit)));

// Calculate the offset for each status
$pending_offset = ($pendingPage - 1) * $limit;
$approved_offset = ($approvedPage - 1) * $limit;
$rejected_offset = ($rejectedPage - 1) * $limit;

// Retrieve the data to display for the current page
$pendingComplaints = fetchListofComplaints($pdo, $pending_offset, $limit, $caseType, $incidentPlace, 'Pending', $searchTerm);
$approvedComplaints = fetchListofComplaints($pdo, $approved_offset, $limit, $caseType, $incidentPlace, 'Approved', $searchTerm);
$rejectedComplaints = fetchListofComplaints($pdo, $rejected_offset, $limit, $caseType, $incidentPlace, 'Rejected', $searchTerm);

// Calculate total pages for each status
$total_pending_pages = ceil($total_pending / $limit);
$total_approved_pages = ceil($total_approved / $limit);
$total_rejected_pages = ceil($total_rejected / $limit);


    ?>

        <link rel="stylesheet" href="css/list.css">

        <div class="container-fluid">
        <h1>List of Complaints</h1>
        <div class="mu-ds row d-flex justify-content-between align-items-center mt-5 mb-3">
            <div class="col-12 col-md-3 mb-2 mb-md-0">
                <a id="pendingLink" class="status-link me-2 active status-btn1" href="javascript:void(0);" onclick="showTable('pending')">Pending</a>
                <a id="approvedLink" class="status-link me-2 status-btn2" href="javascript:void(0);" onclick="showTable('approved')">Approved</a>
                <a id="rejectedLink" class="status-link status-btn3" href="javascript:void(0);" onclick="showTable('rejected')">Rejected</a>
            </div>
            <div class="col-12 col-md-9 d-flex justify-content-end align-items-center flex-wrap">
                <div class="dropdown me-2 mb-2 mb-md-0">
                    <button class="btn dropdown-toggle this-button" type="button" id="incidentPlaceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Incident Place
                    </button>
                    <div class="dropdown-menu" aria-labelledby="incidentPlaceDropdown">
                        <a class="dropdown-item" data-incident-place="" href="#">Show All</a>
                        <a class="dropdown-item" data-incident-place="Arca" href="#">Arca</a>
                        <a class="dropdown-item" data-incident-place="Cemento" href="#">Cemento</a>
                        <a class="dropdown-item" data-incident-place="Chumba-Chumba" href="#">Chumba-Chumba</a>
                        <a class="dropdown-item" data-incident-place="Ibabao" href="#">Ibabao</a>
                        <a class="dropdown-item" data-incident-place="Lawis" href="#">Lawis</a>
                        <a class="dropdown-item" data-incident-place="Matumbo" href="#">Matumbo</a>
                        <a class="dropdown-item" data-incident-place="Mustang" href="#">Mustang</a>
                        <a class="dropdown-item" data-incident-place="New Lipata" href="#">New Lipata</a>
                        <a class="dropdown-item" data-incident-place="San Roque" href="#">San Roque</a>
                        <a class="dropdown-item" data-incident-place="Seabreeze" href="#">Seabreeze</a>
                        <a class="dropdown-item" data-incident-place="Seaside" href="#">Seaside</a>
                        <a class="dropdown-item" data-incident-place="Sewage" href="#">Sewage</a>
                        <a class="dropdown-item" data-incident-place="Sta. Maria" href="#">Sta. Maria</a>
                    </div>
                </div>
                <div class="dropdown me-2 mb-2 mb-md-0">
                    <button class="btn dropdown-toggle this-button" type="button" id="caseTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Case Type
                    </button>
                    <div class="dropdown-menu" aria-labelledby="caseTypeDropdown">
                        <a class="dropdown-item" data-case-type="" href="#">Show All</a>
                        <a class="dropdown-item" data-case-type="Bullying" href="#">Bullying</a>
                        <a class="dropdown-item" data-case-type="Damaging Properties" href="#">Damaging Properties</a>
                        <a class="dropdown-item" data-case-type="Vandalism" href="#">Defamation</a>
                        <a class="dropdown-item" data-case-type="Libel" href="#">Libel</a>
                        <a class="dropdown-item" data-case-type="Physical Abuse" href="#">Physical Abuse</a>
                        <a class="dropdown-item" data-case-type="Threat" href="#">Threat</a>
                        <a class="dropdown-item" data-case-type="Trespassing" href="#">Trespassing</a>
                        <a class="dropdown-item" data-case-type="Theft" href="#">Theft</a>
                        <a class="dropdown-item" data-case-type="Vandalism" href="#">Vandalism</a>
                        <a class="dropdown-item" data-case-type="Other" href="#">Others</a>
                    </div>
                </div>
                <form method="GET" class="d-flex" id="searchForm">
                    <input id="searchInput" name="searchTerm" class="form-control me-2" type="input" placeholder="Search name" aria-label="Search name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button class="btn this-button" type="submit">Search</button>
                </form>

                <script>
                    document.getElementById('searchInput').addEventListener('input', function() {
                        if (this.value === '') {
                            document.getElementById('searchForm').submit();
                        }
                    });
                </script>

            </div>
        </div>

        <div id="results" class="card d-flex flex-column">
            <div class="card-body flex-grow-1 d-flex flex-column">
                <div class="table-responsive flex-grow-1">
                    <!-- Pending Complaints Table -->
                    <div id="pendingContainer">
                        <table id="pendingTable" class="table mx-auto" cellspacing="0" cellpadding="0">
                            <thead style="background-color: #FE9705;">
                                <tr>
                                    <th>Case ID</th>
                                    <th>Case Type</th>
                                    <th>Place of Incident</th>
                                    <th>Date/Time Reported</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody class="scrollable-table-body">
                                <?php if (!empty($pendingComplaints)): ?>
                                    <?php foreach ($pendingComplaints as $complaint): ?>
                                        <tr>
                                            <?php
                                                $imagePath = "../../db/complaints_evidence/{$complaint['evidence']}";
                                                if (file_exists($imagePath)) {
                                                    $imageData = base64_encode(file_get_contents($imagePath));
                                                    $imageMimeType = mime_content_type($imagePath);
                                                    $imageSrc = "data:$imageMimeType;base64,$imageData";
                                                } else {
                                                    $imageSrc = ''; 
                                                }
                                                $decryptedEmail = decryptData($complaint['resident_email']);
                                            ?>
                                            <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['case_type']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['incident_place']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['date_filed']); ?></td>
                                            <td id="status-<?php echo htmlspecialchars($complaint['complaint_id']); ?>">
                                                <?php echo htmlspecialchars($complaint['status']); ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <a href="#" class="btn btn-primary btn-sm me-2" onclick="showDetails(
                                                                            '<?= htmlspecialchars($complaint['resident_name'])?>',
                                                                            '<?= htmlspecialchars($decryptedEmail)?>',
                                                                            '<?= htmlspecialchars($complaint['respondent_name'])?>',
                                                                            '<?= htmlspecialchars($complaint['respondent_age'])?>',
                                                                            '<?= htmlspecialchars($complaint['respondent_gender'])?>',
                                                                            '<?= htmlspecialchars($complaint['incident_date'])?>',
                                                                            '<?= htmlspecialchars($complaint['incident_time'])?>',
                                                                            '<?= htmlspecialchars($complaint['incident_place'])?>',
                                                                            '<?= htmlspecialchars($complaint['narrative'])?>',
                                                                            '<?= $imageSrc ?>')">
                                                        <i class="bi bi-eye"></i> </a>
                                                    <button class="btn btn-success btn-sm me-2" onclick="approve_complaint('<?= htmlspecialchars($complaint['complaint_id']) ?>')">
                                                        <i class="bi bi-check-circle"></i> 
                                                    </button>
                                                    <button class="btn btn-danger btn-sm me-2" onclick="reject_complaint('<?= htmlspecialchars($complaint['complaint_id']) ?>')">
                                                        <i class="bi bi-x-circle"></i> 
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No pending complaints found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="pagination-container">
                            <nav id="pendingPagination" aria-label="Pending complaints pagination">
                                <ul class="pagination justify-content-center">
                                    <?php
                                        $total_pages = $total_pending_pages; 
                                        $range = 1; 

                                        $start_page = max(1, $pendingPage - $range);
                                        $end_page = min($total_pages, $pendingPage + $range);

                                        if ($end_page - $start_page < 2) {
                                            $start_page = max(1, $end_page - 2);
                                            $end_page = min($total_pages, $start_page + 2);
                                        }
                                    ?>

                                    <?php if ($pendingPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=pending&pendingPage=1&searchTerm=<?php echo urlencode($searchTerm); ?>">First</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($pendingPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=pending&pendingPage=<?php echo $pendingPage - 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><<</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="page-item<?php if ($i == $pendingPage) echo ' active'; ?>">
                                            <a class="page-link" href="?status=pending&pendingPage=<?php echo $i; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($pendingPage < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=pending&pendingPage=<?php echo $pendingPage + 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">>></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($pendingPage < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=pending&pendingPage=<?php echo $total_pages; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">Last</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div id="approvedContainer" style="display: none;">
                        <table id="approvedTable" class="table mx-auto" cellspacing="0" cellpadding="0">
                            <thead style="background-color: #3AC430;">
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
                            <tbody class="scrollable-table-body">
                            <?php if (!empty($approvedComplaints)): ?>
                                <?php foreach ($approvedComplaints as $complaint): ?>
                                    <tr>
                                        <?php
                                            $imagePath = "../../db/complaints_evidence/{$complaint['evidence']}";
                                            if (file_exists($imagePath)) {
                                                $imageData = base64_encode(file_get_contents($imagePath));
                                                $imageMimeType = mime_content_type($imagePath);
                                                $imageSrc = "data:$imageMimeType;base64,$imageData";
                                            } else {
                                                $imageSrc = ''; 
                                            }
                                            $decryptedEmail = decryptData($complaint['resident_email']);
                                        ?>
                                        <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                                        <td><?php echo htmlspecialchars($complaint['case_type']); ?></td>
                                        <td><?php echo htmlspecialchars($complaint['incident_place']); ?></td>
                                        <td><?php echo htmlspecialchars($complaint['date_filed']); ?></td>
                                        <td id="status-<?php echo htmlspecialchars($complaint['complaint_id']); ?>">
                                            <?php echo htmlspecialchars($complaint['status']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($complaint['remarks']); ?></td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <a href="#" class="btn btn-primary btn-sm me-2" onclick="showDetails(
                                                                        '<?= htmlspecialchars($complaint['resident_name'])?>',
                                                                        '<?= htmlspecialchars($decryptedEmail)?>',
                                                                        '<?= htmlspecialchars($complaint['respondent_name'])?>',
                                                                        '<?= htmlspecialchars($complaint['respondent_age'])?>',
                                                                        '<?= htmlspecialchars($complaint['respondent_gender'])?>',
                                                                        '<?= htmlspecialchars($complaint['incident_date'])?>',
                                                                        '<?= htmlspecialchars($complaint['incident_time'])?>',
                                                                        '<?= htmlspecialchars($complaint['incident_place'])?>',
                                                                        '<?= htmlspecialchars($complaint['narrative'])?>',
                                                                        '<?= $imageSrc ?>')">
                                                    <i class="bi bi-eye"></i> </a>
                                                    <?php
                                                        $disabled = ($complaint['remarks'] === 'CASE CLOSED') ? 'disabled' : '';
                                                    ?>
                                                    <button class="btn btn-danger btn-sm me-2" onclick="closeCase('<?= htmlspecialchars($complaint['complaint_id']) ?>')" <?= $disabled ?>>
                                                        <i class="bi bi-x-octagon"></i>
                                                    </button>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No approved complaints found.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="pagination-container">
                            <nav id="approvedPagination" aria-label="Approved complaints pagination">
                                <ul class="pagination justify-content-center">
                                    <?php
                                        $total_pages = $total_approved_pages; 
                                        $range = 1; 

                                        $start_page = max(1, $approvedPage - $range);
                                        $end_page = min($total_pages, $approvedPage + $range);

                                        if ($end_page - $start_page < 2) {
                                            $start_page = max(1, $end_page - 2);
                                            $end_page = min($total_pages, $start_page + 2);
                                        }
                                    ?>

                                    <?php if ($approvedPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=approved&approvedPage=1&searchTerm=<?php echo urlencode($searchTerm); ?>">First</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($approvedPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="status=approved&approvedPage=<?php echo $approvedPage - 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><<</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="page-item<?php if ($i == $approvedPage) echo ' active'; ?>">
                                            <a class="page-link" href="?status=approved&approvedPage=<?php echo $i; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($approvedPage < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=approved&approvedPage=<?php echo $approvedPage + 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">>></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($approvedPage < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=approved&approvedPage=<?php echo $total_pages; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">Last</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div id="rejectedContainer" style="display: none;">
                        <table id="rejectedTable" class="table mx-auto" cellspacing="0" cellpadding="0">
                            <thead style="background-color: #D11313;">
                                <tr>
                                    <th>Case ID</th>
                                    <th>Case Type</th>
                                    <th>Place of Incident</th>
                                    <th>Date/Time Reported</th>
                                    <th>Status</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody class="scrollable-table-body">
                            <?php if (!empty($rejectedComplaints)): ?>
                                <?php foreach ($rejectedComplaints as $complaint): ?>
                                    <tr>
                                            <?php
                                                $imagePath = "../../db/complaints_evidence/{$complaint['evidence']}";
                                                if (file_exists($imagePath)) {
                                                    $imageData = base64_encode(file_get_contents($imagePath));
                                                    $imageMimeType = mime_content_type($imagePath);
                                                    $imageSrc = "data:$imageMimeType;base64,$imageData";
                                                } else {
                                                    $imageSrc = ''; 
                                                }
                                                $decryptedEmail = decryptData($complaint['resident_email']);
                                            ?>
                                            <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['case_type']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['incident_place']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['date_filed']); ?></td>
                                            <td id="status-<?php echo htmlspecialchars($complaint['complaint_id']); ?>">
                                                <?php echo htmlspecialchars($complaint['status']); ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <a href="#" class="btn btn-primary btn-sm me-2" onclick="showDetails(
                                                                            '<?= htmlspecialchars($complaint['resident_name'])?>',
                                                                            '<?= htmlspecialchars($decryptedEmail)?>',
                                                                            '<?= htmlspecialchars($complaint['respondent_name'])?>',
                                                                            '<?= htmlspecialchars($complaint['respondent_age'])?>',
                                                                            '<?= htmlspecialchars($complaint['respondent_gender'])?>',
                                                                            '<?= htmlspecialchars($complaint['incident_date'])?>',
                                                                            '<?= htmlspecialchars($complaint['incident_time'])?>',
                                                                            '<?= htmlspecialchars($complaint['incident_place'])?>',
                                                                            '<?= htmlspecialchars($complaint['narrative'])?>',
                                                                            '<?= $imageSrc ?>')">
                                                        <i class="bi bi-eye"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No rejected complaints found.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="pagination-container">
                            <nav id="rejectedPagination" aria-label="Rejected complaints pagination">
                                <ul class="pagination justify-content-center">
                                <?php
                                        $total_pages = $total_rejected_pages; 
                                        $range = 1; 

                                        $start_page = max(1, $rejectedPage - $range);
                                        $end_page = min($total_pages, $rejectedPage + $range);

                                        if ($end_page - $start_page < 2) {
                                            $start_page = max(1, $end_page - 2);
                                            $end_page = min($total_pages, $start_page + 2);
                                        }
                                    ?>

                                    <?php if ($rejectedPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=rejected&rejectedPage=1&searchTerm=<?php echo urlencode($searchTerm); ?>">First</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($rejectedPage > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="status=rejected&rejectedPage=<?php echo $rejectedPage - 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><<</a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                        <li class="page-item<?php if ($i == $rejectedPage) echo ' active'; ?>">
                                            <a class="page-link" href="?status=rejected&rejectedPage=<?php echo $i; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($rejectedPage < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=rejected&rejectedPage=<?php echo $rejectedPage + 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">>></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if ($rejectedPage < $total_pages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="?status=rejected&rejectedPage=<?php echo $total_pages; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">Last</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/complaints_popUp.js"></script>
    <script src="../js/sort_complaints.js"></script>
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("7RJucdkATYmD5Iu8F"); // Replace with your actual EmailJS public key
        })();
    </script>

    <?php require_once 'footerAdmin.php'; ?>