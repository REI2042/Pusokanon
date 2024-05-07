<?php
    include 'include/res_restrict_pages.php';
	require_once 'include/header.php';
?>
<link rel="stylesheet" href="css/document.css">

	<div class="container-fluid mb-5">
		<h1>Request Document</h1>
		<hr class="bg-dark">
		<div class="docs row">
            <div class="col-12 w-25 d-flex justify-content-start">
                <a href="requestDocument.php" class="back-button">
                    <i class="fa-solid fa-circle-chevron-left fa-2x" style="color: #48BF91;"></i>
                </a>
            </div>
            <div class="userdocbox col-12 col-md-6">
            	<img src="PicturesNeeded/SampleDocument.jpg" class="userdoc" alt="User_Document">
            </div>
            <div class="col-12 col-md-6 d-flex flex-column">
                <div class="row justify-content-center">
                    <img src="PicturesNeeded/ImageHolder.jpg" class="image_holder" alt="User_Document">
                </div>
                <div class="row text-center">
                    <h2>/* every name of certifcate</h2>
                </div>
                <div class="row text-center text-justify">
                    <p class="description text-justify">This document serves as verification that Mr. John Doe, a resident of Sitio Bayabasan,
                    Barangay Pusok, has successfully obtained and filled out the necessary forms through the
                    online Barangay portal for the purpose of employment. As per the requirements, Mr. Doe has 
                    been issued a unique QR code, which serves as proof of his registration and residency within 
                    the aforementioned barangay.
                    </p>

                    <p class="description text-justify">This QR code is hereby presented as confirmation of Mr. Doe's compliance with the barangay's procedures 
                    for employment documentation. It attests to his genuine intent and fulfillment of necessary obligations as 
                    required by the barangay authorities.
                    </p>
                </div>
            </div>
		</div>
	</div>
	

<?php
	require_once 'include/footer.php';
?>