<?php
session_start();
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    $stmt = $pdo->prepare("SELECT res_id FROM announcement_comments WHERE comment_id = ?");
    $stmt->execute([$comment_id]);
    $comment = $stmt->fetch();

    $delete_stmt = $pdo->prepare("DELETE FROM announcement_comments WHERE comment_id = ?");
    if ($delete_stmt->execute([$comment_id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete comment']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
