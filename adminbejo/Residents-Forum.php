<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'trending';

date_default_timezone_set('Asia/Manila');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$postsPerPage = 5;
$offset = ($page - 1) * $postsPerPage;

$posts = fetchResidentPosts($pdo, $sort, $offset, $postsPerPage);

$totalPosts = getTotalResidentPosts($pdo);
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
        <a href="Post-Announcements.php">
            <button class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Go back to Announcements</button>
        </a>
        <div class="row">
            <div class="col-12">
                <div class="Posts p-3">
                    <h3 class="m-2 text-center">Residents Forum</h3>
                    <div class="sort-container px-2 py-2">
                        <a href="?sort=trending" class="trending-button <?php echo $sort === 'trending' ? 'active' : ''; ?>">Trending</a>  &nbsp; | &nbsp;
                        <a href="?sort=latest" class="latest-button <?php echo $sort === 'latest' ? 'active' : ''; ?>">Latest</a>  &nbsp; | &nbsp;
                        <a href="?sort=oldest" class="oldest-button <?php echo $sort === 'oldest' ? 'active' : ''; ?>">Oldest</a>
                    </div>
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <a href="Residents-Post.php?id=<?php echo $post['post_id']; ?>">
                                <div class="Post position-relative  my-3 px-3 py-3">
                                    <div class="post-header d-flex align-items-center mb-2">
                                        <img src="<?php echo $post['profile_picture'] ? '../db/ProfilePictures/' . htmlspecialchars($post['profile_picture']) : '../PicturesNeeded/blank_profile.png'; ?>" alt="Profile Picture" class="profile-picture mr-2" style="width: 40px; height: 40px; border-radius: 50%;">
                                        <span class="poster-name"><?php echo htmlspecialchars($post['res_fname'] . ' ' . $post['res_lname']); ?> | Resident</span>
                                    </div>
                                    <h3 class="fw-bold"><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <p><?php echo substr(htmlspecialchars($post['content']), 0, 100) . '...'; ?></p>
                                    <p class="posted"><i class="far fa-clock"></i> Posted <?php echo time_elapsed_string($post['created_at']); ?></p>
                                    
                                    <?php
                                    $media = fetchPostMedia($pdo, $post['post_id']);
                                    if (!empty($media)): ?>
                                        <div id="Post<?php echo $post['post_id']; ?>" class="carousel slide d-flex" data-bs-interval="false">
                                            <div class="carousel-indicators">
                                                <?php foreach ($media as $index => $item): ?>
                                                    <button type="button" data-bs-target="#Post<?php echo $post['post_id']; ?>" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="carousel-inner">
                                                <?php foreach ($media as $index => $item): ?>
                                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                        <?php if ($item['media_type'] === 'image'): ?>
                                                            <img src="../db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" class="image" alt="Post Image">
                                                        <?php elseif ($item['media_type'] === 'video'): ?>
                                                            <video class="video" controls autoplay muted loop>
                                                                <source src="../db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (count($media) > 1): ?>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#Post<?php echo $post['post_id']; ?>" data-bs-slide="prev">
                                                    <i class="prev fa-solid fa-chevron-left" aria-hidden="true"></i>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#Post<?php echo $post['post_id']; ?>" data-bs-slide="next">
                                                    <i class="next fa-solid fa-chevron-right" aria-hidden="true"></i>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div >
                                        <i class="fa-solid fa-thumbs-up reactions"></i>
                                        <span class="reactions"><?php echo $post['upvotes']; ?></span>
                                        <i class="fa-solid fa-thumbs-down reactions"></i>
                                        <span class="reactions"><?php echo $post['downvotes']; ?></span>
                                    </div>
                                </div>
                            </a>
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
                                        <span aria-hidden="true">Prev</span>
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
                            <li class="page-item">
                                <a class="page-link" href="#" onclick="window.scrollTo(0, 0); return false;" aria-label="Scroll to top">
                                    <span aria-hidden="true">↑</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>  
        </div>
    </section>
</div>

<?php include 'footerAdmin.php'; ?>