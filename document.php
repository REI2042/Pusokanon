<?php
    include 'include/res_restrict_pages.php';
    require_once 'include/header.php';
    require_once 'db/DBconn.php';

    
    $res_id = $_SESSION['res_ID'];

    // Fetch user data based on resident ID
    $userData = fetchLatestRequest($pdo, $res_id);
    
    $qrcodePath = '';
    if ($userData) {
        // Retrieve the QR code filename from the database
        $request_id = $userData['request_id'];
        $sql = "SELECT qrCode_image FROM request_doc WHERE request_id = :request_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $qrcodeName = $result['qrCode_image'];
                $qrcodePath = 'db/QRCODES/' . $qrcodeName;

                // Check if the QR code image file exists
                if (!file_exists($qrcodePath)) {
                    $qrcodePath = '';
                }
            }
        }
    }

    if ($userData) {
        $resident_name = htmlspecialchars($userData['resident_name']);
        $sitio = htmlspecialchars($userData['sitio']);
        $purpose = htmlspecialchars($userData['purpose']);
        $document_name = htmlspecialchars($userData['document_name']);

    
    }
?>


<link rel="stylesheet" href="css/document.css">

<div class="container-fluid mb-5">
    <h1 class="mt-3">Request Document</h1>
    <hr class="bg-dark">
    <div class="docs row">
        <div class="col-12 w-25 d-flex justify-content-start">
            <a href="requestDocument.php" class="back-button">
                <i class="fa-solid fa-circle-chevron-left fa-2x" style="color: #2C7BD5;"></i>
            </a>
        </div>
        <div class="userdocbox col-12 col-md-6 d-flex justify-content-center">
            <img src="PicturesNeeded/SampleDocument.jpg" class="userdoc" alt="User_Document">
        </div>
        <div class="col-12 col-md-6 d-flex flex-column pl-1 pe-5 pb-3">
            <div class="row justify-content-center">
                <?php
                if ($qrcodePath) {
                    echo '<img src="' . $qrcodePath . '" alt="QR Code for request ID ' . $request_id . '" class="image_holder">';
                } else {
                    echo 'QR code image not found for request ID ' . $request_id;
                }
                ?>
            </div>
            <div class="row text-center">
                <h2><b><?php echo $document_name; ?></b></h2>
            </div>
            <div class="row text-center text-justify">
                <p class="description text-justify"> This QR Code serves as verification that <b><?php echo $resident_name; ?></b>, a resident of <b>Sitio <?php echo $sitio; ?>, Pusok, Lapu-lapu City</b> has successfully obtained and filled out the necessary forms through the
                    online Barangay portal for the purpose of <b><?php echo $purpose; ?></b>.
                </p>

                <p class="description text-justify"><i>Note: Please save this QR code, as this will be needed in order to claim the requested document.</i>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
    require_once 'include/footer.php';
?>
