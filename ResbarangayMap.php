<?php
    include 'include/res_restrict_pages.php';
    require_once 'include/header.php';
?>

<link rel="stylesheet" type="text/css" href="css/barangayMap.css">
<div class="content-holder">
    <div class="title-container pl-3">
        <h1>Barangay Map</h1>
        <hr class="bg-dark">
    </div> 
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="iframe-container">
                    <iframe src="https://www.google.com/maps/d/embed?mid=1YsX0jOZVgAvtEvNzTb93m_9SYEtUNhQ&ehbc=2E312F&noprof=1"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include'include/footer.php'?>