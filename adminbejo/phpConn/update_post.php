<?php
include '../../db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $title = $_POST['post_title'];
    $content = $_POST['post_body'];

    $stmt = $pdo->prepare("UPDATE announcement_posts SET title = ?, content = ? WHERE post_id = ?");
    $stmt->execute([$title, $content, $post_id]);

    if (isset($_POST['remove_media'])) {
        $stmt = $pdo->prepare("SELECT media_type, media_path FROM announcement_posts_media WHERE media_id = ?");
        $deleteStmt = $pdo->prepare("DELETE FROM announcement_posts_media WHERE media_id = ?");
        
        foreach ($_POST['remove_media'] as $media_id) {
            $stmt->execute([$media_id]);
            $media = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($media) {
                $file_path = $media['media_type'] === 'image' 
                    ? '../../db/PostMedias/Images/' . $media['media_path']
                    : '../../db/PostMedias/Videos/' . $media['media_path'];
                
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

            $upload_dir = $media_type === 'image' ? '../../db/PostMedias/Images/' : '../../db/PostMedias/Videos/';

            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $unique_filename = uniqid() . '.' . $file_ext;

            if (move_uploaded_file($tmp_name, $upload_dir . $unique_filename)) {
                $stmt = $pdo->prepare("INSERT INTO announcement_posts_media (post_id, media_type, media_path) VALUES (?, ?, ?)");
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
        'uploaded_files' => $uploaded_files
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}