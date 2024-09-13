<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php'; 
include '../db/DBconn.php';


$sitio = isset($_GET['sitio']) ? $_GET['sitio'] : 'All';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$records_per_page = 10;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;

$total_records = fetchTotalPending($pdo);
$total_pages = ceil($total_records / $records_per_page);

$users = fetchRegister($pdo, $records_per_page, $offset, $sitio, $search);?>  
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/pending2.0.css">
<main>
    <h1>Pending Users</h1>
    <div class="table-holder">
        <div class="mu-ds row d-flex justify-content-end">
            <div class="col-12 col-md-5 d-flex justify-content-center align-items-center">
                <a class="btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sitio
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item <?php echo $sitio == 'All' ? 'active' : ''; ?>" href="?sitio=All">All</a>
                    <a class="dropdown-item <?php echo $sitio == 'Arca' ? 'active' : ''; ?>" href="?sitio=Arca">Arca</a>
                    <a class="dropdown-item <?php echo $sitio == 'Cemento' ? 'active' : ''; ?>" href="?sitio=Cemento">Cemento</a>
                    <a class="dropdown-item <?php echo $sitio == 'Chumba-Chumba' ? 'active' : ''; ?>" href="?sitio=Chumba-Chumba">Chumba-Chumba</a>
                    <a class="dropdown-item <?php echo $sitio == 'Ibabao' ? 'active' : ''; ?>" href="?sitio=Ibabao">Ibabao</a>
                    <a class="dropdown-item <?php echo $sitio == 'Lawis' ? 'active' : ''; ?>" href="?sitio=Lawis">Lawis</a>
                    <a class="dropdown-item <?php echo $sitio == 'Matumbo' ? 'active' : ''; ?>" href="?sitio=Matumbo">Matumbo</a>
                    <a class="dropdown-item <?php echo $sitio == 'Mustang' ? 'active' : ''; ?>" href="?sitio=Mustang">Mustang</a>
                    <a class="dropdown-item <?php echo $sitio == 'New Lipata' ? 'active' : ''; ?>" href="?sitio=New Lipata">New Lipata</a>
                    <a class="dropdown-item <?php echo $sitio == 'San Roque' ? 'active' : ''; ?>" href="?sitio=San Roque">San Roque</a>
                    <a class="dropdown-item <?php echo $sitio == 'Seabreeze' ? 'active' : ''; ?>" href="?sitio=Seabreeze">Seabreeze</a>
                    <a class="dropdown-item <?php echo $sitio == 'Seaside' ? 'active' : ''; ?>" href="?sitio=Seaside">Seaside</a>
                    <a class="dropdown-item <?php echo $sitio == 'Sewage' ? 'active' : ''; ?>" href="?sitio=Sewage">Sewage</a>
                    <a class="dropdown-item <?php echo $sitio == 'Sta. Maria' ? 'active' : ''; ?>" href="?sitio=Sta. Maria">Sta. Maria</a>
                </div>
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
        <div class="row d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sitio</th>
                                    <th>Date Registered</th>
                                    <th>Registered Voter</th>
                                    <th>More Details</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($users)): ?>
                                <tr><td colspan="7">No users are currently requesting to register.</td></tr>
                            <?php else: ?>    
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <?php
                                            $birthdate = new DateTime($user['birth_date']);
                                            $currentDate = new DateTime();
                                            $age = $currentDate->diff($birthdate)->y;

                                            $imagePath = "../db/uploadedFiles/{$user['verification_image']}";
                                            if (file_exists($imagePath)) {
                                                $imageData = base64_encode(file_get_contents($imagePath));
                                                $imageMimeType = mime_content_type($imagePath);
                                                $imageSrc = "data:$imageMimeType;base64,$imageData";
                                            } else {
                                                $imageSrc = ''; 
                                            }

                                            $decryptedEmail = decryptData($user['res_email']);
                                        ?>
                                        <td><?= htmlspecialchars(ucfirst($user['res_fname']) . ' ' . ucfirst(substr($user['res_midname'], 0, 1)) . '. ' . ucfirst($user['res_lname'])) ?></td>
                                        <td><?= htmlspecialchars($age) ?></td>
                                        <td><?= htmlspecialchars($user['addr_sitio'])?></td>
                                        <td><?= htmlspecialchars($user['register_at'])?></td>
                                        <td class="reg-voter">
                                            <?= htmlspecialchars($user['registered_voter']) ?> 
                                            <i class="bi bi-x text-danger btn" onclick="handleXClick(<?= htmlspecialchars($user['res_ID']) ?>)"></i>
                                            <i class="bi bi-check2 text-success btn" onclick="handleCheckClick(<?= htmlspecialchars($user['res_ID']) ?>)"></i>
                                        </td>
                                        <td>
                                            <a href="#" onclick="showDetails('<?= $imageSrc ?>',
                                                                                '<?= ucfirst($user['res_fname']) . ' ' . ucfirst(substr($user['res_midname'], 0, 1)) . '. ' . ucfirst($user['res_lname']) ?>',
                                                                                '<?= htmlspecialchars($user['addr_sitio'])?>',
                                                                                '<?= htmlspecialchars($user['birth_date'])?>',
                                                                                '<?= htmlspecialchars($user['contact_no'])?>',
                                                                                '<?= htmlspecialchars($decryptedEmail)?>',
                                                                                '<?= htmlspecialchars($user['citizenship'])?>')">View details</a>
                                        </td>
                                        <td class="tools">
                                            <div class="btn btn-danger btn-sm" res_email="<?= htmlspecialchars($decryptedEmail) ?>" 
                                                                             res_ID="<?= htmlspecialchars($user['res_ID']) ?>" id="cancelButton" 
                                                                             onclick="handleCancelClick(this.getAttribute('res_email'), this.getAttribute('res_ID'))">
                                                <span class="btn-text">Cancel</span><i class="bi bi-person-x-fill"></i>
                                            </div>
                                            <div class="btn btn-primary btn-sm" res_email="<?= htmlspecialchars($decryptedEmail) ?>" res_ID="<?= htmlspecialchars($user['res_ID']) ?>" id="approveButton" 
                                                                             onclick="handleApproveClick(this.getAttribute('res_email'), this.getAttribute('res_ID'))">
                                                <span class="btn-text">Approve</span><i class="bi bi-person-fill-check"></i></div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1" aria-label="First">
                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&sitio=<?php echo $sitio; ?>&search=<?php echo urlencode($search); ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $total_pages ?>" aria-label="Last">
                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
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
        publicKey: "3M0ZwTJ5XMRKLtzfl",
      });
   })();
</script>
<?php include 'footerAdmin.php'; ?>
