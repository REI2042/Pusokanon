<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

    $documentRates = fetchDocumentRates($pdo, '');

?>  

<link rel="stylesheet" href="css/DocumentRate.css">

<section class="main">
    <h1 class="page_header">Document Rates</h1>
    <div class="container">
        <div class="row">
        <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Residency</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '1')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Indigency</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '2')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Certificate</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '3')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Clearance</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '4')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Cedula</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '5')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Fencing Permit</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '6')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Business Clearance</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '7')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Construction Permit</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '8')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center">
                    <i class="fa-solid fa-pen d-flex justify-content-end"></i>
                    <h1 class="document-name">Barangay Electrical Permit</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '9')?></span></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footerAdmin.php';?>