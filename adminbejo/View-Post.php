<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "Invalid post ID";
        exit();
    }

    $post_id = $_GET['id'];

    $post = fetchPost($pdo, $post_id);

    if (!$post) {
        echo "Post not found";
        exit();
    }

    $media = fetchPostMedia($pdo, $post_id);

    $comments = fetchCommentsAnnouncements($pdo, $post['post_id']);
?>
<link rel="stylesheet" href="css/View-Post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <div class="row">
            <div class="Post px-4 py-4">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="Post-Announcements.php" class="back-button d-flex align-items-center text-dark gap-2" style="text-decoration: none; color: #2C7BD5;">
                        <i class="fas fa-circle-chevron-left fa-2x"></i>
                        <span>Back</span>
                    </a>
                    <button class="btn btn-link" type="button" id="postOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v dropdown"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="postOptionsDropdown" style="background-color: rgba(211, 211, 211, 0.8);">
                        <li>
                            <button id="pinPostButton" class="dropdown-item dropdown" data-post-id="<?php echo $post_id; ?>" data-is-pinned="<?php echo $post['pinned']; ?>">
                                <i class="fas fa-thumbtack me-2"></i><?php echo $post['pinned'] ? 'Unpin' : 'Pin'; ?>
                            </button>
                        </li>
                        <li><a class="dropdown-item dropdown" href="Edit-Post.php?id=<?php echo $post_id; ?>"><i class="fas fa-edit me-2"></i>Edit</a></li>
                        <li><button class="delete-button dropdown-item dropdown" data-post-id="<?php echo $post_id; ?>"><i class="fas fa-trash-alt me-2"></i>Delete</button></li>
                    </ul>
                </div>
                <h3 class="fw-bold mt-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <p class="posted"><i class="bi bi-clock me-2"></i>Posted on <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>
                
                <?php if (!empty($media)): ?>
                <div id="Post<?php echo $post_id; ?>" class="carousel slide d-flex" data-bs-interval="false">
                    <div class="carousel-indicators">
                        <?php foreach ($media as $index => $item): ?>
                            <button type="button" data-bs-target="#Post<?php echo $post_id; ?>" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner my-3">
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
                        <button class="carousel-control-prev" type="button" data-bs-target="#Post<?php echo $post_id; ?>" data-bs-slide="prev">
                            <i class="prev fa-solid fa-chevron-left" aria-hidden="true"></i>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#Post<?php echo $post_id; ?>" data-bs-slide="next">
                            <i class="next fa-solid fa-chevron-right" aria-hidden="true"></i>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="reactions mt-3">
                    <span class="reaction">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span class="count"><?php echo $post['upvotes']; ?></span>
                    </span>
                    <span class="reaction">
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span class="count"><?php echo $post['downvotes']; ?></span>
                    </span>
                </div>
                <div class="comments-section mt-2">
                <h4>Comments</h4>
                <div class="comments-section mt-2">
                    <div id="comments-container" style="max-height: 500px; overflow-y: scroll;">
                        <?php if (!empty($comments)): ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class='comment'>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="poster-info d-flex align-items-center m-1">
                                            <img src='<?php echo ($comment['profile_picture'] ? '../db/ProfilePictures/' . $comment['profile_picture'] : '../PicturesNeeded/blank_profile.png'); ?>' alt='Profile Picture' class='comment-profile-picture'>
                                            <strong><?php echo htmlspecialchars($comment['res_fname'] . ' ' . $comment['res_lname']); ?></strong>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-link" type="button" id="commentOptionsDropdown<?= $comment['comment_id'] ?>" data-comment-id="<?= $comment['comment_id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="commentOptionsDropdown<?= $comment['comment_id'] ?>">
                                                <li>
                                                    <button class="dropdown-item delete-comment-button" data-comment-id="<?= $comment['comment_id'] ?>"><i class="fas fa-trash-alt me-2"></i>Delete</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="pl-3"><?php echo htmlspecialchars($comment['comment_content']); ?></p>
                                    <small><?php echo date('F j, Y, g:i a', strtotime($comment['created_at'])); ?></small>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="no-comments">No comments yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>  
        </div>
    </section>
</div>
<script src="View-Post.js"></script>
<?php include 'footerAdmin.php'; ?>