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

        $weeks = floor($diff->d / 7);
        $diff->d -= $weeks * 7;

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
            $value = $k === 'w' ? $weeks : $diff->$k;
            if ($value) {
                $v = $value . ' ' . $v . ($value > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
?>
<link rel="stylesheet" href="css/Announcement.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<main> 
    <div class="container-announcement">
        <div class="row d-none d-md-block">
            <div class="d-flex">
                <div class="col-md-2 announcement-sort pt-4 ">
                    <div class="sort-container justify-content-end py-2 ms-5 ">
                        <a href="?sort=trending" class="trending-button <?php echo $sort === 'trending' ? 'active' : ''; ?>">
                            <div class="sort-buttons pb-2">
                                <span class="pl-4"> Popular Post </span> 
                            </div>
                        </a> 
                        <a href="?sort=latest" class="latest-button <?php echo $sort === 'latest' ? 'active' : ''; ?>">
                            <div class="sort-buttons pb-2">
                            <span class="pl-4"> Latest Post  </span> 
                            </div>
                        </a> 
                        <a href="?sort=oldest" class="oldest-button <?php echo $sort === 'oldest' ? 'active' : ''; ?>">
                            <div class="sort-buttons pb-2">
                            <span class="pl-4"> Old Post </span> 
                            </div>    
                        </a>
                    </div>
                </div>
                <div class="col-md-7 announcement-item Posts">
                    <?php if (!empty($posts)): ?>
                            <?php foreach ($posts as $post): ?>
                                <a href="Res-view-Post.php?id=<?php echo $post['post_id']; ?>">
                                    <div class="Post my-3 px-3 py-3">
                                        <h3 class="fw-bold mb-3 post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                                        <p ><?php echo substr(htmlspecialchars($post['content']), 0, 100) . '...'; ?></p>
                                        <?php $media = fetchPostMedia($pdo, $post['post_id']); ?>
                                        <?php if (!empty($media)): ?>
                                            <div id="Post<?php echo $post['post_id']; ?>" class="carousel slide mt-4" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php foreach ($media as $index => $item): ?>
                                                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                                            <?php if ($item['media_type'] === 'image'): ?>
                                                                <img src="db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" class="d-block w-100 mx-auto" alt="Post Image">
                                                            <?php elseif ($item['media_type'] === 'video'): ?>
                                                                <video class="d-block w-100" controls>
                                                                    <source src="db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <p class="posted text-end"><i class="bi bi-clock"></i> Posted <?php echo time_elapsed_string($post['created_at']); ?></p>
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
                                        <div class="reactions pl-2">
                                            <span class="reaction pe-3">
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
                
                <div class="col-md-3 announcement-pin bg-white pin">
                    <div class="Pinned-Posts p-1 p-sm-3 pb-1 mt-3">
                        <h5 class="fw-bold d-flex justify-content-between align-items-center">
                            <span class="d-flex align-items-center">
                                Pinned Posts
                                <i class="bi bi-pin-angle-fill ms-2 text-black small"></i>
                            </span>
                        </h5>
                        <?php if (!empty($pinnedPosts)): ?>
                        <?php foreach ($pinnedPosts as $pinnedPost): ?>
                            <a href="Res-view-Post.php?id=<?php echo $pinnedPost['post_id']; ?>">
                                <div class="Pinned-Post my-2 mx-1 px-2 py-2">
                                    <h6 class="post-title"><i class="bi bi-chat-text-fill pin-title"></i> <?php echo htmlspecialchars($pinnedPost['title']); ?></h6>
                                    <span class="posted ">Posted <?= htmlspecialchars($pinnedPost['content']); ?></span>
                                    <p class="posted small">Posted <?php echo time_elapsed_string($pinnedPost['created_at']); ?></p>
                                    <div>
                                        <i class="fa-solid fa-thumbs-up reactions"></i>
                                        <span class="reactions"><?php echo $pinnedPost['upvotes']; ?></span>
                                        <i class="fa-solid fa-thumbs-down reactions"></i>
                                        <span class="reactions"><?php echo $pinnedPost['downvotes']; ?></span>
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
        </div>
        <!-- Mobile View -->
        <div class="row announcement-Phone d-md-none" >
                <div class="Pinned-PostsPhone pb-2 ml-3" style="background-color: #f8f9fa;">
                    <a href="#" id="show-all-pinned" class="d-flex align-items-center w-100 text-black">
                        <span class="d-flex justify-content-between align-items-center mt-0 mt-sm-3 h6-title small">
                                <b>Pinned Posts</b>
                                <i class="bi bi-pin-angle-fill ms-2 text-black small"></i>
                        </span>
                        <i class="bi bi-chevron-down ms-auto text-black"></i>
                    </a>
                    <?php if (!empty($pinnedPosts)): ?>
                        <?php $latestPinnedPost = $pinnedPosts[0]; ?>
                        <div id="latest-pinned-post" class="pin-announcement m-0 p-1 d-flex align-items-center" style="background-color: #f0f0f0;">
                            <div class="Pinned-PostPhone pl-2 pt-1">
                                <h6 class="small d-flex align-items-center"><i class="bi bi-chat-text-fill me-1"></i> <?php echo htmlspecialchars($latestPinnedPost['title']); ?>
                                <p class="posted d-none d-md-block ">Posted <?php echo time_elapsed_string($latestPinnedPost['created_at']); ?></p>
                                </h6>
                                <div class="d-none d-md-block">
                                    <i class="fa-solid fa-thumbs-up pinned-reactions"></i>
                                    <span class="pinned-reactions"><?php echo $latestPinnedPost['upvotes']; ?></span>
                                    <i class="fa-solid fa-thumbs-down pinned-reactions"></i>
                                    <span class="pinned-reactions"><?php echo $latestPinnedPost['downvotes']; ?></span>
                                </div>
                            </div>
                        </div>
                        <div id="all-pinned-posts" style="display: none;">
                            <?php foreach ($pinnedPosts as $pinnedPost): ?>
                                <a href="Res-view-Post.php?id=<?php echo $pinnedPost['post_id']; ?>">
                                    <div class="Pinned-Post my-2 px-2 py-2">
                                        <h5><i class="bi bi-chat-text-fill"></i> <?php echo htmlspecialchars($pinnedPost['title']); ?></h5>
                                        <p class="posted d-none d-md-block">Posted <?php echo time_elapsed_string($pinnedPost['created_at']); ?></p>
                                        <div class="d-none d-md-block">
                                            <i class="fa-solid fa-thumbs-up pinned-reactions"></i>
                                            <span class="pinned-reactions"><?php echo $pinnedPost['upvotes']; ?></span>
                                            <i class="fa-solid fa-thumbs-down pinned-reactions"></i>
                                            <span class="pinned-reactions"><?php echo $pinnedPost['downvotes']; ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="no-pinned-message">There are no pinned posts yet.</p>
                    <?php endif; ?>
                </div>
                <script>
                    document.getElementById('show-all-pinned').addEventListener('click', function(e) {
                        e.preventDefault();
                        var latestPost = document.getElementById('latest-pinned-post');
                        var allPosts = document.getElementById('all-pinned-posts');
                        if (allPosts.style.display === 'none') {
                            latestPost.style.display = 'none';
                            allPosts.style.display = 'block';
                        } else {
                            latestPost.style.display = 'block';
                            allPosts.style.display = 'none';
                        }
                    });
                </script>

            <div class="col-12 col-md-8 order-md-1 px-0 mx-3">
                <div class="Posts my-4 mt-md-4 p-0 p-sm-3 pb-0">
                    <div class="sort-container px-2 py-2 d-none d-md-block">
                        <a href="?sort=trending" class="trending-button <?php echo $sort === 'trending' ? 'active' : ''; ?>">Trending</a>   |  
                        <a href="?sort=latest" class="latest-button <?php echo $sort === 'latest' ? 'active' : ''; ?>">Latest</a>   |  
                        <a href="?sort=oldest" class="oldest-button <?php echo $sort === 'oldest' ? 'active' : ''; ?>">Oldest</a>
                    </div>
                    <div class="dropdown d-md-none position-fixed custom-dropdown" style="bottom: 50px; left: 20px;">
                        <button class="btn btn-secondary rounded-circle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                            <i class="bi bi-list"></i>
                        </button>
                        <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item <?php echo $sort === 'trending' ? 'active' : ''; ?>" href="?sort=trending">Trending</a></li>
                            <li><a class="dropdown-item <?php echo $sort === 'latest' ? 'active' : ''; ?>" href="?sort=latest">Latest</a></li>
                            <li><a class="dropdown-item <?php echo $sort === 'oldest' ? 'active' : ''; ?>" href="?sort=oldest">Oldest</a></li>
                        </ul>
                    </div>

                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <a href="Res-view-Post.php?id=<?php echo $post['post_id']; ?>">
                                <div class="Post my-3 px-3 py-3">
                                    <h3 class="fw-bold"><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <p><?php echo substr(htmlspecialchars($post['content']), 0, 100) . '...'; ?></p>
                                    <p class="posted mb-5"><i class="bi bi-clock"></i> Posted <?php echo time_elapsed_string($post['created_at']); ?></p>
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
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var carousels = document.querySelectorAll('.carousel');
                    carousels.forEach(function(carousel) {
                        new bootstrap.Carousel(carousel, {
                            interval: false
                        });
                    });
                });
            </script>
        </div>
        
    </div>
</main>
<script>
                document.addEventListener('DOMContentLoaded', function() {
                    var carousels = document.querySelectorAll('.carousel');
                    carousels.forEach(function(carousel) {
                        new bootstrap.Carousel(carousel, {
                            interval: false
                        });
                    });
                });
</script>
<script src="js/News.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var dropdownToggle = document.getElementById('sortDropdown');
    var dropdownMenu = dropdownToggle.nextElementSibling;

    document.querySelectorAll('.carousel-control-prev, .carousel-control-next').forEach(function(control) {
        control.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });


    dropdownToggle.addEventListener('click', function(e) {
        e.preventDefault();
        dropdownMenu.classList.toggle('show');
        this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'true' ? 'false' : 'true');
    });

    document.addEventListener('click', function(e) {
        if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
            dropdownToggle.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>