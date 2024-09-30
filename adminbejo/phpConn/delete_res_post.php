<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? null;

    if ($post_id !== null) {
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare("SELECT media_type, media_path FROM user_posts_media WHERE post_id = ?");
            $stmt->execute([$post_id]);
            $media = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($media as $item) {
                $file_path = $item['media_type'] === 'image' 
                    ? '../../db/PostMedias/Images/' . $item['media_path']
                    : '../../db/PostMedias/Videos/' . $item['media_path'];
                
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            $stmt = $pdo->prepare("DELETE FROM user_posts_media WHERE post_id = ?");
            $stmt->execute([$post_id]);

            $stmt = $pdo->prepare("DELETE FROM user_posts WHERE post_id = ?");
            $stmt->execute([$post_id]);

            $pdo->commit();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'error' => 'Failed to delete post: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid post ID']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}