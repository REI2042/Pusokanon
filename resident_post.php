<?php
    include 'include/header.php';
    include 'db/DBconn.php';

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "Invalid post ID";
        exit();
    }
    
    $post_id = $_GET['id']; 

    $post = fetchResidentPost($pdo, $post_id);
    $poster = fetchPosterDetails($pdo, $post['res_id']);
    $media = fetchResidentPostMedia($pdo, $post_id);

    $userReaction = getResidentReaction($pdo, $post_id, $_SESSION['res_ID']);

    if (!$post) {
        echo "Post not found";
        exit();
    }

    $isOwner = ($_SESSION['res_ID'] == $post['res_id']);

    if (isset($_GET['ref'])) {
        $_SESSION['post_referrer'] = $_GET['ref'];
    }

    $comments = fetchComments($pdo, $post['post_id']);
?>
<link rel="stylesheet" href="css/resident_post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <div class="row my-3 mx-1">
            <div class="Post p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="back-container">
                        <a href="<?php echo isset($_SESSION['post_referrer']) && $_SESSION['post_referrer'] == 'own-posts' ? 'view-own-posts.php' : 'Forum.php'; ?>" class="back-button d-flex align-items-center gap-2 mb-3" style="text-decoration: none; color: #2C7BD5;">
                            <i class="fas fa-circle-chevron-left fa-2x"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="dropdown">
                        <?php if ($isOwner): ?>
                            <?php if ($post['approval_status'] !== 'approved'): ?>
                                <button class="btn btn-link" type="button" id="postOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="postOptionsDropdown">
                                    <?php if ($post['approval_status'] !== 'resubmitted'): ?>
                                        <li><a class="dropdown-item" href="edit_resident_post.php?id=<?php echo $post_id; ?>"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                    <?php endif; ?>
                                    <li><button class="dropdown-item delete-button" data-post-id="<?php echo $post_id; ?>"><i class="fas fa-trash-alt me-2"></i>Delete</button></li>
                                </ul>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($post['approval_status'] == 'rejected'): ?>
                    <div class="alert alert-warning" role="alert">
                        <strong>This post has been rejected and won't appear in the forum.</strong><br>
                        Reason: <?php echo htmlspecialchars($post['rejection_reason']); ?><br>
                        Please edit and resubmit your post.
                    </div>
                <?php elseif ($post['approval_status'] == 'resubmitted'): ?>
                    <div class="alert alert-success" role="alert">
                        Your post has been resubmitted! We’ll notify you via email once it’s approved. Thank you!
                    </div>
                <?php elseif ($post['approval_status'] == 'pending'): ?>
                    <div class="alert alert-success" role="alert">
                        This post is pending for approval. We’ll notify you via email once it’s approved. Thank you!
                    </div>
                <?php endif; ?>
                <img src="<?php echo $poster['profile_picture'] ? 'db/ProfilePictures/' . $poster['profile_picture'] : 'PicturesNeeded/blank_profile.png'; ?>" alt="Profile Picture" class="profile-picture">
                <span class="poster-name"><?php echo htmlspecialchars($poster['res_fname'] . ' ' . $poster['res_lname']); ?></span>
                <h3 class="fw-bold ml-3"><?php echo htmlspecialchars($post['title']); ?></h3>
                <p class="ml-3"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <p class="posted mt-3"><i class="far fa-clock"></i> Posted on <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>
                
                <?php if (!empty($media)): ?>
                <div id="Post<?php echo $post_id; ?>" class="carousel slide d-flex" data-bs-interval="false">
                    <div class="carousel-indicators">
                        <?php foreach ($media as $index => $item): ?>
                            <button type="button" data-bs-target="#Post<?php echo $post_id; ?>" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner my-5">
                        <?php foreach ($media as $index => $item): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <?php if ($item['media_type'] === 'image'): ?>
                                    <img src="db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" class="image" alt="Post Image">
                                <?php elseif ($item['media_type'] === 'video'): ?>
                                    <video class="video" controls autoplay muted loop>
                                        <source src="db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
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
                <?php if ($post['approval_status'] == 'approved'): ?>
                    <div class="reactions">
                        <span class="reaction">
                            <button class="btn upvote-btn <?php echo ($userReaction && $userReaction['reaction_type'] === 'upvote') ? 'active' : ''; ?>" data-post-id="<?php echo $post['post_id']; ?>">
                                <i class="fa-solid fa-thumbs-up"></i>
                            </button>
                            <span class="count upvote-count"><?php echo $post['upvotes']; ?></span>
                        </span>
                        <span class="reaction">
                            <button class="btn downvote-btn <?php echo ($userReaction && $userReaction['reaction_type'] === 'downvote') ? 'active' : ''; ?>" data-post-id="<?php echo $post['post_id']; ?>">
                                <i class="fa-solid fa-thumbs-down"></i>
                            </button>
                            <span class="count downvote-count"><?php echo $post['downvotes']; ?></span>
                        </span>
                    </div>
                    <div class="comments-section mt-2">
                        <form action="db/add_comment_post.php" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-10">
                                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                                    <textarea name="comment_text" class="form-control" required placeholder="Write a comment..."></textarea>
                                </div>
                                <div class="col-md-2 d-flex align-items-center">
                                    <button class="submit-comment m-1" type="submit">Add Comment</button>
                                </div>
                            </div>
                        </form>
                        <h4>Comments</h4>
                        <div id="comments-container" style="max-height: 500px; overflow-y: scroll;">
                            <?php if (!empty($comments)): ?>
                                <?php foreach ($comments as $comment): ?>
                                    <div class='comment'>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="poster-info d-flex align-items-center m-1">
                                                <img src='<?php echo ($comment['profile_picture'] ? 'db/ProfilePictures/' . $comment['profile_picture'] : 'PicturesNeeded/blank_profile.png'); ?>' alt='Profile Picture' class='comment-profile-picture'>
                                                <strong><?php echo htmlspecialchars($comment['res_fname'] . ' ' . $comment['res_lname']); ?></strong>
                                            </div>
                                            <?php $isCommentOwner = ($_SESSION['res_ID'] == $comment['res_id']); ?>
                                            <?php if ($isCommentOwner): ?>
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
                                            <?php endif; ?>
                                        </div>
                                        <p><?php echo htmlspecialchars($comment['comment_content']); ?></p>
                                        <small><?php echo date('F j, Y, g:i a', strtotime($comment['created_at'])); ?></small>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="no-comments">No comments yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<script src="js/resident-post.js"></script>
	    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
