<?php
include '../include/staff_restrict_pages.php';
include 'headerAdmin.php';
include '../db/DBconn.php';

$monthlyChartData = countFiledCases($pdo); 
$sitioChartData = countCasesBySitioAndType($pdo);

?>
<link rel="stylesheet" href="css/complaints_analytics.css" type="text/css">
<section class="main">
    
        <h1 class="title text-center">Filed Complaints</h1>
        <div class="container text-center mt-5">
        <div class="row gx-3">
            <div class="col-7">
                <div class="bar-chart">
                    <div id="sitio-case-chart"></div>
                </div>
            </div>
            <div class="col-5 ">
                <div class="bar-chart">
                    <div id="monthly-case-chart"></div>
                </div>
            </div>
        </div>
    </div>
        
        

</section>
<?php include 'footerAdmin.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var monthlyChartData = <?php echo json_encode($monthlyChartData); ?>;
    var sitioChartData = <?php echo json_encode($sitioChartData); ?>;
</script>
<script src="../js/complaints_analytics.js"></script>