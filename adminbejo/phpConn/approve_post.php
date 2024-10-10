<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    try {
        $stmt = $pdo->prepare("UPDATE user_posts SET approval_status = 'approved' WHERE post_id = ?");
        $stmt->execute([$post_id]);

        $stmt = $pdo->prepare("SELECT title, res_id FROM user_posts WHERE post_id = ?");
        $stmt->execute([$post_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare("SELECT res_email, res_fname, res_lname FROM resident_users WHERE res_id = ?");
        $stmt->execute([$post['res_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'postTitle' => $post['title'],
            'userEmail' =>  decryptData($user['res_email']),
            'userName' => $user['res_fname'] . ' ' . $user['res_lname']
        ]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
