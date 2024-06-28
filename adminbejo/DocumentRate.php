<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

?>  

<link rel="stylesheet" href="css/DocumentRate.css">

<section class="main">
    <h1 class="page_header">Document Rates</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="1">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Residency</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '1')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="2">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Indigency</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '2')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="3">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Certificate</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '3')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="4">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Clearance</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '4')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="5">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Cedula</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '5')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="6">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Fencing Permit</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '6')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="7">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Business Clearance</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '7')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="8">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Construction Permit</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '8')?></span></p>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="document-box m-1 p-3 text-light rounded-4 text-center" id="9">
                    <div class="d-flex justify-content-end">
                        <button class="pen-icon">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                    <h1 class="document-name">Barangay Electrical Permit</h1>
                    <p class="document-price">Price: ₱ <span><?php echo fetchDocumentRates($pdo, '9')?></span></p>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="UpdatePrice.js"></script>
<?php include 'footerAdmin.php';?>