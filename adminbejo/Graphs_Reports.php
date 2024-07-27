<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$chartData = fetchChartData($pdo);
$chartDataJson = json_encode($chartData);
?>

<link rel="stylesheet" href="css/Graphs_Reports.css" type="text/css">
<section class="main">
    <div class="row mx-0">
        <div class="col-12 justify-content-center">
            <h1 class="title text-center">Graphs and Reports</h1>
            <div class="charts-card">
                <div id="chart"></div>
                <div id="pieChart"></div>
                <div class="input text-center">
                    <label for="sitios">Choose a Sitio:</label>
                    <select name="sitios" id="sitios">
                        <?php foreach ($chartData as $row): ?>
                            <option value="<?php echo htmlspecialchars($row['sitio_name']); ?>"><?php echo htmlspecialchars($row['sitio_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" min="0" id="sitio_population" name="sitio_population" placeholder="Enter Sitio Population">
                    <button id="Update">Update Chart</button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footerAdmin.php';?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var chartData = <?php echo $chartDataJson; ?>;
</script>
<script src="Graphs_Reports.js"></script>