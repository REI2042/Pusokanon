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
?>
<link rel="stylesheet" href="css/requestDocs.css">
<form method="POST">
	<div class="container-fluid mb-5">
		<h1>Request Document</h1>
		<hr class="bg-dark">
		<div class="docs row">
			<div class="holder col-12 col-md-6 mb-2 ">
            	<button class="btn btn-success text-left  w-100 btn-1" value="1" name="clearance" data-value="1">
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
            			<div class="h3-holder col"><h3>Barangay Clearance</h3>
            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
						<div class="price text-right">
					        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($clearance) ?></i>
					    </div>
            			</div>
            		</div>
            	</button>
	        </div>
	        
			<div class="holder col-12 col-md-6 mb-2">
				<button class="btn btn-success text-left w-100 btn-2" value="2" name="indigency" data-value="2">
					<div class="div-holder row">
					<div class="img-holder col">
						<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
					</div>
					<div class="h3-holder col">
						<h3>Barangay Indigency</h3>
						<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
						<div class="price text-right">
						<i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($indigency) ?></i>
						</div>
					</div>
					</div>
				</button>
			</div>
	        <div class="holder col-12 col-md-6 mb-2 ">
            	<button class="btn btn-success text-left  w-100 btn-3 " value="3" name="cedula" data-value="3">
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
            			<div class="h3-holder col"><h3>Cedula</h3>
            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
						<div class="price text-right">
					        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($cedula) ?></i>
					    </div>
            			</div>
					
            		</div>
            	</button>
	        </div>
	        <div class="holder col-12 col-md-6 mb-2 ">
	            <button class="btn btn-success text-left  w-100 btn-4" name="residency" value="4" data-value="4"> 
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
            			<div class="h3-holder col"><h3>Barangay Residency</h3>
            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
							<div class="price text-right">
						        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($residency) ?></i>
						    </div>
            			</div>
            		</div>
            	</button>
	        </div>
	        <div class="holder col-12 col-md-6 mb-2">
	            <button class="btn btn-success text-left  w-100 btn-5" name="residency" value="5" data-value="5">
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
            			<div class="h3-holder col"><h3>Barangay Electrical Permit</h3>
            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
							<div class="price text-right">
						        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($electricalPermit) ?></i>
						    </div>
            			</div>
            		</div>
            	</button>
	        </div>
	        <div class="holder col-12 col-md-6 mb-2">
            	<button class="btn btn-success text-left  w-100 btn-6" name="residency" value="6" data-value="6">
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
            			<div class="h3-holder col"><h3>Barangay Construction Permit</h3>
            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
						<div class="price text-right">
					        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($constructionPermit) ?></i>
					    </div>
            			</div>
            		</div>
            	</button>
	        </div>
	        <div class="holder col-12 col-md-6 mb-2">
	            <button class="btn btn-success text-left  w-100 btn-7" name="residency" value="7" data-value="7" >
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
            			<div class="h3-holder col"><h3>Barangay Fencing Permit</h3>
            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
						<div class="price text-right">
					        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($fencingPermit) ?></i>
					    </div>
            			</div>
            		</div>
            	</button>
	        </div>
	        <div class="holder col-12 col-md-6 mb-2">
	           <button class="btn btn-success text-left  w-100 btn-8" name="residency" value="8" data-value="8">
            		<div class="div-holder row ">
            			<div class="img-holder col">
            				<img src="PicturesNeeded/SampleDocument.jpg" class="" alt="pic">
            			</div>
	            			<div class="h3-holder col"><h3>Barangay Business Clearance</h3>
	            				<span>Description of what is the barangay certificate is Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span><br>
								<div class="price text-right">
						        <i class="fa-solid fa-peso-sign"> <?= htmlspecialchars($businessClearance) ?></i>
						    </div>
            			</div>
            		</div>
            	</button>
	        </div>
		</div>
	</div>
</form>	
	<script src="js/resPopUps.js"></script>
<?php
	require_once 'include/footer.php';
?>