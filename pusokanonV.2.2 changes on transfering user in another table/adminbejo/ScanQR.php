<?php
    include 'headerAdmin.php';
?>  
    <link rel="stylesheet" href="css/document.css">
    <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <h1 class="title">SCAN QR CODE</h1>
                </div>
            </div>
            <div class="row d-flex justify-content-end m-2">
                <div class="col-12 col-md-4 d-flex justify-content-end p-0">
                    <a href="Admin-Document.php" class="back-button">
                        <i class="fa-solid fa-circle-chevron-left fa-2x"></i>
                        <span >Back</span>
                    </a>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="card-scanner">
                    <div id="scanner-container">Wala</div>
                </div>
            </div>
    </div>

<?php include 'footerAdmin.php';?>