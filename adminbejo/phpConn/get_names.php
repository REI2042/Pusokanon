<?php
    include '../../db/DBconn.php';

    if (isset($_POST['input'])) {
        $input = $_POST['input'];
        // $dataDecrypt = decryptData($input);

        $sql = "SELECT ru.res_fname, ru.res_lname, 
                ru.res_email AS res_email, doc_ID, stat,
                ru.res_id, dt.doc_name AS document_name, 
				rd.purpose_name AS purpose_name, 
				rd.date_req, 
				rd.remarks 
                FROM request_doc rd
			    INNER JOIN resident_users ru ON rd.res_id = ru.res_id 
                INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			    INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
                WHERE ru.res_fname LIKE :search";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':search' => '%'.$input.'%'
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="table1Container">
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
            <?php if ($results):?>
                <?php foreach ($results as $row):?>
                    <tr>
                        <td><?= htmlspecialchars($row['res_id']); ?></td>
                        <td><?= htmlspecialchars($row['res_fname']),' ',htmlspecialchars($row['res_fname']); ?></td>
                        <td><?= htmlspecialchars($row['document_name']); ?></td>
                        <td><?= htmlspecialchars($row['purpose_name']); ?></td>
                        <td><?= htmlspecialchars($row['stat']); ?></td>
                        <td><?= htmlspecialchars($row['date_req']); ?></td>
                        <td><?= htmlspecialchars($row['remarks']); ?></td>
                    </tr>
                <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
</div>
<?php
}
?>