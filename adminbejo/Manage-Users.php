<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

    $gender = isset($_GET['gender']) ? $_GET['gender'] : null;
    $ageRange = isset($_GET['age_range']) ? $_GET['age_range'] : null;
    $sitio = isset($_GET['sitio']) ? $_GET['sitio'] : null;
    $accountStatus = isset($_GET['account_status']) ? $_GET['account_status'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

    $total_users = fetchTotalResidents($pdo);
    $total_males = fetchTotalMales($pdo);
    $total_females = fetchTotalFemales($pdo);
    $registered_voters = fetchRegisteredVoters($pdo);
    $non_registered_voters = fetchNonRegisteredVoters($pdo);

    $records_per_page = 5;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $records_per_page;

    if ($search) {
        $users = fetchResidentById($pdo, $search);
        $total_records = count($users);
    } else {
        $total_records = fetchTotalResidentsWithFilters($pdo, $gender, $ageRange, $sitio, $accountStatus);
        $users = fetchResident($pdo, $records_per_page, $offset, $gender, $ageRange, $sitio, $accountStatus);
    }

    $total_pages = ceil($total_records / $records_per_page);

?>  
<link rel="stylesheet" href="css/Manage-Users.css">
<section class="main">
    <div class="row mx-0">
        <h1 class="title text-center">Manage Resident Users</h1>
        <div class="col-12 mb-3">
            <div class="record-container row g-1">
                <div class="record-box col-12 col-sm">
                    <div class="text-center">
                        <h1 class="record-title">Total Registered Residents</h1>
                        <p class="record-count"><?php echo "$total_users"; ?></p>
                    </div>
                </div>
                <div class="record-box col-6 col-sm">
                    <div class="text-center">
                        <h1 class="record-title">Number of Males</h1>
                        <p class="record-count"><?php echo "$total_males"; ?></p>
                    </div>
                </div>
                <div class="record-box col-6 col-sm">
                    <div class=" text-center">
                        <h1 class="record-title">Number of Females</h1>
                        <p class="record-count"><?php echo "$total_females"; ?></p>
                    </div>
                </div>
                <div class="record-box col-6 col-sm">
                    <div class="text-center">
                        <h1 class="record-title" >Total Registered Voters</h1>
                        <p class="record-count"><?php echo "$registered_voters"; ?></p>
                    </div>
                </div>
                <div class="record-box col-6 col-sm">
                    <div class="text-center align-items-center">
                        <h1 class="record-title" >Total Non-Voters</h1>
                        <p class="record-count"><?php echo "$non_registered_voters"; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-1 justify-content-end">
        <div class="dropdown-container col-12 col-sm-6">
            <div class="row mx-0">
                <div class="col-6 col-sm d-flex justify-content-center align-self-center">
                    <div class="dropdown">
                        <button class="account-status btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account Status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item <?php echo $accountStatus == 'All' || $accountStatus == '' ? 'active' : ''; ?>" href="?account_status=All<?php echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">All</a>
                            <a class="dropdown-item <?php echo $accountStatus == 'Active' ? 'active' : ''; ?>" href="?account_status=Active<?php echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Active</a>
                            <a class="dropdown-item <?php echo $accountStatus == 'Deactivated' ? 'active' : ''; ?>" href="?account_status=Deactivated<?php echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Deactivated</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm d-flex justify-content-center align-self-center">
                    <div class="dropdown">
                        <button class="gender btn dropdown-toggle" type="button" id="genderDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gender
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item <?php echo $gender == 'All' || $gender == '' ? 'active' : ''; ?>" href="?gender=All<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">All</a>
                            <a class="dropdown-item <?php echo $gender == 'Male' ? 'active' : ''; ?>" href="?gender=Male<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Male</a>
                            <a class="dropdown-item <?php echo $gender == 'Female' ? 'active' : ''; ?>" href="?gender=Female<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Female</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm d-flex justify-content-center my-1 my-sm-0 align-self-center">
                    <div class="dropdown">
                        <button class="age btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Age
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item <?php echo $ageRange == 'All' || $ageRange == '' ? 'active' : ''; ?>" href="?age_range=All<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">All</a>
                            <a class="dropdown-item <?php echo $ageRange == 'Young Adults (18-24)' ? 'active' : ''; ?>" href="?age_range=Young Adults (18-24)<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Young Adults (18-24)</a>
                            <a class="dropdown-item <?php echo $ageRange == 'Adults (25-39)' ? 'active' : ''; ?>" href="?age_range=Adults (25-39)<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Adults (25-39)</a>
                            <a class="dropdown-item <?php echo $ageRange == 'Middle-Aged (40-59)' ? 'active' : ''; ?>" href="?age_range=Middle-Aged (40-59)<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Middle-Aged (40-59)</a>
                            <a class="dropdown-item <?php echo $ageRange == 'Seniors (60 and Over)' ? 'active' : ''; ?>" href="?age_range=Seniors (60 and Over)<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($sitio) ? "&sitio=$sitio" : ""; ?>">Seniors (60 and Over)</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm d-flex justify-content-center my-1 my-sm-0 align-self-center">
                    <div class="dropdown">
                        <button class="sitio btn dropdown-toggle" type="button" id="sitioDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sitio
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item <?php echo $sitio == 'All' || $sitio == '' ? 'active' : ''; ?>" href="?sitio=All<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">All</a>
                            <a class="dropdown-item <?php echo $sitio == 'Arca' ? 'active' : ''; ?>" href="?sitio=Arca<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Arca</a>
                            <a class="dropdown-item <?php echo $sitio == 'Cemento' ? 'active' : ''; ?>" href="?sitio=Cemento<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Cemento</a>
                            <a class="dropdown-item <?php echo $sitio == 'Chumba-Chumba' ? 'active' : ''; ?>" href="?sitio=Chumba-Chumba<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Chumba-Chumba</a>
                            <a class="dropdown-item <?php echo $sitio == 'Ibabao' ? 'active' : ''; ?>" href="?sitio=Ibabao<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Ibabao</a>
                            <a class="dropdown-item <?php echo $sitio == 'Lawis' ? 'active' : ''; ?>" href="?sitio=Lawis<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Lawis</a>
                            <a class="dropdown-item <?php echo $sitio == 'Matumbo' ? 'active' : ''; ?>" href="?sitio=Matumbo<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Matumbo</a>
                            <a class="dropdown-item <?php echo $sitio == 'Mustang' ? 'active' : ''; ?>" href="?sitio=Mustang<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Mustang</a>
                            <a class="dropdown-item <?php echo $sitio == 'Lipata' ? 'active' : ''; ?>" href="?sitio=Lipata<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Lipata</a>
                            <a class="dropdown-item <?php echo $sitio == 'San Roque' ? 'active' : ''; ?>" href="?sitio=San Roque<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">San Roque</a>
                            <a class="dropdown-item <?php echo $sitio == 'Seabreeze' ? 'active' : ''; ?>" href="?sitio=Seabreeze<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Seabreeze</a>
                            <a class="dropdown-item <?php echo $sitio == 'Seaside' ? 'active' : ''; ?>" href="?sitio=Seaside<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Seaside</a>
                            <a class="dropdown-item <?php echo $sitio == 'Seawage' ? 'active' : ''; ?>" href="?sitio=Seawage<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Seawage</a>
                            <a class="dropdown-item <?php echo $sitio == 'Sta. Maria' ? 'active' : ''; ?>" href="?sitio=Sta. Maria<?php echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; ?>">Sta. Maria</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3 my-1 my-sm-0">
            <form action="" method="GET" class="input-group d-flex align-self-center" id="searchForm">
                <input type="text" class="form-control" name="search" placeholder="Enter User's ID or Name" id="searchInput" aria-label="User's ID or Name" aria-describedby="basic-addon2" value="<?php echo htmlspecialchars($searchTerm); ?>">                
                <div class="input-group-append">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row mx-0 my-2">
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">User ID No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Sitio</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Account Status</th>
                            <th scope="col">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr><td colspan="12" class="text-center">No records found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($users as $index => $user): 
                                $decryptedEmail = decryptData($user['res_email']);
                                $birthdate = new DateTime($user['birth_date']);
                                $currentDate = new DateTime();
                                $age = $currentDate->diff($birthdate)->y;

                                $middleInitial = !empty($user['res_midname']) ? ucfirst(substr($user['res_midname'], 0, 1)) . '. ' : '';
                                $suffix = !empty($user['res_suffix']) ? ' ' . ucfirst($user['res_suffix']) : '';
                            ?>
                                <tr class="clickable-row" data-doc-id="<?php echo htmlspecialchars($user['res_ID']); ?>">
                                    <td><?php echo htmlspecialchars($user['res_ID']) ?></td>
                                    <td><?php echo htmlspecialchars(ucfirst($user['res_fname']) . ' ' . $middleInitial . ucfirst($user['res_lname']) . $suffix) ?></td>
                                    <td><?php echo htmlspecialchars($user['gender']) ?></td>
                                    <td><?php echo htmlspecialchars($age) ?></td>
                                    <td><?php echo htmlspecialchars($user['addr_sitio']) ?></td>
                                    <td><?php echo htmlspecialchars($decryptedEmail) ?></td>
                                    <td><?php echo htmlspecialchars($user['contact_no']) ?></td>
                                    <td><?php echo htmlspecialchars($user['account_active_status'] === 'Active' ? 'Active' : 'Deactivated'); ?></td>
                                    <td class="tools">
                                    <button class="btn btn-secondary btn-sm view-btn" data-return-url="<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" data-res-id="<?php echo htmlspecialchars($user['res_ID']); ?> " title="View Resident" data-bs-toggle="tooltip" data-bs-placement="left">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                        <button class="btn btn-secondary btn-sm status-btn <?php echo $user['account_active_status'] === 'Active' ? 'deactivate-btn' : 'activate-btn'; ?>" data-res-id="<?php echo htmlspecialchars($user['res_ID']); ?>">
                                            <?php echo htmlspecialchars($user['account_active_status'] === 'Active' ? 'Deactivate' : 'Activate'); ?>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Users page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($current_page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=1" aria-label="First">
                                <span aria-hidden="true">First</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">Previous</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = max(1, $current_page - 1); $i <= min($total_pages, $current_page + 1); $i++): ?>
                        <li class="page-item <?php echo $i === $current_page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; echo isset($sitio) ? "&sitio=$sitio" : ""; echo isset($accountStatus) ? "&account_status=$accountStatus" : ""; echo isset($gender) ? "&gender=$gender" : ""; echo isset($ageRange) ? "&age_range=$ageRange" : ""; echo isset($search) ? "&search=$search" : ""; ?>">
                            <?php echo $i; ?>
                        </a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($current_page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?&page=<?php echo $total_pages; ?>" aria-label="Last">
                                <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</section>
<script src="manage-user.js"></script>
<?php include 'footerAdmin.php'; ?>