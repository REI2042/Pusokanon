<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? null;

    if ($post_id !== null) {
        $stmt = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
        $result = $stmt->execute([$post_id]);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Post deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete post']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid post ID']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}