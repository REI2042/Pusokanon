<?php 
    include '../db/DBconn.php';
    include 'headerAdmin.php';
?>

<link rel="stylesheet" href="css/slidingtableResidency.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<main>
    <div class="row">
        <div class="col-12 pt-3 d-flex justify-content-center">
            <h1 class="title">BARANGAY CLEARANCE REQUESTS</h1>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center m-2">
        <a href="Admin-Document.php" class="back-button d-flex align-items-center">
            <i class="fa-solid fa-chevron-left fa-2x"></i>
            <span>Back</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="ScanQR.php" class="btn camera-btn">
                <i class="bi bi-camera" style="font-size: 1.2rem;"></i>&nbsp;Scan QR
            </a>
            <div class="input-group mb-0 custom-search">
                <input type="search" class="form-control custom-search" placeholder="Search" aria-label="Search" id="search_name">
                <button class="btn search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <div id="searchresult" class="table-content" style="min-width: 92vw; width: 92vw; max-width: 95vw;">
       
    </div>
</main>

<script>
$(document).ready(function() {
    $('#search_name').keyup(function() {
        var input = $(this).val();
        $.ajax({
            url: 'phpConn/get_names.php',
            method: 'POST',
            data: { input: input },
            success: function(data) {
                $('#searchresult').html(data);
            }
        });
    });

    // Trigger search when the page loads to display all data
    $('#search_name').trigger('keyup');
});

</script>

<?php include 'footerAdmin.php';?>
