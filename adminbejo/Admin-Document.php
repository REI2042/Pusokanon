<?php
    include 'headerAdmin.php';
?>  
    <link rel="stylesheet" href="css/document.css">
    <div class="main p-3">
    <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <h1 class="title">REQUESTED DOCUMENTS</h1>
                </div>
            </div>
            <div class="row d-flex justify-content-end m-2">
                <div class="col-12 col-md-4 d-flex justify-content-center p-0">
                    <a href="ScanQR.php" class="scanBtn "><i class="bi bi-camera-fill "></i>&nbsp;Scan QR</a>
                </div>
            </div>
            <div class="ctn row m-2 d-flex justify-content-center">
                <div class="docs col-3 ">
                    <a href="Barangay-Residency.php" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Residency</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="Barangay-Indigency.php" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Indigency</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Certificate</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Clearance</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Cedula</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Fencing Permit</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Business Clearance</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Construction Permit</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
                <div class="docs col-3">
                    <a href="#" class="document-bx">
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data">
                            <span class="data1">Barangay Business Clearance</span>
                            <span class="data2">100</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="ftr row d-flex justify-content-center">
                        <div class="d-dash col-3">
                            <span class="data1">Total Pending</span>
                            <span class="data2">100</span>
                        </div>
                        <div class="d-dash col-3">
                            <span class="data1">Total Released</span>
                            <span class="data2">100</span>
                        </div>
                        <div class="d-dash col-3">
                        <span class="data1">Total Documents</span>
                            <span class="data2">100</span>
                        </div>
            </div>
    </div>

<?php include 'footerAdmin.php';?>