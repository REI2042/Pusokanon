<?php
    include 'include/header.php';
    include 'db/DBconn.php';
    
	
    $userId = $_SESSION['res_ID'];
    $suffix = isset($_SESSION['res_suffix']) ? $_SESSION['res_suffix'] : '';
    $fullName = trim($_SESSION['res_fname'] . ' ' . $_SESSION['res_midname'] . ' ' . $_SESSION['res_lname'] . ' ' . $suffix);

    $birthdateStr = $_SESSION['birth_date'];
    $birthdate = DateTime::createFromFormat('Y-m-d', $birthdateStr);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;

    $status = isset($_GET['status']) ? $_GET['status'] : 'pending';
    $perPage = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $offset = ($page - 1) * $perPage;

    $requests = fetchResdocsRequest($pdo, $userId, $status, $perPage, $offset);
    $totalRequests = countResdocsRequest($pdo, $userId, $status);

    $totalPages = ceil($totalRequests / $perPage);

    $complaintsPerPage = 5;
    $complaintsPage = isset($_GET['complaints_page']) ? (int)$_GET['complaints_page'] : 1;
    $complaintsOffset = ($complaintsPage - 1) * $complaintsPerPage;
    
    $complaints = fetchComplaints($pdo, $userId, $complaintsPerPage, $complaintsOffset);
    $totalComplaints = countComplaints($pdo, $userId);

    $totalComplaintPages = ceil($totalComplaints / $complaintsPerPage);

    $birthdate = $_SESSION['birth_date'];
    $date = DateTime::createFromFormat('Y-m-d', $birthdate);
    $formattedBirthdate = $date->format('F j, Y');

    $activeTab = isset($_GET['active_tab']) ? $_GET['active_tab'] : 'document-requests';
    
?>
<link rel="stylesheet" href="css/Profile.css">
<section class="main">
    <div class="row">
        <div class="col-12 col-sm-5 p-3">
            <div class="profile-box">
                <div class="row p-3 m-0">
                    <div class="profile-information my-3">
                        <img src="<?php echo $profilePicture ? 'db/ProfilePictures/' . htmlspecialchars($profilePicture) : 'PicturesNeeded/blank_profile.png'; ?>" class="profile-picture" alt="Profile Picture"/>
                        <div class="">
                            <p class="name"><?= htmlspecialchars($fullName); ?></p>
                            <p class="gender"><?= htmlspecialchars($_SESSION['gender']); ?></p>
                            <p class="age"><?= htmlspecialchars($age); ?></p>
                            <p class="voter"><?= htmlspecialchars($_SESSION['registered_voter']); ?> Voter</p>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 px-4">
                    <div class="additional-information">
                        <p>Birthday: <?= htmlspecialchars($formattedBirthdate); ?></p>
                        <p>Contact Number: <?= htmlspecialchars($_SESSION['contact_no']); ?></p>
                        <p>Civil Status: <?= htmlspecialchars($_SESSION['civil_status']); ?></p>
                        <p>Citizenship: <?= htmlspecialchars($_SESSION['citizenship']); ?></p>
                        <p>Place of Birth: <?= htmlspecialchars($_SESSION['place_birth']); ?></p>
                        <p>Address: <?= htmlspecialchars($_SESSION['addr_sitio']); ?> Barangay Pusok, Lapu - Lapu City</span></p>
                        <p>Email Address: <?= htmlspecialchars($_SESSION['res_email']); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="buttons text-center my-3">
                        <a href="ChangePassword.php"><button class="change-button">Change Password</button></a>
                        <a href="EditProfile.php"><button class="edit-button">Edit Profile</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 p-3">
            <div class="request-box p-3">
                <div class="row">
                    <div class="buttons text-center mt-3">
                        <button class="btn request-button <?php echo $activeTab === 'document-requests' ? 'active' : ''; ?>" data-target="document-requests">Your Document Request(s)</button>
                        <button class="btn complaints-button <?php echo $activeTab === 'complaints' ? 'active' : ''; ?>" data-target="complaints">Your Complaint(s)</button>
                    </div>
                </div>
                
                <div id="document-requests" style="display: <?php echo $activeTab === 'document-requests' ? 'block' : 'none'; ?>">
                    <div class="row text-center align-items-center my-3">
                        <div class="col-6 col-sm-4">
                            <a href="?status=pending" class="pending-button <?php echo $status === 'pending' ? 'active' : ''; ?>">Pending</a>
                        </div>
                        <div class="col-6 col-sm-4">
                            <a href="?status=processing" class="processing-button <?php echo $status === 'processing' ? 'active' : ''; ?>">Processing</a>
                        </div>
                        <div class="col-12 col-sm-4">
                            <a href="?status=Ready to Pick Up" class="ready-button <?php echo $status === 'Ready to Pick Up' ? 'active' : ''; ?>">Ready to Pick-up</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover status-<?php echo $status; ?>">
                            <thead>
                                <tr>
                                    <th scope="col">Document ID</th>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date Requested</th>
                                    <th scope="col">Purpose</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($requests)): ?>
                                    <tr><td colspan="6" class="text-center">No records found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($requests as $request): 
                                        $dateRequested = DateTime::createFromFormat('Y-m-d H:i:s', $request['date_req']);
                                        $formattedDateRequested = $dateRequested ? $dateRequested->format('F j, Y') : 'N/A';
                                    ?>
                                        <tr class="clickable-row" data-doc-id="<?php echo htmlspecialchars($request['doc_ID']); ?>"
                                            data-doc-name="<?php echo htmlspecialchars($request['document_name']); ?>"
                                            data-status="<?php echo htmlspecialchars($request['stat']); ?>"
                                            data-date-req="<?php echo htmlspecialchars($request['date_req']); ?>"
                                            data-remarks="<?php echo htmlspecialchars($request['remarks']); ?>"
                                            data-purpose="<?php echo htmlspecialchars($request['purpose_name']); ?>"
                                            data-qr-code="<?php echo htmlspecialchars($request['qrCode_image']); ?>"
                                            data-price="<?php echo htmlspecialchars($request['document_price']); ?>">
                                            <td><?php echo htmlspecialchars($request['doc_ID']); ?></td>
                                            <td><?php echo htmlspecialchars($request['document_name']); ?></td>
                                            <td><?php echo htmlspecialchars($request['stat']); ?></td>
                                            <td><?php echo htmlspecialchars($formattedDateRequested); ?></td>
                                            <td><?php echo htmlspecialchars($request['purpose_name']); ?></td>
                                            <td>₱ <?php echo htmlspecialchars($request['document_price']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Document requests page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?status=<?php echo $status; ?>&page=1" aria-label="First">
                                        <span aria-hidden="true">First</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?status=<?php echo $status; ?>&page=<?php echo $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = max(1, $page - 1); $i <= min($totalPages, $page + 1); $i++): ?>
                                <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?status=<?php echo $status; ?>&page=<?php echo $i; ?>&active_tab=document-requests">
                                    <?php echo $i; ?>
                                </a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?status=<?php echo $status; ?>&page=<?php echo $page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?status=<?php echo $status; ?>&page=<?php echo $totalPages; ?>" aria-label="Last">
                                        <span aria-hidden="true">Last</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>

                <div id="complaints" style="display: <?php echo $activeTab === 'complaints' ? 'block' : 'none'; ?>">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Complaint ID</th>
                                    <th scope="col">Case Type</th>
                                    <th scope="col">Place of Incident</th>
                                    <th scope="col">Incident Date</th>
                                    <th scope="col">Incident Time </th>
                                    <th scope="col">Date Reported</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($complaints)): ?>
                                    <tr><td colspan="6" class="text-center">No records found.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($complaints as $complaint): ?>
                                        <tr class="clickable-complaint" 
                                            data-complaint-id="<?php echo htmlspecialchars($complaint['complaint_id']); ?>"
                                            data-respondent-name="<?php echo htmlspecialchars($complaint['respondent_fname'] . ' ' . $complaint['respondent_lname']); ?>"
                                            data-respondent-gender="<?php echo htmlspecialchars($complaint['respondent_gender']); ?>"
                                            data-respondent-age="<?php echo htmlspecialchars($complaint['respondent_age']); ?>"
                                            data-narrative="<?php echo htmlspecialchars($complaint['narrative']); ?>">
                                            <td><?php echo htmlspecialchars($complaint['complaint_id']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['case_type']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['incident_place']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['incident_date']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['incident_time']); ?></td>
                                            <td><?php echo htmlspecialchars($complaint['date_filed']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Complaints page navigation">
                        <ul class="pagination justify-content-center">
                            <?php if ($complaintsPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?complaints_page=1&active_tab=complaints" aria-label="First">
                                        <span aria-hidden="true">First</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?complaints_page=<?php echo $complaintsPage - 1; ?>&active_tab=complaints" aria-label="Previous">
                                        <span aria-hidden="true">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = max(1, $complaintsPage - 1); $i <= min($totalComplaintPages, $complaintsPage + 1); $i++): ?>
                                <li class="page-item <?php echo $i === $complaintsPage ? 'active' : ''; ?>">
                                    <a class="page-link" href="?complaints_page=<?php echo $i; ?>&active_tab=complaints">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($complaintsPage < $totalComplaintPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?complaints_page=<?php echo $complaintsPage + 1; ?>&active_tab=complaints" aria-label="Next">
                                        <span aria-hidden="true">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?complaints_page=<?php echo $totalComplaintPages; ?>&active_tab=complaints" aria-label="Last">
                                        <span aria-hidden="true">Last</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/Profile.js"></script>
<?php include 'include/footer.php'; ?>