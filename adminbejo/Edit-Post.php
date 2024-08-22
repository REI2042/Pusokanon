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
        <a href="View-Post.php?id=<?php echo $post_id; ?>" class="back-button d-flex align-items-center text-dark gap-2">
            <i class="fas fa-circle-chevron-left fa-2x"></i>
            <span>Back</span>
        </a>
        <form action="phpConn/update_post.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <div class="row">
                <label for="post_title">Title:</label>
                <input type="text" id="post_title" name="post_title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            <div class="row">
                <label for="post_body">Body:</label>
                <textarea id="post_body" name="post_body" rows="8" cols="6" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            <div class="row">
                <label for="post_media">Add New Media:</label>
                <input type="file" id="post_media" name="post_media[]" accept="image/*, video/*" multiple>
            </div>
            <div id="preview-container"></div>
            <?php if (!empty($media)): ?>
                <div class="row">
                    <label>Current Media:</label>
                    <div id="current-media-container">
                        <?php foreach ($media as $item): ?>
                            <div class="media-item">
                                <?php if ($item['media_type'] === 'image'): ?>
                                    <img src="../db/PostMedias/Images/<?php echo htmlspecialchars($item['media_path']); ?>" alt="Post Image">
                                <?php elseif ($item['media_type'] === 'video'): ?>
                                    <video controls>
                                        <source src="../db/PostMedias/Videos/<?php echo htmlspecialchars($item['media_path']); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php endif; ?>
                                <div class="remove-media">
                                    <input type="checkbox" name="remove_media[]" value="<?php echo $item['media_id']; ?>" id="remove_<?php echo $item['media_id']; ?>">
                                    <label for="remove_<?php echo $item['media_id']; ?>">Remove</label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <button type="submit">Update Post</button>
        </form>
    </section>
</div>
<script src="Edit-Post.js"></script>
<?php include 'footerAdmin.php'; ?>