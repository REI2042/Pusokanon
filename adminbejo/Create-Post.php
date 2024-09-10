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
            <a href="Post-Announcements.php" class="back-button d-flex align-items-center text-dark gap-2 mb-3" style="text-decoration: none; color: #2C7BD5;">
                <i class="fas fa-circle-chevron-left fa-2x"></i>
                <span>Back</span>
            </a>
                <p class="text-center h2">Create Post</p>
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
                            <textarea id="post_body" name="post_body" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="post_media">Select files:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="file" id="post_media" name="post_media[]" accept="image/*, video/*" multiple class="form-control">
                            <div class="file-input-help">
                                Click to add more files. Hold Ctrl to select multiple files, or Shift to select a range.
                            </div>
                        </div>
                    </div>                
                    <div id="preview-container" class="preview-container">
                    </div>
                    <div class="button-container text-center">
                        <button class="submit-post" type="submit">Post</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="Create-Post.js"></script>
<?php include 'footerAdmin.php'; ?>