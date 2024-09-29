<?php
include '../../include/staff_restrict_pages.php';
include '../../db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['post_title'];
    $content = $_POST['post_body'];
    $staff_id = $_SESSION['staff_id'];

    $stmt = $pdo->prepare("INSERT INTO announcement_posts (staff_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$staff_id, $title, $content]);
    $post_id = $pdo->lastInsertId();

    if (!empty($_FILES['post_media']['name'][0])) {
        foreach ($_FILES['post_media']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['post_media']['name'][$key];
            $file_type = $_FILES['post_media']['type'][$key];

            $media_type = strpos($file_type, 'image') !== false ? 'image' : 'video';

            $upload_dir = $media_type === 'image' ? '../../db/PostMedias/Images/' : '../../db/PostMedias/Videos/';

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $unique_filename = uniqid() . '.' . $file_ext;

            if (move_uploaded_file($tmp_name, $upload_dir . $unique_filename)) {
                $stmt = $pdo->prepare("INSERT INTO announcement_posts_media (post_id, media_type, media_path) VALUES (?, ?, ?)");
                $stmt->execute([$post_id, $media_type, $unique_filename]);
            }
        }
    }

    header("Location: ../View-Post.php?id=" . $post_id);
    exit();
}
?>