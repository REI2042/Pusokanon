<?php
session_start();
include 'DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $res_id = $_SESSION['res_ID'];

    $stmt = $pdo->prepare("SELECT res_id FROM announcement_comments WHERE comment_id = ?");
    $stmt->execute([$comment_id]);
    $comment = $stmt->fetch();

    if ($comment && $comment['res_id'] == $res_id) {
        $delete_stmt = $pdo->prepare("DELETE FROM announcement_comments WHERE comment_id = ?");
        if ($delete_stmt->execute([$comment_id])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete comment']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'You are not authorized to delete this comment']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
