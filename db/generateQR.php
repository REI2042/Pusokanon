<?php
session_start();

require_once '../phpqrcode/qrlib.php';
require_once 'DBconn.php';

// Assuming you have a session variable for resident ID
$res_id = $_SESSION['res_ID'];

// Fetch user data based on resident ID
$userData = fetchLatestRequest($pdo, $res_id);

if ($userData) {
    // Generate QR code data in JSON format
    $qrData = json_encode([
        'doc_ID' => $userData['document_id'],
        'res_id' => $userData['resident_id'],
        'request_id' => $userData['request_id'],
        'resident_name' => $userData['resident_name'],
        'doc_name' => $userData['document_name'],
        'purpose' => $userData['purpose'],
        'date_req' => $userData['request_date']
    ]);

    $path = 'QRCODES/';
    $qrcodeName = time() . '.png';  // Generate a unique filename for the QR code
    $qrcodePath = $path . $qrcodeName;

    QRcode::png($qrData, $qrcodePath, 'L', 4, 4);

    if (file_exists($qrcodePath)) {
        echo "<img src='" . $qrcodePath . "'><br>";  // Display the QR code image

        // Update database with QR code filename
        $sql = "UPDATE request_doc SET qrCode_image = :qrcodeName WHERE request_id = :request_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':qrcodeName', $qrcodeName, PDO::PARAM_STR);
        $stmt->bindParam(':request_id', $userData['request_id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirect after successful update
            header('Location: ../document.php');
            exit();
        } else {
            echo "Error updating QR code image filename.";
            print_r($stmt->errorInfo());
        }
    } else {
        echo "Failed to generate QR code or save file.";
    }
} else {
    echo "No data found for this user.";
}
?>
