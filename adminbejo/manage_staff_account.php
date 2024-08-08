<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $all_staffs = fetchStaffAccounts($pdo, $search);
    $total_records = count($all_staffs);

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 5;
    $offset = ($page - 1) * $limit;

    $staffs = array_slice($all_staffs, $offset, $limit);
    $total_pages = ceil($total_records / $limit);
?>
<link rel="stylesheet" href="css/manage_staff.css">
    
<div class="container-fluid">
    <h1>Manage Staff Account</h1>
    <div class="mu-ds row d-flex justify-content-end mt-5 mb-3">
        <div class="col-12 col-md-9 d-flex justify-content-end align-items-center flex-wrap">
            <form id="searchForm" action="" method="GET" class="d-flex">
                <input type="text" id="searchInput" class="form-control me-2" name="search" placeholder="Enter User's ID or Name" aria-label="User's ID or Name" aria-describedby="basic-addon2" value="<?= htmlspecialchars($search) ?>">
                <div class="input-group-append">
                    <button class="btn this-button" type="submit">Search</button>
                </div>
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

    <div class="card d-flex flex-column">
        <div class="card-body flex-grow-1 d-flex flex-column">
            <div class="table-responsive flex-grow-1">
                <table class="table mx-auto" cellspacing="0" cellpadding="0">
                    <thead style="background-color: #2260a7;">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="scrollable-table-body">
                        <?php if (!empty($staffs)): ?>
                            <?php foreach ($staffs as $staff_users): ?>
                                <tr>
                                    <td><?= htmlspecialchars($staff_users['staff_id']) ;?></td>
                                    <td><?= htmlspecialchars(decryptData($staff_users['staff_fname']) . ' ' . 
                                                strtoupper(substr(decryptData($staff_users['staff_midname']), 0, 1)) . '. ' . 
                                                decryptData($staff_users['staff_lname'])) ;?></td>                                    
                                    <td><?= htmlspecialchars($staff_users['role_definition']);?></td>                                         
                                    <td><?= htmlspecialchars(decryptData($staff_users['staff_email']));?></td>
                                    <td><?= htmlspecialchars($staff_users['status']);?></td>  
                                    <td>
                                        <button class="btn btn-secondary btn-sm me-2" title="Edit Account" onclick="window.location.href='edit_staffAccount.php?staff_id=<?= htmlspecialchars($staff_users['staff_id']) ?>'">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-success btn-sm me-2" title="Activate Account" onclick="activateStaff('<?= htmlspecialchars($staff_users['staff_id']) ?>', '<?= htmlspecialchars($staff_users['status']) ?>')">
                                            <i class="bi bi-person-fill-check"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm me-2" title="Deactivate Account" onclick="deactivateStaff('<?= htmlspecialchars($staff_users['staff_id']) ?>', '<?= htmlspecialchars($staff_users['status']) ?>')">
                                            <i class="bi bi-person-fill-slash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No staff accounts found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination-container">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                            $range = 1;
                            $start_page = max(1, $page - $range);
                            $end_page = min($total_pages, $page + $range);

                            if ($end_page - $start_page < 2) {
                                $start_page = max(1, $end_page - 2);
                                $end_page = min($total_pages, $start_page + 2);
                            }
                        ?>

                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1&search=<?= urlencode($search) ?>">First</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>"><<</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <li class="page-item<?= ($i == $page) ? ' active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">>></a>
                            </li>
                        <?php endif; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $total_pages ?>&search=<?= urlencode($search) ?>">Last</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<script src="../js/manage_account.js"></script>

<?php require_once 'footerAdmin.php'; ?>
