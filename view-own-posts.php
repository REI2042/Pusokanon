<?php
    include 'include/header.php';
    include 'db/DBconn.php';
    
	
    $resId = $_SESSION['res_ID'];

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'trending';
    $perPage = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $offset = ($page - 1) * $perPage;

    $posts = fetchOWnPosts($pdo, $resId, $sort, $perPage, $offset);
    $totalPosts = countOwnPosts($pdo, $resId, $sort);

    $totalPages = ceil($totalPosts / $perPage);
    
?>
<link rel="stylesheet" href="css/view-own-posts.css">
    <section class="main">
        <div class="row">
            <div class="col-12 p-3">
                <div class="post-box p-3">
                    <div id="posts">
                        <a href="Forum.php" class="back-button d-flex align-items-center text-dark gap-2" style="text-decoration: none; color: #2C7BD5;">
                            <i class="fas fa-circle-chevron-left fa-2x"></i>
                            <span>Back</span>
                        </a>
                        <div class="row text-center align-items-center my-3">
                            <div class="col-6 col-sm-4">
                                <a href="?sort=trending" class="trending-button <?php echo $sort === 'trending' ? 'active' : ''; ?>">Trending</a>
                            </div>
                            <div class="col-6 col-sm-4">
                                <a href="?sort=latest" class="latest-button <?php echo $sort === 'latest' ? 'active' : ''; ?>">Latest</a>
                            </div>
                            <div class="col-12 col-sm-4">
                                <a href="?sort=oldest" class="oldest-button <?php echo $sort === 'oldest' ? 'active' : ''; ?>">Oldest</a>
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
            </div>
        </div>
    </section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.clickable-row');
        rows.forEach(row => {
            row.addEventListener('click', function() {
                const postId = this.getAttribute('data-doc-id');
                window.location.href = 'resident_post.php?id=' + postId + '&ref=own-posts';
            });
        });
    });
</script>
<?php include 'include/footer.php'; ?>