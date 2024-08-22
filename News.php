<?php
    include 'include/header.php';
    include 'db/DBconn.php';

    date_default_timezone_set('Asia/Manila');

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'trending';

    $pinnedPosts = fetchPinnedPosts($pdo);
    $posts = fetchAllPosts($pdo, $sort);

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
<link rel="stylesheet" href="css/News.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
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
                            <a href="Res-view-Post.php?id=<?php echo $post['post_id']; ?>">
                                <div class="Post">
                                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <p><?php echo substr(htmlspecialchars($post['content']), 0, 100) . '...'; ?></p>
                                    <p>Posted <?php echo time_elapsed_string($post['created_at']); ?></p>
                                    <?php $media = fetchPostMedia($pdo, $post['post_id']); ?>
                                    <?php if (!empty($media)): ?>
                                        <div id="Post<?php echo $post['post_id']; ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach ($media as $index => $item): ?>
                                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                        <?php if ($item['media_type'] === 'image'): ?>
                                                            <img src="db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" class="d-block w-100" alt="Post Image">
                                                        <?php elseif ($item['media_type'] === 'video'): ?>
                                                            <video class="d-block w-100" controls>
                                                                <source src="db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (count($media) > 1): ?>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#Post<?php echo $post['post_id']; ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#Post<?php echo $post['post_id']; ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="reactions">
                                        <span class="reaction">
                                            <button class="btn upvote-btn <?php echo (isset($_SESSION['res_ID']) && getUserReaction($pdo, $post['post_id'], $_SESSION['res_ID'])['reaction_type'] === 'upvote') ? 'active' : ''; ?>" data-post-id="<?php echo $post['post_id']; ?>">
                                                <i class="fa-solid fa-thumbs-up"></i>
                                            </button>
                                            <span class="count upvote-count"><?php echo $post['upvotes']; ?></span>
                                        </span>
                                        <span class="reaction">
                                            <button class="btn downvote-btn <?php echo (isset($_SESSION['res_ID']) && getUserReaction($pdo, $post['post_id'], $_SESSION['res_ID'])['reaction_type'] === 'downvote') ? 'active' : ''; ?>" data-post-id="<?php echo $post['post_id']; ?>">
                                                <i class="fa-solid fa-thumbs-down"></i>
                                            </button>
                                            <span class="count downvote-count"><?php echo $post['downvotes']; ?></span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-post-message">There are no posts yet.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-6">
                <div class="Pinned-Posts">
                    <h2>Pinned Posts</h2>
                    <?php if (!empty($pinnedPosts)): ?>
                        <?php foreach ($pinnedPosts as $pinnedPost): ?>
                            <a href="Res-view-Post.php?id=<?php echo $pinnedPost['post_id']; ?>">
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
<script src="js/News.js"></script>
<?php include 'include/footer.php'; ?>