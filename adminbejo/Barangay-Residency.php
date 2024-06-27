<?php
include 'headerAdmin.php';
include '../db/DBconn.php';
$requests = fetchdocsRequest($pdo);
?>
<link rel="stylesheet" href="css/document.css">
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pt-3 d-flex justify-content-center">
                <h1 class="title">BARANGAY RESIDENCY</h1>
            </div>
        </div>
        <div class="row d-flex justify-content-end m-2">
            <div class="col-12 col-md-4 d-flex justify-content-end p-0">
                <a href="Admin-Document.php" class="back-button">
                    <i class="fa-solid fa-circle-chevron-left fa-2x"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th class="account-no">Account No.</th>
                                    <th class="name">Name</th>
                                    <th class="document-requested">Document Requested</th>
                                    <th class="purpose">Purpose</th>
                                    <th class="status">Status</th>
                                    <th class="date-time-requested">Date & Time Requested</th>
                                    <th class="remarks">Remarks</th>
                                    <th class="tools">Tools</th>
                                </tr>
                            </thead>
                            <tbody>

                            <script>
                                function handleStatusChange(event) {
                                    var selectElement = event.target;
                                    var form = selectElement.closest('form');
                                    var status = selectElement.value;

                                    if (status === 'Processing') {
                                        form.submit();
                                        window.location.reload(); // Reload the page
                                    } else {
                                        form.submit();
                                    }
                                }
                            </script>
                                <?php foreach ($requests as $request): ?>
                                    <tr>
                                        <td class="account-no"><?= htmlspecialchars($request['res_id']); ?></td>
                                        <td class="name"><?= htmlspecialchars($request['resident_name']); ?></td>
                                        <td class="document-requested"><?= htmlspecialchars($request['document_name']); ?></td>
                                        <td class="purpose"><?= htmlspecialchars($request['purpose_name']); ?></td>
                                        <td class="status"><?= htmlspecialchars($request['stat']); ?></td>
                                        <td class="date-time-requested"><?= htmlspecialchars($request['date_req']); ?></td>
                                        <td class="remarks"><?= htmlspecialchars($request['remarks']); ?></td>
                                        <td class="tools">
                                            <div class="inline-tools">
                                                <div class="btn btn-danger btn-sm btn-1">Cancel</div>
                                                <form class="status-form" action="../db/updateStatus.php" method="POST">
                                                    <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($request['doc_ID']); ?>">
                                                    <input type="hidden" name="resident_id" value="<?= htmlspecialchars($request['res_id']); ?>">
                                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                        <option value="Pending" <?= $request['stat'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="Processing" <?= $request['stat'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                                        <option value="Ready to Pick Up" <?= $request['stat'] == 'Ready to Pick Up' ? 'selected' : ''; ?>>Ready to Pick Up</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center m-2">
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-end p-0">
                <a href="ScanQR.php" class="asd-button">Scan Document QR Code</a>
            </div>
        </div>
    </div>
</main>

<?php include 'footerAdmin.php';?>
<!-- <script src="../js/updateStatusDocs.js"></script> -->