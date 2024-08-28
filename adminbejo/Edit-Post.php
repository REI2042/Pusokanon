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
$media = fetchPostMedia($pdo, $post_id);

if (!$post) {
    echo "Post not found";
    exit();
}
?>

<link rel="stylesheet" href="css/Edit-Post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <form action="phpConn/update_post.php" method="POST" enctype="multipart/form-data">
            <div class="d-flex justify-content-between align-items-center">
                <a href="View-Post.php?id=<?php echo $post_id; ?>" class="back-button d-flex align-items-center text-dark gap-2">
                    <i class="fas fa-circle-chevron-left fa-2x"></i>
                    <span>Back</span>
                </a>
                <button class="btn btn-primary" type="submit">Update Post</button>
            </div>
            <div class="mt-5">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="post_title" class="form-label fw-bold">Title:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" id="post_title" name="post_title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="post_body" class="form-label fw-bold">Body:</label>
                    </div>
                    <div class="col-md-10">
                        <textarea id="post_body" name="post_body" class="form-control" rows="3" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="post_media" class="form-label fw-bold">Add New Media:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="file" id="post_media" name="post_media[]" accept="image/*, video/*" multiple class="form-control">
                        </div>
                    </div>
                </div>
                <div id="preview-container">
                    <?php if (!empty($media)): ?>
                        <div class="row">
                            <label class="fw-bold">Current Media:</label>
                            <div id="current-media-container" class="row">
                                <?php 
                                $count = 0;
                                foreach ($media as $item): 
                                    if ($count % 4 == 0 && $count != 0) {
                                        echo '</div><div class="row">';
                                    }
                                ?>
                                    <div class="col-md-3 media-item">
                                        <div class="media-wrapper mb-2">
                                            <?php if ($item['media_type'] === 'image'): ?>
                                                <img src="../db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" alt="Post Image" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                            <?php elseif ($item['media_type'] === 'video'): ?>
                                                <video controls style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                    <source src="../db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php endif; ?>
                                                <input type="checkbox" name="remove_media[]" value="<?php echo $item['media_id']; ?>" id="remove_<?php echo $item['media_id']; ?>" style="display: none;">
                                                <label for="remove_<?php echo $item['media_id']; ?>" class="remove-media-btn" style="cursor: pointer;">
                                                    <i class="fas fa-times remove-btn"></i>
                                                </label>
                                                <script>
                                                    document.getElementById('remove_<?php echo $item['media_id']; ?>').addEventListener('change', function() {
                                                        if (this.checked) {
                                                            this.closest('.media-item').style.display = 'none';
                                                        }
                                                    });
                                                </script>
                                        </div>
                                    </div>
                                <?php 
                                    $count++;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </section>
</div>
<script src="Edit-Post.js"></script>
<?php include 'footerAdmin.php'; ?>