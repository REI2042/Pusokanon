<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

    $status = isset($_GET['status']) ? $_GET['status'] : 'all';
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

    $perPage = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $perPage;

    if ($search) {
        $posts = fetchAllPostById($pdo, $searchTerm);
        $totalPosts = count($posts);
    } else {
        $totalPosts = fetchTotalResPostsWithFilters($pdo, $status);
        $posts = getAllResPosts($pdo, $perPage, $offset, $status);
    }

    $totalPages = ceil($totalPosts / $perPage);

?>  
<link rel="stylesheet" href="css/Manage-Posts.css">
<section class="main">
    <div class="post-box p-3">
        <div id="posts">
            <a href="Residents-Forum.php" class="back-button d-flex align-items-center text-dark gap-2" style="text-decoration: none; color: #2C7BD5;">
                <i class="fas fa-circle-chevron-left fa-2x"></i>
                <span>Back</span>
            </a>
            <div class="row text-center align-items-center my-3">
                <h1 class="title text-center">Manage Resident Posts</h1>
            </div>
            <div class="row my-1 justify-content-end">
                <div class="dropdown-container col-12 col-sm-6 d-flex justify-content-end">
                    <div class="row mx-0 justify-content-between">
                        <div class="col-6 col-sm-3 d-flex justify-content-center my-1 my-sm-0 align-self-center">
                            <div class="dropdown">
                                <button class="status btn dropdown-toggle" type="button" id="statusDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Status
                                </button>
                                <div class="dropdown-menu" aria-labelledby="statusDropdown">
                                    <a class="dropdown-item <?php echo $status == 'all' || $status == '' ? 'active' : ''; ?>" href="?status=all<?php echo isset($popularity) ? "&popularity=$popularity" : ""; ?>">All</a>
                                    <a class="dropdown-item <?php echo $status == 'pending' ? 'active' : ''; ?>" href="?status=pending<?php echo isset($popularity) ? "&popularity=$popularity" : ""; ?>">Pending</a>
                                    <a class="dropdown-item <?php echo $status == 'rejected' ? 'active' : ''; ?>" href="?status=rejected<?php echo isset($popularity) ? "&popularity=$popularity" : ""; ?>">Rejected</a>
                                    <a class="dropdown-item <?php echo $status == 'resubmitted' ? 'active' : ''; ?>" href="?status=resubmitted<?php echo isset($popularity) ? "&popularity=$popularity" : ""; ?>">Resubmitted</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 my-1 my-sm-0">
                    <form action="" method="GET" class="input-group d-flex align-self-center" id="searchForm">
                        <input type="text" class="form-control" name="search" placeholder="Enter Post's ID or Title" id="searchInput" aria-label="Post's ID or Title" aria-describedby="basic-addon2" value="<?php echo htmlspecialchars($searchTerm); ?>">                
                        <div class="input-group-append">
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover status-<?php echo $status; ?>">
                    <thead>
                        <tr>
                            <th scope="col">Post ID</th>
                            <th scope="col">Post Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Date Posted</th>
                            <th scope="col">Upvotes</th>
                            <th scope="col">Downvotes</th>
                            <th scope="col">Status</th>
                            <th scope="col">Approve By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($posts)): ?>
                            <tr><td colspan="7" class="text-center">No records found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($posts as $posts): 
                                $dateRequested = DateTime::createFromFormat('Y-m-d H:i:s', $posts['created_at']);
                                $formattedDateRequested = $dateRequested ? $dateRequested->format('F j, Y') : 'N/A';
                            ?>
                                <tr class="clickable-row" data-doc-id="<?php echo htmlspecialchars($posts['post_id']); ?>">
                                    <td><?php echo htmlspecialchars($posts['post_id']); ?></td>
                                    <td><?php echo htmlspecialchars(mb_strimwidth($posts['title'], 0, 20, '...')); ?></td>
                                    <td><?php echo htmlspecialchars(mb_strimwidth($posts['content'], 0, 20, '...')); ?></td>
                                    <td><?php echo htmlspecialchars($formattedDateRequested); ?></td>
                                    <td><?php echo htmlspecialchars($posts['upvotes']); ?></td>
                                    <td><?php echo htmlspecialchars($posts['downvotes']); ?></td>
                                    <td><?php echo htmlspecialchars($posts['approval_status']); ?></td>
                                    <td><?php echo htmlspecialchars($posts['approved_by']); ?></td>
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
                            <a class="page-link" href="?sort=<?php echo $sort; ?>&page=1" aria-label="First">
                                <span aria-hidden="true">First</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?sort=<?php echo $sort; ?>&page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">Previous</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = max(1, $page - 1); $i <= min($totalPages, $page + 1); $i++): ?>
                        <li class="page-item <?php echo $i === $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?sort=<?php echo $sort; ?>&page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?sort=<?php echo $sort; ?>&page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">Next</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?sort=<?php echo $sort; ?>&page=<?php echo $totalPages; ?>" aria-label="Last">
                                <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</section>
<script src="#"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.clickable-row');
        rows.forEach(row => {
            row.addEventListener('click', function() {
                const postId = this.getAttribute('data-doc-id');
                window.location.href = 'Residents-Post.php?id=' + postId + '&ref=res-posts';
            });
        });

        document.getElementById('searchInput').addEventListener('input', function() {
            if (this.value === '') {
                document.getElementById('searchForm').submit();
            }
        });
    });
</script>
<?php include 'footerAdmin.php'; ?>