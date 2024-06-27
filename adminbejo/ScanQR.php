<?php
include 'headerAdmin.php';
?>

<link rel="stylesheet" href="css/document.css">
<script src="https://unpkg.com/html5-qrcode"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <h1 class="title">SCAN QR CODE</h1>
        </div>
    </div>

    <div class="row d-flex justify-content-end mr-2">
        <div class="col-12 col-md-4 d-flex justify-content-end p-0">
            <a href="Admin-Document.php" class="back-button">
                <i class="fa-solid fa-circle-chevron-left fa-2x"></i>
                <span>Back</span>
            </a>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="scanner-container">
            <div id="my-qr-reader"></div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-3">
        <div class="col-12 col-md-6">
            <p id="qr-content" class="text-center"></p>
        </div>
    </div>
</div>

<script>
let qrCodeScanned = false;
let htmlscanner;

function domReady(fn) {
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1000);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

domReady(function () {
    function onScanSuccess(decodeText, decodeResult) {
        if (!qrCodeScanned) {
            const [doc_ID, request_ID] = decodeText.split(',');

            Swal.fire({
                icon: 'success',
                title: 'QR Code Scanned!',
                text: `Doc ID: ${doc_ID}, Request ID: ${request_ID}`,
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(() => {
                // AJAX call to update the remarks
                $.ajax({
                    url: 'phpConn/updateRemarks.php',
                    type: 'POST',
                    data: { doc_ID: doc_ID, request_ID: request_ID },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.stat === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Remarks Updated!',
                                text: 'The document status has been updated to released.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Redirect to Barangay-Residency.php after successful update
                                window.location.href = 'Barangay-Residency.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Update Failed',
                                text: 'There was an error updating the document status.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: 'There was an error updating the document status.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        });
                    }
                });
                qrCodeScanned = false;
                htmlscanner.render(onScanSuccess);
            });
            qrCodeScanned = true;
        }
    }

    htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { fps: 10, qrbox: 250 }
    );

    htmlscanner.render(onScanSuccess);
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php include 'footerAdmin.php'; ?>
