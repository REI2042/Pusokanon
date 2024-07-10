<?php
include 'headerAdmin.php';
include '../db/DBconn.php';
$pending = fetchdocsRequest($pdo,'Pending');
$Processing = fetchdocsRequest($pdo,'Processing');
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
        <a href="#" id="link1" class="text-center">Show Table 1</a> |
        <a href="#" id="link2" class="text-center">Show Table 2</a>
        <div class="table-container"></div>
        <div class="row  table-container" id="table1">
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
                                <?php foreach ($pending as $pendings): ?>
                                    <tr>
                                        <td class="account-no"><?= htmlspecialchars($pendings['res_id']); ?></td>
                                        <td class="name"><?= htmlspecialchars($pendings['resident_name']); ?></td>
                                        <td class="document-requested"><?= htmlspecialchars($pendings['document_name']); ?></td>
                                        <td class="purpose"><?= htmlspecialchars($pendings['purpose_name']); ?></td>
                                        <td class="status"><?= htmlspecialchars($pendings['stat']); ?></td>
                                        <td class="date-time-requested"><?= htmlspecialchars($pendings['date_req']); ?></td>
                                        <td class="remarks"><?= htmlspecialchars($pendings['remarks']); ?></td>
                                        <td class="tools">
                                            <div class="inline-tools">
                                                <div class="btn btn-danger btn-sm btn-1"><i class="bi bi-trash3-fill"></i></div>
                                                <form class="status-form" action="../db/updateStatus.php" method="POST">
                                                    <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($pendings['doc_ID']); ?>">
                                                    <input type="hidden" name="resident_id" value="<?= htmlspecialchars($pendings['res_id']); ?>">
                                                    <button type="submit" name="status" value="download" class="btn btn-sm <?= $pendings['stat'] == 'download' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                                    <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $pendings['stat'] == 'Processing' ? 'btn-success' : 'btn-success'; ?>"><i class="fa-solid fa-check"></i></button>
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

        <div class="row d-flex justify-content-center table-container" id="table2">
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
                                <?php foreach ($Processing as $processings): ?>
                                    <tr>
                                        <td class="account-no"><?= htmlspecialchars($processings['res_id']); ?></td>
                                        <td class="name"><?= htmlspecialchars($processings['resident_name']); ?></td>
                                        <td class="document-requested"><?= htmlspecialchars($processings['document_name']); ?></td>
                                        <td class="purpose"><?= htmlspecialchars($processings['purpose_name']); ?></td>
                                        <td class="status"><?= htmlspecialchars($processings['stat']); ?></td>
                                        <td class="date-time-requested"><?= htmlspecialchars($processings['date_req']); ?></td>
                                        <td class="remarks"><?= htmlspecialchars($processings['remarks']); ?></td>
                                        <td class="tools">
                                            <div class="inline-tools">
                                                <div class="btn btn-danger btn-sm btn-1"><i class="bi bi-trash3-fill"></i></div>
                                                <form class="status-form" action="../db/updateStatus.php" method="POST">
                                                    <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($pendings['doc_ID']); ?>">
                                                    <input type="hidden" name="resident_id" value="<?= htmlspecialchars($pendings['res_id']); ?>">
                                                    <button type="submit" name="status" value="download" class="btn btn-sm <?= $pendings['stat'] == 'download' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                                    <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $pendings['stat'] == 'Processing' ? 'btn-success' : 'btn-success'; ?>"><i class="fa-solid fa-check"></i></button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
       $(document).ready(function () {
            $("#link1").click(function (e) {
                e.preventDefault();
                $("#table2").removeClass("visible").addClass("hidden");
                $("#table1").removeClass("hidden").addClass("visible");
            });

            $("#link2").click(function (e) {
                e.preventDefault();
                $("#table1").removeClass("visible").addClass("hidden");
                $("#table2").removeClass("hidden").addClass("visible");
            });
        });
</script>
<?php include 'footerAdmin.php';?>
