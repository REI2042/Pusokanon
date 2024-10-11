<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $reason = $_POST['reason'];

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("UPDATE user_posts SET approval_status = 'rejected', rejection_reason = :reason WHERE post_id = :post_id");
        $stmt->execute(['post_id' => $post_id, 'reason' => $reason]);

        $stmt = $pdo->prepare("SELECT rp.title, ru.res_fname, ru.res_lname, ru.res_email 
                               FROM user_posts rp 
                               JOIN resident_users ru ON rp.res_id = ru.res_id 
                               WHERE rp.post_id = :post_id");
        $stmt->execute(['post_id' => $post_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo->commit();

        echo json_encode([
            'success' => true,
            'userEmail' => decryptData($post['res_email']),
            'userName' => $post['res_fname'] . ' ' . $post['res_lname'],
            'postTitle' => $post['title']
        ]);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
