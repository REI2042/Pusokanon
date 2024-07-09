<?php
include 'headerAdmin.php';
include '../db/DBconn.php';

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$requests = fetchListofComplaints($pdo, $offset, $limit);
$totalRequests = fetchTotalComplaints($pdo);

$totalPages = ceil($totalRequests / $limit);
?>
<link rel="stylesheet" href="css/list.css">

<div class="container-fluid">
    <h1>List of Complaints</h1>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mx-auto" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Case ID</th>
                        <th>Case Type</th>
                        <th>Place of Incident</th>
                        <th>Date Reported</th>
                        <th>Status</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody class="scrollable-table-body">
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
                            <tr onclick="showDetails(
                                            '<?= htmlspecialchars($request['resident_name'])?>',
                                            '<?= htmlspecialchars($request['respondent_name'])?>',
                                            '<?= htmlspecialchars($request['respondent_age'])?>',
                                            '<?= htmlspecialchars($request['respondent_gender'])?>',
                                            '<?= htmlspecialchars($request['incident_date'])?>',
                                            '<?= htmlspecialchars($request['incident_time'])?>',
                                            '<?= htmlspecialchars($request['incident_place'])?>',
                                            '<?= htmlspecialchars($request['narrative'])?>')">
                                <td><?php echo htmlspecialchars($request['complaint_id']); ?></td>
                                <td><?php echo htmlspecialchars($request['case_type']); ?></td>
                                <td><?php echo htmlspecialchars($request['incident_place']); ?></td>
                                <td><?php echo htmlspecialchars($request['date_filed']); ?></td>
                                <td id="status-<?php echo htmlspecialchars($request['complaint_id']); ?>">
                                    <?php echo htmlspecialchars($request['status']); ?>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center">
                                        <button class="btn btn-success btn-sm me-2" onclick="approveComplaint(
                                            '<?= htmlspecialchars($request['complaint_id'])?>',
                                            '<?= htmlspecialchars($request['resident_email'])?>')">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                        <form class="status-form mb-0 me-2" action="../db/DBconn_disapprove.php" method="POST">
                                            <input type="hidden" name="complaint_id" value="<?= htmlspecialchars($request['complaint_id']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Disapprove
                                            </button>
                                        </form>
                                        <form class="status-form mb-0" action="../db/DBconn_complaints.php" method="POST">
                                            <input type="hidden" name="complaint_id" value="<?= htmlspecialchars($request['complaint_id']); ?>">
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="Pending" <?= $request['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="Processing" <?= $request['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                                <option value="Done" <?= $request['status'] == 'Done' ? 'selected' : ''; ?>>Done</option>
                                            </select>
                                        </form>
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
                <?php if($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page-1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page+1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<script src="../js/complaints_popUp.js"></script>
<script src="../complaints_updateStatus.js"></script>


<?php require_once 'footerAdmin.php'; ?>
