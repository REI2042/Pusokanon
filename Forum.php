<?php
    include 'include/header.php';
    include 'db/DBconn.php';

    date_default_timezone_set('Asia/Manila');

    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'trending';

    $pinnedPosts = fetchPinnedPosts($pdo);
    $posts = fetchAllResidentPosts($pdo, $sort);

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
<link rel="stylesheet" href="css/Forum.css">
<div class="container-fluid d-flex justify-content-center">
    <section class="main">
        <div class="row">
            <div class="col-12 px-2" id="actionsContainer">
            </div>
            <div class="col-12 col-md-4 order-md-2 p-2 p-md-3">
                <div class="kuan">
                    <div id="actionsDiv" class="Actions d-flex justify-content-between">
                        <a href="">
                            <button class="btn btn-primary">View Your Post(s)</button>
                        </a>
                        <a href="Announcement.php">
                            <button class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back to Announcements</button>
                        </a>
                        </button>
                    </div>
                    <div class="Pinned-Posts">
                        <h5 class="fw-bold d-flex justify-content-center align-items-center">
                                <span class="d-flex align-items-center">
                                    Barangay Announcements
                                    <i class="fa-solid fa-bullhorn ms-2 text-black small"></i>
                                </span>
                        </h5>
                        <?php if (!empty($pinnedPosts)): ?>
                        <?php foreach ($pinnedPosts as $pinnedPost): ?>
                            <a href="Res-view-Post.php?id=<?php echo $pinnedPost['post_id']; ?>">
                                <div class="Pinned-Post my-2 mx-1 px-2 py-2">
                                    <h6 class="post-title"><i class="bi bi-chat-text-fill pin-title"></i> <?php echo htmlspecialchars($pinnedPost['title']); ?></h6>
                                    <p class="posted small">Posted <?php echo time_elapsed_string($pinnedPost['created_at']); ?></p>
                                    <div class="d-none d-md-block">
                                            <i class="fa-solid fa-thumbs-up pinned-reactions"></i>
                                            <span class="pinned-reactions"><?php echo $pinnedPost['upvotes']; ?></span>
                                            <i class="fa-solid fa-thumbs-down pinned-reactions"></i>
                                            <span class="pinned-reactions"><?php echo $pinnedPost['downvotes']; ?></span>
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
            <div class="col-12 col-md-8 order-md-1 px-0 px-md-3">
                <div class="Posts my-4 mt-md-4 p-0 p-sm-3 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="m-2">Residents Forum</h3>
                        <a href="create_post.php" class="m-2 float-right">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Create Post</button>
                        </a>
                    </div>
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
                              <a href="resident_post.php?id=<?php echo $post['post_id']; ?>">
                                  <div class="Post my-2 px-3 py-3">
                                      <div class="post-header d-flex align-items-center mb-2">
                                          <img src="<?php echo $post['profile_picture'] ? 'db/ProfilePictures/' . htmlspecialchars($post['profile_picture']) : 'PicturesNeeded/blank_profile.png'; ?>" alt="Profile Picture" class="profile-picture mr-2" style="width: 40px; height: 40px; border-radius: 50%;">
                                          <span class="poster-name"><?php echo htmlspecialchars($post['res_fname'] . ' ' . $post['res_lname']); ?></span>
                                      </div>
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
    </section>
</div>
<script src="js/Forum.js"></script>
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

<script>
    function moveActionsDiv() {
        var actionsDiv = document.getElementById('actionsDiv');
        var actionsContainer = document.getElementById('actionsContainer');
        var targetElement = actionsContainer.querySelector('.col-12.col-md-4.order-md-2.p-2.p-md-3');
        var originalParent = actionsDiv.parentNode;

        if (window.innerWidth <= 768) {
            if (actionsDiv.parentNode !== actionsContainer) {
                actionsContainer.insertBefore(actionsDiv, targetElement);
            }
        } else {
            if (actionsDiv.parentNode === actionsContainer) {
                originalParent.appendChild(actionsDiv);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', moveActionsDiv);
    window.addEventListener('resize', moveActionsDiv);
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  