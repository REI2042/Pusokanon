<?php
include 'headerAdmin.php';
include '../db/DBconn.php';

$caseType = isset($_GET['case_type']) ? $_GET['case_type'] : '';

// Fetch the total number of complaints based on the case type
$totalRequests = countTotalComplaints($pdo, $caseType);
$limit = 5;  // Number of complaints per page
$totalPages = ceil($totalRequests / $limit);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch the complaints for the current page based on the case type
$requests = fetchListofComplaints($pdo, $offset, $limit, $caseType);


?>
<link rel="stylesheet" href="css/list.css">

<div class="container-fluid">
    <h1>List of Complaints</h1>
    <div class="mu-ds row d-flex justify-content-end">
            <div class="col-12 col-md-5 d-flex justify-content-center align-items-center">
                <a class="btn dropdown-toggle" role="button" id="sitioDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sitio
                </a>
                <div class="dropdown-menu" aria-labelledby="sitioDropdown">
                    <a class="dropdown-item" value="Arca">Arca</a>
                    <a class="dropdown-item" value="Cemento">Cemento</a>
                    <a class="dropdown-item" value="Chumba-Chumba">Chumba-Chumba</a>
                    <a class="dropdown-item" value="Ibabao">Ibabao</a>
                    <a class="dropdown-item" value="Lawis">Lawis</a>
                    <a class="dropdown-item" value="Matumbo">Matumbo</a>
                    <a class="dropdown-item" value="Mustang">Mustang</a>
                    <a class="dropdown-item" value="New Lipata">New Lipata</a>
                    <a class="dropdown-item" value="San Roque">San Roque</a>
                    <a class="dropdown-item" value="Seabreeze">Seabreeze</a>
                    <a class="dropdown-item" value="Seaside">Seaside</a>
                    <a class="dropdown-item" value="Sewage">Sewage</a>
					<a class="dropdown-item" value="Sta. Maria">Sta. Maria</a>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="caseTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Case Type
                    </button>
                    <div class="dropdown-menu" aria-labelledby="caseTypeDropdown">
                        <a class="dropdown-item" data-case-type="" href="?case_type=">Show All</a>
                        <a class="dropdown-item" data-case-type="Bullying" href="?case_type=Bullying">Bullying</a>
                        <a class="dropdown-item" data-case-type="Damaging Properties" href="?case_type=Damaging Properties">Damaging Properties</a>
                        <a class="dropdown-item" data-case-type="Libel" href="?case_type=Libel">Libel</a>
                        <a class="dropdown-item" data-case-type="Physical Abuse" href="?case_type=Physical Abuse">Physical Abuse</a>
                        <a class="dropdown-item" data-case-type="Threat" href="?case_type=Threat">Threat</a>
                        <a class="dropdown-item" data-case-type="Trespassing" href="?case_type=Trespassing">Trespassing</a>
                        <a class="dropdown-item" data-case-type="Theft" href="?case_type=Theft">Theft</a>
                    </div>
                </div>  
                <input class="form-control" type="input" placeholder="Search Name" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">Search</button>
            </div>
        </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mx-auto" cellspacing="0" cellpadding="0">
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
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
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
                                        
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No complaints found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-5">
                <?php
                $startPage = max(1, $page - 1);
                $endPage = min($startPage + 2, $totalPages);
                $startPage = max(1, $endPage - 2);
                ?>

                <?php if($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page-1; ?>&case_type=<?php echo urlencode($caseType); ?>" aria-label="Previous">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&case_type=<?php echo urlencode($caseType); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page+1; ?>&case_type=<?php echo urlencode($caseType); ?>" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
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
