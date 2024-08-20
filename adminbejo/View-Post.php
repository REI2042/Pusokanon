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
?>
<link rel="stylesheet" href="css/View-Post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <div class="row">
            <a href="Post-Announcements.php" class="back-button d-flex align-items-center text-dark gap-2">
                <i class="fas fa-circle-chevron-left fa-2x"></i>
                <span>Back</span>
            </a>
            <button id="pinPostButton" class="pin-button" data-post-id="<?php echo $post_id; ?>" data-is-pinned="<?php echo $post['pinned']; ?>">
                <?php echo $post['pinned'] ? 'Unpin Post' : 'Pin Post'; ?>
            </button>
            <div class="Post">
                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <p>Posted on <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></p>
                
                <?php if (!empty($media)): ?>
                <div id="Post<?php echo $post_id; ?>" class="carousel slide d-flex" data-bs-interval="false">
                    <div class="carousel-indicators">
                        <?php foreach ($media as $index => $item): ?>
                            <button type="button" data-bs-target="#Post<?php echo $post_id; ?>" data-bs-slide-to="<?php echo $index; ?>" <?php echo $index === 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo $index + 1; ?>"></button>
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

                <div class="reactions">
                    <span class="reaction">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span class="count"><?php echo $post['upvotes']; ?></span>
                    </span>
                    <span class="reaction">
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span class="count"><?php echo $post['downvotes']; ?></span>
                    </span>
                </div>
            </div>  
            <div class="">
                <a href="#"><button class="edit-button">Edit Post</button></a>
                <a href="#"><button class="delete-button">Delete Post</button></a>
            </div>
        </div>
    </section>
</div>
<script src="View-Post.js"></script>
<?php include 'footerAdmin.php'; ?>