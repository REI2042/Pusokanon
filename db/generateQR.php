<?php
session_start();

require_once '../phpqrcode/qrlib.php';
require_once 'DBconn.php';



$request_id = $_SESSION['last_request_id'];
$userData = fetchSpecificRequest($pdo, $request_id);




if ($userData) {
    $qrData = json_encode([
        'doc_ID' => $userData['document_id'],
        'res_id' => $userData['resident_id'],
        'request_id' => $userData['request_id'],
        'resident_name' => $userData['resident_name'],
        'doc_name' => $userData['document_name'],
        'stat'=> 'Ready to pickup',
        'remarks'=>$userData['remarks'],
        'purpose' => $userData['purpose'],
        'date_req' => $userData['request_date']
    ]);

    $path = 'QRCODES/';
    $qrcodeName = time() . '.png';  
    $qrcodePath = $path . $qrcodeName;

    QRcode::png($qrData, $qrcodePath, 'L', 4, 4);

    if (file_exists($qrcodePath)) {
        echo "<img src='" . $qrcodePath . "'><br>";  

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
    error_log("No data found for user with res_id: " . $res_id);
    echo "Error: No data found for the user.";
}?>
