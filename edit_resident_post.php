<?php
    include 'include/header.php';
    include 'db/DBconn.php';

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        echo "Invalid post ID";
        exit();
    }

    $post_id = $_GET['id'];
    $post = fetchResidentPost($pdo, $post_id);
    $media = fetchResidentPostMedia($pdo, $post_id);

    if (!$post) {
        echo "Post not found";
        exit();
    }

    $referrer = isset($_SESSION['post_referrer']) ? $_SESSION['post_referrer'] : 'forum';
?>

<link rel="stylesheet" href="css/edit-post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main" style="width: -webkit-fill-available;">
        <div class="edit-container">
            <form action="phpConn/update-post.php" method="POST" enctype="multipart/form-data">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="resident_post.php?id=<?php echo $post_id; ?>&ref=<?php echo $referrer; ?>" class="back-button d-flex align-items-center text-dark gap-2">
                        <i class="fas fa-circle-chevron-left fa-2x"></i>
                        <span>Back</span>
                    </a>
                    <?php if ($post['approval_status'] == 'pending'): ?>
                        <button class="btn btn-primary" type="submit">Update Post</button>
                    <?php elseif ($post['approval_status'] == 'rejected'): ?>
                        <button class="btn" style="background-color: #f57c00;" type="submit">Re-submit Post</button>
                    <?php endif; ?>
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
                                <div class="file-input-help">
                                    Click to add more files. Hold Ctrl to select multiple files, or Shift to select a range.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="preview-container"></div>
                    <?php if (!empty($media)): ?>
                        <div class="row">
                            <label class="fw-bold mt-2">Current Media:</label>
                            <div id="current-media-container" class="row">
                                <?php foreach ($media as $item): ?>
                                    <div class="col-md-3 media-item">
                                        <div class="media-wrapper mb-2">
                                            <?php if ($item['media_type'] === 'image'): ?>
                                                <img src="db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" alt="Post Image">
                                            <?php elseif ($item['media_type'] === 'video'): ?>
                                                <video controls style="object-fit: cover;">
                                                    <source src="db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php endif; ?>
                                            <input type="checkbox" name="remove_media[]" value="<?php echo $item['media_id']; ?>" id="remove_<?php echo $item['media_id']; ?>" style="display: none;">
                                            <label for="remove_<?php echo $item['media_id']; ?>" class="remove-media-btn" style="cursor: pointer;"><i class="fas fa-times remove-btn"></i></label>
                                            <script>
                                                document.getElementById('remove_<?php echo $item['media_id']; ?>').addEventListener('change', function() {
                                                    if (this.checked) {
                                                        this.closest('.media-item').style.display = 'none';
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="js/edit-post.js"></script>
<?php include'include/footer.php'?>