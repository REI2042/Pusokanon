<?php
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    // Number of complaints per page
    $limit = 5;
    
    // Current page number
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    // Calculate the offset for the SQL query
    $offset = ($page - 1) * $limit;
    
    // Fetch the complaints for the current page
    $requests = fetchListofComplaints($pdo, $offset, $limit);
    
    // Fetch the total number of complaints
    $totalRequests = fetchTotalComplaints($pdo);
    
    // Calculate total pages
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
                        <th>Date of Incident</th>
                        <th>Place of Incident</th>
                        <th>Date Reported</th>
                        <th>Status</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody class="scrollable-table-body">
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($request['complaint_id']); ?></td>
                                <td><?php echo htmlspecialchars($request['case_type']); ?></td>
                                <td><?php echo htmlspecialchars($request['incident_date']); ?></td>
                                <td><?php echo htmlspecialchars($request['incident_place']); ?></td>
                                <td><?php echo htmlspecialchars($request['date_filed']); ?></td>
                                <td><?php echo htmlspecialchars($request['status']); ?></td>
                                <td>
                                    <a href="viewComplaint.php?id=<?php echo $request['complaint_id']; ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No complaints found.</td>
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

<?php require_once 'footerAdmin.php';?> 
