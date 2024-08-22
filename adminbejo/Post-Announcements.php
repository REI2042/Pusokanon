<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'trending';

$pinnedPosts = fetchPinnedPosts($pdo);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$postsPerPage = 5;
$offset = ($page - 1) * $postsPerPage;

$posts = fetchPosts($pdo, $sort, $offset, $postsPerPage);

$totalPosts = getTotalPosts($pdo);
$totalPages = ceil($totalPosts / $postsPerPage);

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>
<link rel="stylesheet" href="css/Post-Announcements.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <a href="Create-Post.php">
            <button class="btn btn-primary">Create Post</button>
        </a>
        <div class="row">
            <div class="col-6">
                <div class="Posts">
                    <div class="">
                        <a href="?sort=trending" class="trending-button <?php echo $sort === 'trending' ? 'active' : ''; ?>">Trending</a>
                        <a href="?sort=latest" class="latest-button <?php echo $sort === 'latest' ? 'active' : ''; ?>">Latest</a>
                        <a href="?sort=oldest" class="oldest-button <?php echo $sort === 'oldest' ? 'active' : ''; ?>">Oldest</a>
                    </div>
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <div class="Post position-relative">
                                <form action="phpConn/pin_post.php" method="POST">
                                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                                    <button class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 mt-2 me-2" value="1" name="Pinpost" title="Pin post">
                                        <i class="fa-solid fa-thumbtack"></i>
                                    </button>
                                </form>
                                <a href="View-Post.php?id=<?php echo $post['post_id']; ?>">
                                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <p><?php echo substr(htmlspecialchars($post['content']), 0, 100) . '...'; ?></p>
                                    <p>Posted <?php echo time_elapsed_string($post['created_at']); ?></p>
                                    <div>
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <span><?php echo $post['upvotes']; ?></span>
                                        <i class="fa-solid fa-thumbs-down"></i>
                                        <span><?php echo $post['downvotes']; ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-post-message">There are no posts yet.</p>
                    <?php endif; ?>
                    <nav aria-label="Post page navigation">
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

                            <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
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
            <div class="col-6">
                <div class="Pinned-Posts">
                    <h2>Pinned Posts</h2>
                    <?php if (!empty($pinnedPosts)): ?>
                        <?php foreach ($pinnedPosts as $pinnedPost): ?>
                            <a href="View-Post.php?id=<?php echo $pinnedPost['post_id']; ?>">
                                <div class="Pinned-Post">
                                    <h5><?php echo htmlspecialchars($pinnedPost['title']); ?></h5>
                                    <p>Posted <?php echo time_elapsed_string($pinnedPost['created_at']); ?></p>
                                    <div>
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        <span><?php echo $pinnedPost['upvotes']; ?></span>
                                        <i class="fa-solid fa-thumbs-down"></i>
                                        <span><?php echo $pinnedPost['downvotes']; ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-pinned-message">There are no pinned posts yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'footerAdmin.php'; ?>