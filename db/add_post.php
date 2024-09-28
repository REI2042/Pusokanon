<?php
include '../db/DBconn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['post_title'];
    $content = $_POST['post_body'];
    $res_id = $_SESSION['res_ID'];

    $stmt = $pdo->prepare("INSERT INTO user_posts (res_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$res_id, $title, $content]);
    $post_id = $pdo->lastInsertId();

    if (!empty($_FILES['post_media']['name'][0])) {
        foreach ($_FILES['post_media']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['post_media']['name'][$key];
            $file_type = $_FILES['post_media']['type'][$key];

            $media_type = strpos($file_type, 'image') !== false ? 'image' : 'video';

            $upload_dir = $media_type === 'image' ? '../db/PostMedias/Images/' : '../db/PostMedias/Videos/';

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $unique_filename = uniqid() . '.' . $file_ext;

            if (move_uploaded_file($tmp_name, $upload_dir . $unique_filename)) {
                $stmt = $pdo->prepare("INSERT INTO user_posts_media (post_id, media_type, media_path) VALUES (?, ?, ?)");
                $stmt->execute([$post_id, $media_type, $unique_filename]);
            }
        }
    }

    // header("Location: ../view-post.php?id=" . $post_id);
    header("Location: ../Forum.php");
    exit();
}
?>