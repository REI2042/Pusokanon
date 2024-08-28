<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';
    
?>
<link rel="stylesheet" href="css/Create-Post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <div class="mt-5">
            <form action="phpConn/Add-Post.php" method="POST" enctype="multipart/form-data">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="Post-Announcements.php" class="back-button d-flex align-items-center text-dark gap-2">
                        <i class="fas fa-circle-chevron-left fa-2x"></i>
                        <span>Back</span>
                    </a>
                    <button class="btn btn-primary" type="submit">Post</button>
                </div>
                <div class="mt-5">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="post_title">Title:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" id="post_title" name="post_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="post_body">Body:</label>
                        </div>
                        <div class="col-md-10">
                            <textarea id="post_body" name="post_body" rows="8" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="post_media">Select files:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="file" id="post_media" name="post_media[]" accept="image/*, video/*" multiple class="form-control">
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
        </div>
    </section>
</div>
<script src="Create-Post.js"></script>
<?php include 'footerAdmin.php'; ?>