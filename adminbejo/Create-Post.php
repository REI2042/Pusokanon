<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';
    
?>
<link rel="stylesheet" href="css/Create-Post.css">
<div class="container fluid d-flex justify-content-center">
    <section class="main">
        <a href="Post-Announcements.php" class="back-button d-flex align-items-center text-dark gap-2">
            <i class="fas fa-circle-chevron-left fa-2x"></i>
            <span>Back</span>
        </a>
        <form action="phpConn/Add-Post.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <label for="post_title">Title:</label>
                <input type="text" id="post_title" name="post_title" required>
            </div>
            <div class="row">
                <label for="post_body">Body:</label>
                <textarea id="post_body" name="post_body" rows="8"  cols="6" required></textarea>
            </div>
            <div class="row">
                <label for="myfile">Select files:</label>
                <input type="file" id="post_media" name="post_media[]" accept="image/*, video/*" multiple>
            </div>
            <div id="preview-container"></div>
            <button type="submit">Post</button>
        </form>
    </section>
</div>
<script src="Create-Post.js"></script>
<?php include 'footerAdmin.php'; ?>