<?php
    include '../../db/DBconn.php';

    // Find out the number of Pending results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Pending'");
    $stmt->execute();
    $number_of_pending_results = $stmt->fetchColumn();

    // Find out the number of Processing results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Processing '");
    $stmt->execute();
    $number_of_processing_results = $stmt->fetchColumn();

    // Find out the number of Completed results stored in the database
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM request_doc WHERE docType_id = (SELECT docType_id FROM doc_type WHERE doc_name = 'Barangay Clearance') AND stat = 'Ready to pickup'");
    $stmt->execute();
    $number_of_completed_results = $stmt->fetchColumn();


    // Define the number of results per page
    $results_per_page = 5;
    // Determine the total number of pages available for Pending, Processing, and Completed
    $number_of_pending_pages = ceil($number_of_pending_results / $results_per_page);
    $number_of_processing_pages = ceil($number_of_processing_results / $results_per_page);
    $number_of_completed_pages = ceil($number_of_completed_results / $results_per_page);

    // Determine which page number visitor is currently on for Pending, Processing, and Completed
    $pending_page = isset($_GET['pending_page']) ? (int)$_GET['pending_page'] : 1;
    $processing_page = isset($_GET['processing_page']) ? (int)$_GET['processing_page'] : 1;
    $completed_page = isset($_GET['completed_page']) ? (int)$_GET['completed_page'] : 1;

    // Ensure the page number is within the valid range
    $pending_page = max(1, min($pending_page, $number_of_pending_pages));
    $processing_page = max(1, min($processing_page, $number_of_processing_pages));
    $completed_page = max(1, min($completed_page, $number_of_completed_pages));

    // Determine the SQL LIMIT starting number for the results on the displaying page
    $pending_offset = ($pending_page - 1) * $results_per_page;
    $processing_offset = ($processing_page - 1) * $results_per_page;
    $completed_offset = ($completed_page - 1) * $results_per_page;

    if (isset($_POST['input'])) {

    $input = $_POST['input'];

    $results = fetchdocSearchNames($pdo, $results_per_page, $pending_offset,$input);
    
?>
<link rel="stylesheet" href="css/slidingtableResidency.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<table id="table1">
            <thead>
                <tr>
                    <th>Account No.</th>
                    <th>Name</th>
                    <th>Document Requested</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Date & Time Requested</th>
                    <th>Remarks</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>
                <?php if ((count($results)) > 0):?>
                    <?php foreach ($results as $row):?>
                        <tr>
                            <td><?= htmlspecialchars($row['res_id']); ?></td>
                            <td><?= htmlspecialchars($row['resident_name']); ?></td>
                            <td><?= htmlspecialchars($row['document_name']); ?></td>
                            <td><?= htmlspecialchars($row['purpose_name']); ?></td>
                            <td><?= htmlspecialchars($row['stat']); ?></td>
                            <td><?= htmlspecialchars($row['date_req']); ?></td>
                            <td><?= htmlspecialchars($row['remarks']); ?></td>
                            <td>
                                <div class="inline-tools">
                                    <div class="btn btn-danger btn-sm btn-1"><i class="bi bi-trash3-fill"></i></div>
                                    <form class="status-form" action="../db/updateStatus.php" method="POST">
                                        <?php $dataDecrypt = decryptData($row['res_email']); ?>
                                        <input type="hidden" name="res_email" value="<?= htmlspecialchars($dataDecrypt); ?>">
                                        <input type="hidden" name="resident_name" value="<?= htmlspecialchars($row['resident_name']); ?>">
                                        <input type="hidden" name="doc_ID" value="<?= htmlspecialchars($row['doc_ID']); ?>">
                                        <input type="hidden" name="resident_id" value="<?= htmlspecialchars($row['res_id']); ?>">
                                        <button type="submit" name="status" value="Processing" class="btn btn-sm <?= $row['stat'] == 'Processing' ? 'btn-secondary' : 'btn-secondary'; ?>"><i class="fa-solid fa-download"></i></button>
                                        <button type="button" class="btn btn-sm <?= $row['stat'] == 'Ready to pickup' ? 'btn-success' : 'btn-success'; ?>" onclick="showSweetAlert('<?= htmlspecialchars($dataDecrypt); ?>', '<?= htmlspecialchars($pendings['resident_name']); ?>', '<?= htmlspecialchars($pendings['document_name']); ?>','<?= htmlspecialchars($pendings['doc_ID']); ?>', '<?= htmlspecialchars($pendings['res_id']); ?>')"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8">No user registered</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
<?php
}
?>

<script src="../js/sweetAlert.js"></script>
<script type="text/javascript">
   (function(){
      emailjs.init({
        publicKey: "-eg-XfJjgYaCKpd3Q",
      });
   })();
</script>