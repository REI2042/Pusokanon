<?php
include 'DBconn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['res_ID'];

    // Check if the user is the owner of the post
    $stmt = $pdo->prepare("SELECT res_id FROM user_posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post && $post['res_id'] == $user_id) {
        $title = $_POST['post_title'];
        $content = $_POST['post_body'];

        $current_approval_status = $_POST['current_approval_status'];
        $new_status = ($current_approval_status == 'rejected') ? 'resubmitted' : $current_approval_status;

        $stmt = $pdo->prepare("UPDATE user_posts SET title = ?, content = ?, approval_status = ? WHERE post_id = ?");
        $stmt->execute([$title, $content, $new_status, $post_id]);

        if (isset($_POST['remove_media'])) {
            $stmt = $pdo->prepare("SELECT media_type, media_path FROM user_posts_media WHERE media_id = ?");
            $deleteStmt = $pdo->prepare("DELETE FROM user_posts_media WHERE media_id = ?");
            
            foreach ($_POST['remove_media'] as $media_id) {
                $stmt->execute([$media_id]);
                $media = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($media) {
                    $file_path = $media['media_type'] === 'image' 
                        ? '../db/PostMedias/Images/' . $media['media_path']
                        : '../db/PostMedias/Videos/' . $media['media_path'];
                    
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                    
                    $deleteStmt->execute([$media_id]);
                }
            }
        }

        $uploaded_files = [];
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
                    $uploaded_files[] = [
                        'name' => $file_name,
                        'type' => $media_type,
                        'path' => $unique_filename
                    ];
                }
            }
        }

        $response = [
            'success' => true,
            'message' => 'Post updated successfully',
            'post_id' => $post_id,
            'uploaded_files' => $uploaded_files,
            'new_status' => $new_status
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'You do not have permission to update this post'
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}