<?php
session_start();
include 'DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['res_ID'])) {
    $post_id = $_POST['post_id'];
    $comment_content = $_POST['comment_text'];
    $res_id = $_SESSION['res_ID'];

    $stmt = $pdo->prepare("INSERT INTO announcement_comments (post_id, res_id, comment_content) VALUES (?, ?, ?)");
    $success = $stmt->execute([$post_id, $res_id, $comment_content]);

    header("Location: ../Res-view-Post.php?id=" . $post_id);
    exit();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}