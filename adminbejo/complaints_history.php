<?php
include 'headerAdmin.php';
include '../db/DBconn.php';

// $limit = 5;

// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $offset = ($page - 1) * $limit;

// $complaint = fetchListofComplaints($pdo, $offset, $limit);
// $totalRequests = fetchTotalComplaints($pdo);

// $totalPages = ceil($totalRequests / $limit);

// 
$fetch_complaints_sql = "
    SELECT complaint_id, case_type, date_filed, status, remarks
    FROM complaints_tbl
    WHERE status IN ('Accepted', 'Declined')
";
$fetch_complaints_stmt = $pdo->prepare($fetch_complaints_sql);
$fetch_complaints_stmt->execute();
$complaints = $fetch_complaints_stmt->fetchAll(PDO::FETCH_ASSOC);
?>


?>
<link rel="stylesheet" href="css/list.css">

<div class="container-fluid">
    <h1>Complaints History</h1>
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
                        <th>Remarks</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($complaints as $complaint): ?>
                <tr>
                    <td><?php echo $complaint['complaint_id']; ?></td>
                    <td><?php echo $complaint['case_type']; ?></td>
                    <td><?php echo $complaint['date_filed']; ?></td>
                    <td><?php echo $complaint['status']; ?></td>
                    <td><?php echo $complaint['remarks']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
            </table>
        </div>
        <!-- <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-5">
                <?php
                $startPage = max(1, $page - 1);
                $endPage = min($startPage + 2, $totalPages);
                $startPage = max(1, $endPage - 2);
                ?>

                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">Prev</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav> -->
    </div>
</div>

<script src="../js/complaints_popUp.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const complaintsTableBody = document.getElementById('complaints-table-body');
        
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key.startsWith('transferredComplaint-')) {
                const complaintHTML = localStorage.getItem(key);
                const newRow = document.createElement('tr');
                newRow.innerHTML = complaintHTML;
                complaintsTableBody.appendChild(newRow);
                localStorage.removeItem(key);
            }
        }
    });
</script>

<?php require_once 'footerAdmin.php'; ?>
