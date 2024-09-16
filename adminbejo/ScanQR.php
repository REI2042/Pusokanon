<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';
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

    <div class="row d-flex justify-content-center scan-con">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        console.log("Scanned Text: ", decodeText);

        if (!qrCodeScanned) {
            try {
                let data = JSON.parse(decodeText);
                console.log("Parsed Data: ", data);
                let { doc_ID, res_id, request_id, stat, remarks } = data;

                htmlscanner.clear(); // Stop the scanning process

                fetch('phpConn/updateRemarks.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.stat === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Update Successful',
                            text: 'The remarks have been updated.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then((alertResult) => {
                            if (alertResult.isConfirmed) {
                                let redirectUrl = `Document-requestHistory.php?doctype=${result.doc_name}`;
                                window.location.href = redirectUrl;
                            } else {
                                qrCodeScanned = false;
                                htmlscanner.render(onScanSuccess); // Restart the scanning process
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: result.message,
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            qrCodeScanned = false;
                            htmlscanner.render(onScanSuccess); // Restart the scanning process
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: 'There was a problem with the request.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        qrCodeScanned = false;
                        htmlscanner.render(onScanSuccess); // Restart the scanning process
                    });
                });

                qrCodeScanned = true;
            } catch (error) {
                console.error("Error parsing JSON: ", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid QR Code',
                    text: 'The scanned QR code is not valid.',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then(() => {
                    qrCodeScanned = false;
                    htmlscanner.render(onScanSuccess); // Restart the scanning process
                });
            }
        }
    }

    htmlscanner = new Html5QrcodeScanner(
        "my-qr-reader",
        { 
            fps: 60, 
            qrbox: 250,
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        }
    );

    htmlscanner.render(onScanSuccess);
});
</script>


<?php include 'footerAdmin.php'; ?>
