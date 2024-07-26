<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
    include '../db/DBconn.php';

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
                            <option value="Arca">Arca</option>
                            <option value="Cemento">Cemento</option>
                            <option value="Chumba-Chumba">Chumba-Chumba</option>
                            <option value="Ibabao">Ibabao</option>
                            <option value="Ibabao">Lawis</option>
                            <option value="Ibabao">Matumbo</option>
                            <option value="Ibabao">Mustang</option>
                            <option value="Ibabao">New Lipata</option>
                            <option value="Ibabao">San Roque</option>
                            <option value="Ibabao">Seabreeze</option>
                            <option value="Ibabao">Seaside</option>
                            <option value="Ibabao">Sewage</option>
                            <option value="Ibabao">Sta. Maria</option>
                            <option value="Ibabao">Ibabao</option>
                            <option value="Ibabao">Ibabao</option>
                        </select>
                        <input type="number" id="sitio_population" name="sitio_population" placeholder="Enter Sitio Population">
                        <button id="Update">Update Chart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include 'footerAdmin.php';?>
<script src="Graphs_Reports.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>