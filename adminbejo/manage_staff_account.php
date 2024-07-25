<?php 
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 2; // Number of records per page
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$staffs = fetchStaffAccounts($pdo, $search, $limit, $offset);



$total_records = getTotalStaffCount($pdo, $search);
$total_pages = ceil($total_records / $limit);
?>
<div class="container mt-5">
    <h2>Manage Staff Accounts</h2>
    <form action="" method="GET" class="input-group d-flex align-self-center">
                <input type="text" class="form-control" name="search" placeholder="Enter User's ID or Name" aria-label="User's ID or Name" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="staffTable">
            <?php if(empty($staffs)): ?>
                <tr><td colspan="12" class="text-center">No records found.</td></tr>
            <?php else:?>
                <?php foreach($staffs as $staff_users):?>
                    <tr>
                        <td><?= htmlspecialchars($staff_users['staff_id']) ;?></td>
                        <td><?= htmlspecialchars(decryptData($staff_users['staff_fname']).' '. strtoupper(substr(decryptData($staff_users['staff_midname']), 0, 1)) . '. '. decryptData($staff_users['staff_lname'])) ;?></td>       
                        <td><?= htmlspecialchars($staff_users['role_definition']);?></td>                                         
                        <td><?= htmlspecialchars(decryptData($staff_users['staff_email']));?></td>
                        
                        <td>
                            <a href="editStaff.php?id=<?= htmlspecialchars( $staff_users['staff_id']);?>" class="btn btn-warning">Edit</a>
                            <a href="deleteStaff.php?id=<?= htmlspecialchars( $staff_users['staff_id']);?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php include 'footerAdmin.php';?>
