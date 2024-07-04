<?php
    include 'include/header.php';
    include 'db/DBconn.php';
    

    $userId = $_SESSION['res_ID'];
    $profilePicture = fetchProfilePicture($pdo, $userId);
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

    $birthdate = $_SESSION['birth_date'];
    $date = DateTime::createFromFormat('Y-m-d', $birthdate);
    $formattedBirthdate = $date->format('F j, Y');
    
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
                        <button class="change-button">Change Password</button>
                        <button class="edit-button">Edit Profile</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-7 p-3">
            <div class="request-box p-3">
                <div class="row">
                    <div class="buttons text-center my-3">
                        <a href="?status=pending" class="btn pending-button <?php echo $status === 'pending' ? 'active' : ''; ?>">Pending</a>
                        <a href="?status=processing" class="btn processing-button <?php echo $status === 'processing' ? 'active' : ''; ?>">Processing</a>
                        <a href="?status=ready" class="btn ready-button <?php echo $status === 'ready' ? 'active' : ''; ?>">Ready to Pick-up</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Document ID</th>
                                <th scope="col">Document Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date & Time Requested</th>
                                <th scope="col">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($requests)): ?>
                                <tr><td colspan="5" class="text-center">No records found.</td></tr>
                            <?php else: ?>
                                <?php foreach ($requests as $request): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($request['doc_ID']); ?></td>
                                        <td><?php echo htmlspecialchars($request['document_name']); ?></td>
                                        <td><?php echo htmlspecialchars($request['stat']); ?></td>
                                        <td><?php echo htmlspecialchars($request['date_req']); ?></td>
                                        <td><?php echo htmlspecialchars($request['remarks']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation">
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

                        <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                            <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?status=<?php echo $status; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>