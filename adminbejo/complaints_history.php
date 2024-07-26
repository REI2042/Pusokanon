<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    $caseType = isset($_GET['case_type']) ? $_GET['case_type'] : '';
    $incidentPlace = isset($_GET['incident_place']) ? $_GET['incident_place'] : '';
    $searchTerm = isset($_GET['searchTerm']) ? trim($_GET['searchTerm']) : '';
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    
    // Pagination settings
    $limit = 5; // Number of complaints per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Fetch complaints with pagination
    $complaints = fetchComplaintsHistory($pdo, $offset, $limit, $caseType, $incidentPlace, $status, $searchTerm);

    // Fetch total number of complaints for pagination calculation
    $totalComplaints = getTotalComplaints($pdo, $caseType, $incidentPlace, $status, $searchTerm);
    $totalPages = ceil($totalComplaints / $limit);

    // Pagination range
    $range = 1; // Number of pages to display around the current page
    $startPage = max(1, $page - $range);
    $endPage = min($totalPages, $page + $range);

    // Ensure there's at least 3 pages displayed if possible
    if ($endPage - $startPage < 2) {
        $startPage = max(1, $endPage - 2);
        $endPage = min($totalPages, $startPage + 2);
    };
    ?>
    
    <link rel="stylesheet" href="css/list.css">
    
    <div class="container-fluid">
        <h1>Complaints History</h1>
        <div class="mu-ds row d-flex justify-content-end mt-5 mb-3">
            <div class="col-12 col-md-9 d-flex justify-content-end align-items-center flex-wrap">
                <div class="dropdown me-2 mb-2 mb-md-0">
                    <button class="btn dropdown-toggle this-button" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Status
                    </button>
                    <div class="dropdown-menu" aria-labelledby="statusDropdown">
                        <a class="dropdown-item" data-status="" href="#">Show All</a>
                        <a class="dropdown-item" data-status="Approved" href="#">Approved</a>
                        <a class="dropdown-item" data-status="Rejected" href="#">Rejected</a>
                    </div>

                </div>
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
                        <a class="dropdown-item" data-case-type="Defamation" href="#">Defamation</a>
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
                    <table class="table mx-auto" cellspacing="0" cellpadding="0">
                        <thead style="background-color: #2260a7;">
                            <tr>
                                <th>Case ID</th>
                                <th>Case Type</th>
                                <th>Place of Incident</th>
                                <th>Date Closed</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody class="scrollable-table-body">
                            <?php if (!empty($complaints)): ?>
                                <?php foreach ($complaints as $complaint): ?>
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
                                        <td><?php echo htmlspecialchars($complaint['date_closed']); ?></td>
                                        <td id="status-<?php echo htmlspecialchars($complaint['complaint_id']); ?>">
                                            <?php echo htmlspecialchars($complaint['status']); ?>
                                        </td>
                                        <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <a href="#" class="text-primary" onclick="viewComment('<?= htmlspecialchars($complaint['comment']) ?>')">
                                                View Comment
                                            </a>
                                        </div>

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
                                    <td colspan="7" class="text-center">No complaints found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        <nav aria-label="Page navigation" class="mt-auto">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=1&caseType=<?php echo urlencode($caseType); ?>&incidentPlace=<?php echo urlencode($incidentPlace); ?>&status=<?php echo urlencode($status); ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">First</a>
                                    </li>
                                <?php endif; ?>

                                <!-- Previous Page Link -->
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&caseType=<?php echo urlencode($caseType); ?>&incidentPlace=<?php echo urlencode($incidentPlace); ?>&status=<?php echo urlencode($status); ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><<</a>
                                    </li>
                                <?php endif; ?>

                                <!-- Page Number Links -->
                                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                    <li class="page-item<?php if ($i == $page) echo ' active'; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>&caseType=<?php echo urlencode($caseType); ?>&incidentPlace=<?php echo urlencode($incidentPlace); ?>&status=<?php echo urlencode($status); ?>&searchTerm=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Page Link -->
                                <?php if ($page < $totalPages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&caseType=<?php echo urlencode($caseType); ?>&incidentPlace=<?php echo urlencode($incidentPlace); ?>&status=<?php echo urlencode($status); ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">>></a>
                                    </li>
                                <?php endif; ?>

                                <!-- Last Page Link -->
                                <?php if ($page < $totalPages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $totalPages; ?>&caseType=<?php echo urlencode($caseType); ?>&incidentPlace=<?php echo urlencode($incidentPlace); ?>&status=<?php echo urlencode($status); ?>&searchTerm=<?php echo urlencode($searchTerm); ?>">Last</a>
                                    </li>
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