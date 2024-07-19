<?php
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    
    $caseType = isset($_GET['case_type']) ? $_GET['case_type'] : '';
    $incidentPlace = isset($_GET['incident_place']) ? $_GET['incident_place'] : '';
    $searchName = isset($_GET['searchTerm']) ? trim($_GET['searchTerm']) : '';

    $limit = 5; // Number of complaints per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Get the total count of complaints
    $totalRequests = getTotalComplaints($pdo, $caseType, $incidentPlace);
    $totalPages = ceil($totalRequests / $limit);

    // Ensure the page number is within the valid range
    if ($page > $totalPages) {
        $page = $totalPages;
        $offset = ($page - 1) * $limit;
    }

    // Get the complaints for the current page
    $requests = fetchListofComplaints($pdo, $offset, $limit, $caseType, $incidentPlace);

    // Separate requests by status
    $pendingRequests = array_filter($requests, function($request) {
        return $request['status'] == 'Pending';
    });
    $acceptedRequests = array_filter($requests, function($request) {
        return $request['status'] == 'Accepted';
    });
    $declinedRequests = array_filter($requests, function($request) {
        return $request['status'] == 'Declined';
    });
?>

    <link rel="stylesheet" href="css/list.css">

    <div class="container-fluid">
        <h1>List of Complaints</h1>
        <div class="mu-ds row d-flex justify-content-between align-items-center mt-5 mb-3">
            <div class="col-12 col-md-3 mb-2 mb-md-0">
                <button id="pendingBtn" class="btn btn-warning status-button me-2 active" type="button" onclick="showTable('pending')">Pending</button>
                <button id="acceptedBtn" class="btn btn-success status-button me-2" type="button" onclick="showTable('accepted')">Accepted</button>
                <button id="declinedBtn" class="btn btn-danger status-button" type="button" onclick="showTable('declined')">Declined</button>
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
                <form id="searchForm" method="GET" action="complaintsList.php" class="d-flex">
                    <input id="searchInput" name="searchTerm" class="form-control me-2" type="input" placeholder="Search Name" aria-label="Search">
                    <button id="searchButton" class="btn this-button" type="submit">Search</button>
                </form>
            </div>
        </div>
         
        <div class="card d-flex flex-column">
            <div class="card-body flex-grow-1 d-flex flex-column">
                <div class="table-responsive flex-grow-1">
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
                        <?php if (!empty($pendingRequests)): ?>
                            <?php foreach ($pendingRequests as $request): ?>
                                <tr>
                                    <?php
                                        $imagePath = "../../db/complaints_evidence/{$request['evidence']}";
                                        if (file_exists($imagePath)) {
                                            $imageData = base64_encode(file_get_contents($imagePath));
                                            $imageMimeType = mime_content_type($imagePath);
                                            $imageSrc = "data:$imageMimeType;base64,$imageData";
                                        } else {
                                            $imageSrc = ''; 
                                        }
                                        $decryptedEmail = decryptData($request['resident_email']);
                                    ?>
                                    <td><?php echo htmlspecialchars($request['complaint_id']); ?></td>
                                    <td><?php echo htmlspecialchars($request['case_type']); ?></td>
                                    <td><?php echo htmlspecialchars($request['incident_place']); ?></td>
                                    <td><?php echo htmlspecialchars($request['date_filed']); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($request['complaint_id']); ?>">
                                        <?php echo htmlspecialchars($request['status']); ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <a href="#" class="btn btn-primary btn-sm me-2" onclick="showDetails(
                                                                    '<?= htmlspecialchars($request['resident_name'])?>',
                                                                    '<?= htmlspecialchars($decryptedEmail)?>',
                                                                    '<?= htmlspecialchars($request['respondent_name'])?>',
                                                                    '<?= htmlspecialchars($request['respondent_age'])?>',
                                                                    '<?= htmlspecialchars($request['respondent_gender'])?>',
                                                                    '<?= htmlspecialchars($request['incident_date'])?>',
                                                                    '<?= htmlspecialchars($request['incident_time'])?>',
                                                                    '<?= htmlspecialchars($request['incident_place'])?>',
                                                                    '<?= htmlspecialchars($request['narrative'])?>',
                                                                    '<?= $imageSrc ?>')">
                                                <i class="fas fa-eye"></i> </a>
                                            <button class="btn btn-success btn-sm me-2" onclick="approve_complaint('<?= htmlspecialchars($request['complaint_id']) ?>')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm me-2" onclick="disapprove_complaint('<?= htmlspecialchars($request['complaint_id']) ?>')">
                                                <i class="fas fa-times"></i> 
                                            </button>
                                            <button class="btn btn-secondary btn-sm me-2" onclick="addRemarks('<?= htmlspecialchars($request['complaint_id']) ?>')">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No pending complaints found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    
                    <table id="acceptedTable" class="table mx-auto hidden" cellspacing="0" cellpadding="0">
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
                        <?php if (!empty($acceptedRequests)): ?>
                            <?php foreach ($acceptedRequests as $request): ?>
                                <tr>
                                    <?php
                                        $imagePath = "../../db/complaints_evidence/{$request['evidence']}";
                                        if (file_exists($imagePath)) {
                                            $imageData = base64_encode(file_get_contents($imagePath));
                                            $imageMimeType = mime_content_type($imagePath);
                                            $imageSrc = "data:$imageMimeType;base64,$imageData";
                                        } else {
                                            $imageSrc = ''; 
                                        }
                                        $decryptedEmail = decryptData($request['resident_email']);
                                    ?>
                                    <td><?php echo htmlspecialchars($request['complaint_id']); ?></td>
                                    <td><?php echo htmlspecialchars($request['case_type']); ?></td>
                                    <td><?php echo htmlspecialchars($request['incident_place']); ?></td>
                                    <td><?php echo htmlspecialchars($request['date_filed']); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($request['complaint_id']); ?>">
                                        <?php echo htmlspecialchars($request['status']); ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <a href="#" class="btn btn-primary btn-sm me-2" onclick="showDetails(
                                                                    '<?= htmlspecialchars($request['resident_name'])?>',
                                                                    '<?= htmlspecialchars($decryptedEmail)?>',
                                                                    '<?= htmlspecialchars($request['respondent_name'])?>',
                                                                    '<?= htmlspecialchars($request['respondent_age'])?>',
                                                                    '<?= htmlspecialchars($request['respondent_gender'])?>',
                                                                    '<?= htmlspecialchars($request['incident_date'])?>',
                                                                    '<?= htmlspecialchars($request['incident_time'])?>',
                                                                    '<?= htmlspecialchars($request['incident_place'])?>',
                                                                    '<?= htmlspecialchars($request['narrative'])?>',
                                                                    '<?= $imageSrc ?>')">
                                                <i class="fas fa-eye"></i> </a>
                                            <button class="btn btn-secondary btn-sm me-2" onclick="addRemarks('<?= htmlspecialchars($request['complaint_id']) ?>')">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No accepted complaints found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    
                    <table id="declinedTable" class="table mx-auto hidden" cellspacing="0" cellpadding="0">
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
                        <?php if (!empty($declinedRequests)): ?>
                            <?php foreach ($declinedRequests as $request): ?>
                                <tr>
                                    <?php
                                        $imagePath = "../../db/complaints_evidence/{$request['evidence']}";
                                        if (file_exists($imagePath)) {
                                            $imageData = base64_encode(file_get_contents($imagePath));
                                            $imageMimeType = mime_content_type($imagePath);
                                            $imageSrc = "data:$imageMimeType;base64,$imageData";
                                        } else {
                                            $imageSrc = ''; 
                                        }
                                        $decryptedEmail = decryptData($request['resident_email']);
                                    ?>
                                    <td><?php echo htmlspecialchars($request['complaint_id']); ?></td>
                                    <td><?php echo htmlspecialchars($request['case_type']); ?></td>
                                    <td><?php echo htmlspecialchars($request['incident_place']); ?></td>
                                    <td><?php echo htmlspecialchars($request['date_filed']); ?></td>
                                    <td id="status-<?php echo htmlspecialchars($request['complaint_id']); ?>">
                                        <?php echo htmlspecialchars($request['status']); ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <a href="#" class="btn btn-primary btn-sm me-2" onclick="showDetails(
                                                                    '<?= htmlspecialchars($request['resident_name'])?>',
                                                                    '<?= htmlspecialchars($decryptedEmail)?>',
                                                                    '<?= htmlspecialchars($request['respondent_name'])?>',
                                                                    '<?= htmlspecialchars($request['respondent_age'])?>',
                                                                    '<?= htmlspecialchars($request['respondent_gender'])?>',
                                                                    '<?= htmlspecialchars($request['incident_date'])?>',
                                                                    '<?= htmlspecialchars($request['incident_time'])?>',
                                                                    '<?= htmlspecialchars($request['incident_place'])?>',
                                                                    '<?= htmlspecialchars($request['narrative'])?>',
                                                                    '<?= $imageSrc ?>')">
                                                <i class="fas fa-eye"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No declined complaints found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation" class="mt-auto">
                    <ul class="pagination justify-content-center">
                        <?php
                        $startPage = max(1, $page - 1);
                        $endPage = min($startPage + 2, $totalPages);
                        $startPage = max(1, $endPage - 2);
                        ?>

                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>&case_type=<?php echo urlencode($caseType); ?>&searchTerm=<?php echo urlencode($searchName); ?>&incident_place=<?php echo urlencode($incidentPlace); ?>" aria-label="Previous">
                                    <span aria-hidden="true">Prev</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&case_type=<?php echo urlencode($caseType); ?>&searchTerm=<?php echo urlencode($searchName); ?>&incident_place=<?php echo urlencode($incidentPlace); ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>&case_type=<?php echo urlencode($caseType); ?>&searchTerm=<?php echo urlencode($searchName); ?>&incident_place=<?php echo urlencode($incidentPlace); ?>" aria-label="Next">
                                    <span aria-hidden="true">Next</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="../js/complaints_popUp.js"></script>
    <script src="../js/sort_complaints.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("7RJucdkATYmD5Iu8F"); // Replace with your actual EmailJS public key
        })();
    </script>
   <?php include 'footerAdmin.php'; ?>