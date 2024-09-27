<?php 
    include 'include/res_restrict_pages.php';
    require_once 'include/header.php';
	include 'db/DBconn.php';
    $clearance = fetchDocumentRates($pdo, 1);
    $indigency = fetchDocumentRates($pdo, 2);
    $cedula = fetchDocumentRates($pdo, 3);
    $residency = fetchDocumentRates($pdo, 4);
    $electricalPermit = fetchDocumentRates($pdo, 5);
    $constructionPermit = fetchDocumentRates($pdo, 6);
    $fencingPermit = fetchDocumentRates($pdo, 7);
    $businessClearance = fetchDocumentRates($pdo, 8);
	$certificate = fetchDocumentRates($pdo, 9);
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="css/requestDocs.css">
<form method="POST">
	<div class="row d-none d-md-block mt-4"><!-- Content for laptop and desktop screens -->
		<div class="container-fluid">
				<h1>Request Document</h1>
			<hr class="bg-dark">
		</div>
		<div class="row doc-request d-flex justify-content-center align-items-center gap-2 m-2 text-white">
			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2" id="docName"><b>Barangay Indigency</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul>
							<li>You must be a bonafide resident of Barangay Pusok</li>
							<li>Purpose of getting the document</li>
							
						</ul>
						<div class="price text-right"></br>
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($indigency) ?></i><button class="btn btn-success text-left d-inline-block btn-2" value="2" data-value="2" data-doc-name="Barangay Indigency" name="indigency"> Request </button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Residency</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul>
							<li>You must be a bonafide resident of Barangay Pusok</li>
							<li>Purpose of getting the document</li>
							
						</ul>
						<div class="price text-right"></br>
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($residency) ?></i><button class="btn btn-success text-left d-inline-block btn-4" name="residency" value="4" data-value="4" data-doc-name="Barangay Residency"> Request </button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Certificate</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul>
							<li>You must be a bonafide resident of Barangay Pusok</li>
							<li>Purpose of getting the document</li>
						</ul>
						<div class="price text-right"></br>
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($certificate) ?></i><button class="btn btn-success text-left d-inline-block btn-9 " value="9" name="certificate" data-value="9" data-doc-name="Barangay Certificate"> Request </button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Cedula</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul>
							<li>Purpose of getting the document</li>
						</ul>
						<div class="price text-right"></br></br>
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($cedula) ?></i><button class="btn btn-success text-left d-inline-block btn-3 " value="3" name="Cedula" data-value="3" data-doc-name="Cedula"> Request </button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Clearance</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul>
							<li>Purpose of getting the document</li>
							<li>2x2 Picture</li>
						</ul>
						<div class="price text-right"></br>
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($clearance) ?></i><button class="btn btn-success text-left d-inline-block btn-1" value="1" name="clearance" data-value="1" data-doc-name="Barangay Clearance"> Request </button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Electrical Permit</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul class="list">
							<li>Land Title /  Land Decleration</li>
							<li>tax decleration</li>
							<li>Land location / Map</li>
							<li>Construction / House blueprint</li>
							<li>Valid ID</li>
						</ul>
						<div class="price text-right">
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($electricalPermit) ?></i><button class="btn btn-success text-left d-inline-block btn-5" name="electricalPermit" value="5" data-value="5" data-doc-name="Barangay Electrical Permit"> Request </button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Construction Permit</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul class="list">
							<li>Land Title /  Land Decleration</li>
							<li>tax decleration</li>
							<li>Land location / Map</li>
							<li>Construction / House blueprint</li>
							<li>Land Picture</li>
						</ul>
						<div class="price text-right">
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($constructionPermit) ?></i><button class="btn btn-success text-left d-inline-block btn-6" name="residency" value="6" data-value="6" data-doc-name="Barangay Construction Permit"> Request </button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Fencing Permit</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul class="list">
							<li>Land Title /  Land Decleration</li>
							<li>tax decleration</li>
							<li>Land location / Map</li>
							<li>Land Picture</li>
							<li>Fencing blueprint</li>
						</ul>
						<div class="price text-right">
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($fencingPermit) ?></i><button class="btn btn-success text-left d-inline-block btn-7" name="residency" value="7" data-value="7" data-doc-name="Barangay Fencing Permit"> Request </button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-5 document-box pt-3">
				<div class="row d-flex align-content-center">
					<div class="col-4 image-holder d-flex align-items-center"><img src="PicturesNeeded/SampleDocument.jpg" alt="Document Icon" class="doc-image"></div>
					<div class="col-8 text-holder">
						<h4 class="mb-2"><b>Barangay Business Clearance</b></h4>
						<p class="mb-0">Needed Requirements:</p>
						<ul class="list">
							<li>DTI</li>
							<li>CEDULA</li>
							<li>Valid ID</li>
							<li>Store picture</li>
							<li>Store Map/location</li>
						</ul>
						<div class="price text-right">
							Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($businessClearance) ?></i><button class="btn btn-success text-left d-inline-block btn-8" name="residency" value="8" data-value="8" data-doc-name="Barangay Business Clearance"> Request </button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="w-100"></div>
		</div>
	</div>

	<div class="row d-md-none">
		<div class="container-fluid text-center">
			<h3>Request Document</h3>
			<hr class="bg-dark">
		</div>
		<div class="container-fluid row m-1">
			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2 btn-2" value="2" data-value="2" data-doc-name="Barangay Indigency" name="indigency">
				<h5 class="text-center w-100"><b>Barangay Indigency</b></h5>
				<span > Needed Requirements:</span>
				<ul class="text-left w-100">
					<li>You must be a bonafide resident of Barangay Pusok</li>
					<li>Purpose of getting the document</li>
					
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($indigency) ?></i>
				</div>
			</button>
			
			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2 btn-4" name="residency" value="4" data-value="4" data-doc-name="Barangay Residency">
				<h5 class="text-center w-100"><b>Barangay Residency</b></h5>
				<span > Needed Requirements:</span>
				<ul class="text-left w-100">
					<li>You must be a bonafide resident of Barangay Pusok</li>
					<li>Purpose of getting the document</li>
					
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($residency) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2  btn-9" value="9" name="certificate" data-value="9" data-doc-name="Barangay Certificate">
				<h5 class="text-center w-100"><b>Barangay Certificate</b></h5>
				<span > Needed Requirements:</span>
				<ul class="text-left w-100">
					<li>You must be a bonafide resident of Barangay Pusok</li>
					<li>Purpose of getting the document</li>
					
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($certificate) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2  btn-3 " value="3" name="Cedula" data-value="3" data-doc-name="Cedula">
				<h5 class="text-center w-100"><b>Cedula</b></h5>
				<span > Needed Requirements:</span>
				<ul class="text-left w-100">
					<li>Purpose of getting the document</li>
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($cedula) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2  btn-1" value="1" name="clearance" data-value="1" data-doc-name="Barangay Clearance">
				<h5 class="text-center w-100"><b>Barangay Clearance</b></h5>
				<span > Needed Requirements:</span>
				<ul class="text-left w-100">
					<li>Purpose of getting the document</li>
					<li>2x2 Picture</li>
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($clearance) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2 btn-5" name="electricalPermit" value="5" data-value="5" data-doc-name="Barangay Electrical Permit">
				<h5 class="text-center w-100"><b>Barangay Electrical Permit</b></h5>
				<span > Needed Requirements:</span>
				<ul class="list text-left w-100">
					<li>Land Title / Land Decleration</li>
					<li>tax decleration</li>
					<li>Land location / Map</li>
					<li>Construction / House blueprint</li>
					<li>Valid ID</li>		
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($electricalPermit) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2 btn-6" name="residency" value="6" data-value="6" data-doc-name="Barangay Construction Permit">
				<h5 class="text-center w-100"><b>Barangay Construction Permit</b></h5>
				<span > Needed Requirements:</span>
				<ul class="list text-left w-100">
					<li>Land Title / Land Decleration</li>
					<li>tax decleration</li>
					<li>Land location / Map</li>
					<li>Construction / House blueprint</li>
					<li>Land Picture</li>
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($constructionPermit) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2 btn-7" name="residency" value="7" data-value="7" data-doc-name="Barangay Fencing Permit">
				<h5 class="text-center w-100"><b>Barangay Fencing Permit</b></h5>
				<span > Needed Requirements:</span>
				<ul class="list text-left w-100">
					<li>Land Title / Land Decleration</li>
					<li>tax decleration</li>
					<li>Land location / Map</li>
					<li>Land Picture</li>
					<li>Fencing blueprint</li>
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($fencingPermit) ?></i>
				</div>
			</button>

			<button class="btn-request col-12 d-flex flex-column justify-content-start align-items-start p-2 mb-2 btn-8" name="residency" value="8" data-value="8" data-doc-name="Barangay Business Clearance">
				<h5 class="text-center w-100"><b>Barangay Business Clearance</b></h5>
				<span > Needed Requirements:</span>
				<ul class="list text-left w-100">
					<li>DTI</li>
					<li>CEDULA</li>
					<li>Valid ID</li>
					<li>Store picture</li>
					<li>Store Map/location</li>
				</ul>
				<div class="price text-right w-100">
					Price - <i class="fa-solid fa-peso-sign pr-3"> <?= htmlspecialchars($businessClearance) ?></i>
				</div>
			</button>
		</div>
		
	</div>
</form>	
<script src="js/resPopUps.js"></script>
<?php
	require_once 'include/footer.php';
?>