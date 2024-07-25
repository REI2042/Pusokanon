<?php
include '../../db/DBconn.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';
$staffs = fetchStaffAccounts($pdo, $search);

if(empty($staffs)): ?>
    <tr><td colspan="12" class="text-center">No records found.</td></tr>
<?php else:
    foreach($staffs as $staff_users):?>
        <tr>
            <td><?= htmlspecialchars($staff_users['staff_id']) ;?></td>
            <td><?= htmlspecialchars(decryptData($staff_users['staff_fname']).' '. strtoupper(substr(decryptData($staff_users['staff_midname']), 0, 1)) . '. '. decryptData($staff_users['staff_lname'])) ;?></td>                                                
            <td><?= htmlspecialchars(decryptData($staff_users['staff_email']));?></td>
            <td>
                <a href="editStaff.php?id=<?= htmlspecialchars( $staff_users['staff_id']);?>" class="btn btn-warning">Edit</a>
                <a href="deleteStaff.php?id=<?= htmlspecialchars( $staff_users['staff_id']);?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    <?php endforeach;
endif;
?>