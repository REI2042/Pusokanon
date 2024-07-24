    <?php
        include 'headerAdmin.php';
        include '../db/DBconn.php';

        
        // Retrieve query parameters
        $caseType = isset($_GET['case_type']) ? $_GET['case_type'] : '';
        $incidentPlace = isset($_GET['incident_place']) ? $_GET['incident_place'] : '';
        $searchTerm = isset($_GET['searchTerm']) ? trim($_GET['searchTerm']) : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        // Fetch counts for each status
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM complaints_tbl WHERE status = 'Pending'");
        $stmt->execute();
        $num_pendingComplaints = $stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM complaints_tbl WHERE status = 'Approved'");
        $stmt->execute();
        $num_approvedComplaints = $stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM complaints_tbl WHERE status = 'Rejected'");
        $stmt->execute();
        $num_rejectedComplaints = $stmt->fetchColumn();

        $limit = 5; // Number of complaints per page

        // Total number of pages available for Pending, Approved, and Rejected
        $num_pendingPage = ceil($num_pendingComplaints / $limit);
        $num_approvedPage = ceil($num_approvedComplaints / $limit);
        $num_rejectedPage = ceil($num_rejectedComplaints / $limit);

        // Determine which page number visitor is currently on
        $pendingPage = isset($_GET['pendingPage']) ? (int)$_GET['pendingPage'] : 1;
        $approvedPage = isset($_GET['approvedPage']) ? (int)$_GET['approvedPage'] : 1;
        $rejectedPage = isset($_GET['rejectedPage']) ? (int)$_GET['rejectedPage'] : 1;

        // Ensure the page number is within the valid range
        $pendingPage = max(1, min($pendingPage, $num_pendingPage));
        $approvedPage = max(1, min($approvedPage, $num_approvedPage));
        $rejectedPage = max(1, min($rejectedPage, $num_rejectedPage));

        // Determine the SQL LIMIT starting number for the results on the displaying page
        $pending_offset = ($pendingPage - 1) * $limit;
        $approved_offset = ($approvedPage - 1) * $limit;
        $rejected_offset = ($rejectedPage - 1) * $limit;

        // Retrieve the data to display for the current page
        $pendingComplaints = fetchListofComplaints($pdo, $pending_offset, $limit, $caseType, $incidentPlace, 'Pending', $searchTerm);
        $approvedComplaints = fetchListofComplaints($pdo, $approved_offset, $limit, $caseType, $incidentPlace, 'Approved', $searchTerm);
        $rejectedComplaints = fetchListofComplaints($pdo, $rejected_offset, $limit, $caseType, $incidentPlace, 'Rejected', $searchTerm);

    ?>

        <link rel="stylesheet" href="css/list.css">

        <div class="container-fluid">
        <h1>List of Complaints</h1>
        <div class="mu-ds row d-flex justify-content-between align-items-center mt-5 mb-3">
            <div class="col-12 col-md-3 mb-2 mb-md-0">
                <button id="pendingBtn" class="btn btn-warning status-button me-2 active" type="button" onclick="showTable('pending')">Pending</button>
                <button id="approvedBtn" class="btn btn-success status-button me-2" type="button" onclick="showTable('approved')">Approved</button>
                <button id="rejectedBtn" class="btn btn-danger status-button" type="button" onclick="showTable('rejected')">Rejected</button>
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
                        <a class="dropdown-item" data-case-type="Libel" href="#">Libel</a>
                        <a class="dropdown-item" data-case-type="Physical Abuse" href="#">Physical Abuse</a>
                        <a class="dropdown-item" data-case-type="Threat" href="#">Threat</a>
                        <a class="dropdown-item" data-case-type="Trespassing" href="#">Trespassing</a>
                        <a class="dropdown-item" data-case-type="Theft" href="#">Theft</a>
                    </div>
                </div>
                <form method="GET" class="d-flex">
                    <input name="searchTerm" class="form-control me-2" type="input" placeholder="Search name" aria-label="Search name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button class="btn this-button" type="submit">Search</button>
                </form>
            </div>
        </div>

        <div id="results" class="card d-flex flex-column">
            <div class="card-body flex-grow-1 d-flex flex-column">
                <div class="table-responsive flex-grow-1">
                    <!-- Pending Complaints Table -->
                    <div id="pendingContainer">
                        <table id="pendingTable" class="table mx-auto" cellspacing="0" cellpadding="0">
                            <thead>
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
                                                        <i class="fas fa-eye"></i> </a>
                                                    <button class="btn btn-success btn-sm me-2" onclick="approve_complaint('<?= htmlspecialchars($complaint['complaint_id']) ?>')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm me-2" onclick="reject_complaint('<?= htmlspecialchars($complaint['complaint_id']) ?>')">
                                                        <i class="fas fa-times"></i> 
                                                    </button>
                                                    <button class="btn btn-secondary btn-sm me-2" onclick="addRemarks('<?= htmlspecialchars($complaint['complaint_id']) ?>')">
                                                        <i class="fas fa-pencil-alt"></i>
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
                        <!-- Pending Complaints Pagination -->
                        <nav id="pendingPagination" aria-label="Pending complaints pagination">
                            <ul class="pagination justify-content-center">
                                <?php if ($pendingPage > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?status=pending&pendingPage=<?php echo $pendingPage - 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">Prev</a></li>                            <?php endif; ?>
                                <?php for ($i = 1; $i <= $num_pendingPage; $i++): ?>
                                    <li class="page-item<?php if ($i == $pendingPage) echo ' active'; ?>"><a class="page-link" href="?status=pending&pendingPage=<?php echo $i; ?>; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a></li>
                                <?php endfor; ?>
                                <?php if ($pendingPage < $num_pendingPage): ?>
                                    <li class="page-item"><a class="page-link" href="?status=pending&pendingPage=<?php echo $pendingPage + 1; ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">Next</a></li>                            <?php endif; ?>
                            </ul>
                        </nav>
                    </div>

                    <!-- Approved Complaints Table -->
                    <div id="approvedContainer" style="display: none;">
                        <table id="approvedTable" class="table mx-auto" cellspacing="0" cellpadding="0">
                            <thead>
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
                                                        <i class="fas fa-eye"></i> </a>
                                                    <button class="btn btn-warning btn-sm me-2" onclick="addRemarks('<?= htmlspecialchars($request['complaint_id']) ?>')">
                                                        <i class="fas fa-pencil-alt"></i>
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
                        <!-- Approved Complaints Pagination -->
                        <nav id="approvedPagination" aria-label="Approved complaints pagination">
                            <ul class="pagination justify-content-center">
                                <?php if ($approvedPage > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?status=approved&approvedPage=<?php echo $approvedPage - 1; ?>">Previous</a></li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $num_approvedPage; $i++): ?>
                                    <li class="page-item<?php if ($i == $approvedPage) echo ' active'; ?>"><a class="page-link" href="?status=approved&approvedPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php endfor; ?>
                                <?php if ($approvedPage < $num_approvedPage): ?>
                                    <li class="page-item"><a class="page-link" href="?status=approved&approvedPage=<?php echo $approvedPage + 1; ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>

                    <!-- Rejected Complaints Table -->
                    <div id="rejectedContainer" style="display: none;">
                        <table id="rejectedTable" class="table mx-auto" cellspacing="0" cellpadding="0">
                            <thead>
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
                                                        <i class="fas fa-eye"></i> </a>
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
                        <!-- Rejected Complaints Pagination -->
                        <nav id="rejectedPagination" aria-label="Rejected complaints pagination">
                            <ul class="pagination justify-content-center">
                                <?php if ($rejectedPage > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?status=rejected&rejectedPage=<?php echo $rejectedPage - 1; ?>">Previous</a></li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $num_rejectedPage; $i++): ?>
                                    <li class="page-item<?php if ($i == $rejectedPage) echo ' active'; ?>"><a class="page-link" href="?status=rejected&rejectedPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php endfor; ?>
                                <?php if ($rejectedPage < $num_rejectedPage): ?>
                                    <li class="page-item"><a class="page-link" href="?status=rejected&rejectedPage=<?php echo $rejectedPage + 1; ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
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