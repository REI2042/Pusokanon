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
            Swal.fire({
                icon: 'success',
                title: 'QR Code Scanned!',
                text: `Your QR Code: ${decodeText}`,
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(() => {
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

<?php include 'footerAdmin.php'; ?>