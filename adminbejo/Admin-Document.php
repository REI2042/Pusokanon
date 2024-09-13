<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$residency = numRequestedDocsInPending($pdo, 4);
$indigency = numRequestedDocsInPending($pdo, 2);
$certificate = numRequestedDocsInPending($pdo, 9);
$clearance = numRequestedDocsInPending($pdo, 1);
$cedula  = numRequestedDocsInPending($pdo, 3);
$fencing = numRequestedDocsInPending($pdo, 7);
$construction = numRequestedDocsInPending($pdo, 6);
$electrical = numRequestedDocsInPending($pdo, 5);
$business = numRequestedDocsInPending($pdo, 8);

$totalPending = getTotalPendingDocuments($pdo);
$totalReleased = getTotalReleasedDocuments($pdo);
$totalDocuments = getTotalDocuments($pdo);
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
                <a href="ScanQR.php" class="scanBtn "><i class="bi bi-camera-fill "></i> Scan QR</a>
            </div>
        </div>
        <div class="ctn row m-2 d-flex justify-content-center">
            <div class="docs col-3">
                <a href="Barangay-Residency.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="Barangay Residency">
                    <button type="submit"  class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($residency)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($residency)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Residency</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '4'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                <a href="Barangay-Indigency.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="Barangay Indigency">
                    <button type="submit" class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($indigency)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($indigency)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Indigency</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '2'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                <a href="Barangay-Certificate.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="3">
                    <button type="submit" class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($certificate)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($certificate)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Certificate</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '9'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3 ">
                <a href="Barangay-Clearance.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="4">
                    <button type="submit" class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($clearance)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($clearance)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Clearance</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '1'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                <a href="Barangay-Cedula.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="5">
                    <button type="submit" class="document-bx text-left" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($cedula)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($cedula)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Cedula</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '3'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                <a href="Barangay-Fencing_Permit.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="7">
                    <button type="submit" class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($fencing)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($fencing)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Fencing Permit</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '7'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                <a href="Barangay-Business_Clearance.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="8">
                    <button type="submit" class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($business)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($business)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Business Clearance</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '8'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                <a href="Barangay-Construction_Permit.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="9">
                    <button type="submit" class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($construction)): ?>
                        
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($construction)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Construction Permit</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '6'); ?></span>
                        </div>
                    </button>
                </a>
            </div>
            <div class="docs col-3">
                  <a href="Barangay-Electrical_Permit.php" class="document-bx-form">
                    <input type="hidden" name="docType" value="Barangay Electrical Permit">
                    <button type="submit"  class="document-bx" style="background: none; color: white; width: 100%; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit; transition: all 0.3s ease;">
                        <?php if (empty($electrical)): ?>
                            
                        <?php else: ?>
                            <span class="badge badge-danger position-absolute rounded-circle"><?= htmlspecialchars($electrical)?></span>  
                        <?php endif;?>
                        <i class="fa-solid fa-file fa-2x"></i>
                        <div class="document-data text-left">
                            <span class="data1">Barangay Electrical Permit</span>
                            <span class="data2"><?php echo fetchNumberOfRequestedDocuments($pdo, '5'); ?></span>
                        </div>
                    </button>
                </a>
            </div>                
        </div>
        <div class="ftr row d-flex justify-content-center">
            <div class="d-dash col-3">
                <span class="data1">Total Pending</span>
                <span class="data2"><?php echo $totalPending; ?></span>
            </div>
            <div class="d-dash col-3">
                <span class="data1">Total Released</span>
                <span class="data2"><?php echo $totalReleased; ?></span>
            </div>
            <div class="d-dash col-3">
                <span class="data1">Total Documents</span>
                <span class="data2"><?php echo $totalDocuments; ?></span>
            </div>
        </div>
    </div>
<?php include 'footerAdmin.php';?>
