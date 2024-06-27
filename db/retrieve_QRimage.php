<?php
    session_start();

    require_once 'DBconn.php'; // Adjust the path as per your file structure
    
    // Assuming you have the request ID in the URL parameter or as a variable
    $request_id = $_GET['request_id']; // Adjust based on how you retrieve the request ID
    
    // Fetch QR code filename from database based on request ID
    $sql = "SELECT qrCode_image FROM request_doc WHERE request_id = :request_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
    $stmt->execute();
    $qrCodeImage = $stmt->fetchColumn();
    
    // Check if QR code image filename exists
    if ($qrCodeImage) {
        $qrcodePath = 'QRCODES/' . $qrCodeImage; // Path to QR code image
    
        // Check if file exists before displaying
        if (file_exists($qrcodePath)) {
            echo "<img src='$qrcodePath' class='image_holder' alt='User_Document'>";
        } else {
            echo "QR code image not found.";
        }
    } else {
        echo "No QR code image found for this request ID.";
    }
?>