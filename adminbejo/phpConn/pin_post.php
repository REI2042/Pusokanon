<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? null;
    $pin = $_POST['pin'] ?? null;

    if ($post_id !== null && $pin !== null) {
        
        $stmt = $pdo->prepare("SELECT COUNT(*) AS pinned_count FROM posts WHERE pinned = 1");
        $stmt->execute();
        $pinned_count = $stmt->fetchColumn();

        if ($pinned_count >= 5 && $pin == 1) {
            echo json_encode(['success' => false, 'error' => 'Maximum number of pinned posts reached']);
            exit();
        }

        $stmt = $pdo->prepare("UPDATE posts SET pinned = ? WHERE post_id = ?");
        $result = $stmt->execute([$pin, $post_id]);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}