<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$documentchart = getTotalDocAmountByDocType($pdo);
$monthlyData = getMonthlyDocumentSales($pdo);
$docsAmount = json_encode($documentchart);
$totalSum = getTotalSum($pdo);

?>
<link rel="stylesheet" href="css/GraphSales.css" type="text/css">
<section class="main ms-5">
    <div class="row mx-0">
        <h1 class="title text-center">Documents Sales Graph</h1>
        <div class="col-6 text-center mb-3">
            <div class="col-12 text-center mb-3">
                <input type="radio" id="byDocType" name="chartType" value="byDocType" checked>
                <label for="byDocType">Sales by Document &nbsp;|&nbsp;</label>
                <input type="radio" id="byMonth" name="chartType" value="byMonth">
                <label for="byMonth">Sales by Month</label>
            </div>
            <div class="col-12 sales-chart-container ps-4">
                <div id="sales-chart" class="chart p-2"></div>
            </div>
        </div>
        <div class="col-6 mb-3 mt-3">
            <div class="col-6 mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Document Type</th>
                            <th>Count</th>
                            <th>Sum</SUMmary></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($documentchart as $doc): ?>
                            <tr>
                                <td><?= htmlspecialchars($doc['doc_name']); ?></td>
                                <td class="text-center"><?= number_format($doc['doc_count']); ?></td>
                                <td class="show-sum">₱ <?= number_format($doc['doc_amount'], 2); ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                        <tr >
                            <td colspan="2" class="text-center" style="font-size: .8rem;" ><b>Total</b></td>
                            <td class="show-sum" style="font-size: .8rem;"><b>₱ <?= number_format($totalSum, 2); ?></b></td>
                            
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
</section>
<?php include 'footerAdmin.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var chartAmountDocs = <?php echo json_encode($documentchart); ?>;
    var monthlyData = <?php echo json_encode($monthlyData); ?>;
</script>

<script src="Graphs_Reports.js"></script>