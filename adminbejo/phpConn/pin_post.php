<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'] ?? null;
    $pin = $_POST['pin'] ?? null;

    if ($post_id !== null && $pin !== null) {
        
        $stmt = $pdo->prepare("SELECT COUNT(*) AS pinned_count FROM announcement_posts WHERE pinned = 1");
        $stmt->execute();
        $pinned_count = $stmt->fetchColumn();

        if ($pinned_count >= 5 && $pin == 1) {
            echo json_encode(['success' => false, 'error' => 'Maximum number of pinned posts reached']);
            exit();
        }

        $stmt = $pdo->prepare("UPDATE announcement_posts SET pinned = ? WHERE post_id = ?");
        $result = $stmt->execute([$pin, $post_id]);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Database update failed']);
        }
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Pinpost'])) {
        $post_id = $_POST['post_id'];
        $pinpost = $_POST['Pinpost'];
    
        $sql = "UPDATE announcement_posts SET pinned = :pinpost  WHERE post_id = :post_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':pinpost', $pinpost , PDO::PARAM_INT);
        $stmt->execute();
    
        header('location:../Post-Announcements.php');
        
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    }
    
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
}