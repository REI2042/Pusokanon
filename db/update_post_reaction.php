<?php
session_start();
include 'DBconn.php';

if (!isset($_SESSION['res_ID'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$res_id = $_SESSION['res_ID'];
$post_id = $_POST['post_id'];
$reaction_type = $_POST['reaction_type'];

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT reaction_type FROM user_posts_reactions WHERE post_id = ? AND res_id = ?");
    $stmt->execute([$post_id, $res_id]);
    $existingReaction = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingReaction) {
        if ($existingReaction['reaction_type'] === $reaction_type) {
            $stmt = $pdo->prepare("DELETE FROM user_posts_reactions WHERE post_id = ? AND res_id = ?");
            $stmt->execute([$post_id, $res_id]);
            $updateField = $reaction_type === 'upvote' ? 'upvotes = upvotes - 1' : 'downvotes = downvotes - 1';
        } else {
            $stmt = $pdo->prepare("UPDATE user_posts_reactions SET reaction_type = ? WHERE post_id = ? AND res_id = ?");
            $stmt->execute([$reaction_type, $post_id, $res_id]);
            $updateField = $reaction_type === 'upvote' ? 'upvotes = upvotes + 1, downvotes = downvotes - 1' : 'downvotes = downvotes + 1, upvotes = upvotes - 1';
        }
    } else {
        $stmt = $pdo->prepare("INSERT INTO user_posts_reactions (post_id, res_id, reaction_type) VALUES (?, ?, ?)");
        $stmt->execute([$post_id, $res_id, $reaction_type]);
        $updateField = $reaction_type === 'upvote' ? 'upvotes = upvotes + 1' : 'downvotes = downvotes + 1';
    }

    $stmt = $pdo->prepare("UPDATE user_posts SET $updateField WHERE post_id = ?");
    $stmt->execute([$post_id]);

    $pdo->commit();

    $stmt = $pdo->prepare("SELECT upvotes, downvotes FROM user_posts WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $updatedCounts = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT reaction_type FROM user_posts_reactions WHERE post_id = ? AND res_id = ?");
    $stmt->execute([$post_id, $res_id]);
    $userReaction = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'upvotes' => $updatedCounts['upvotes'],
        'downvotes' => $updatedCounts['downvotes'],
        'userReaction' => $userReaction ? $userReaction['reaction_type'] : null
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'An error occurred']);
}