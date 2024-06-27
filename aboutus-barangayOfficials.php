<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="PicturesNeeded/pusokLogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="css/navbarstyles.css">


    <title>Pusokanon Barangay Officials</title>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="index.php"> 
                <img src="PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo"><span > PUSOKANON</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    
                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="requestDocument.php">Request Documents</a>
                            <a class="dropdown-item" href="#">File Complaint</a>
                        </div>
                    </li>

                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="#">Updates</a>
                    </li>

                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <a class="dropdown-item" href="aboutus-barangayInfo.php">Barangay Info</a>
                            <a class="dropdown-item" href="aboutus-barangayOfficials.php">Barangay Officials</a>
                            <a class="dropdown-item" href="barangayMap.php">Barangay Map</a>
                        </div>
                    </li>
    
                    <li class="nav-item mt-2 pt-1 me-3">
                        <a class="nav-link" href="emergency-hotlines.php">Hotlines</a>
                    </li>   
                    <li class="nav-item mt-1">
                        <a class="nav-link" href="login.php">
                        <div class="row">
                            <div class="col px-1 mt-1 pt-1"><span class="login-text">Login</span></div>
                            <div class="col"><i class="bi-person-circle"></i></div>
                        </div>
                    </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <link rel="stylesheet" href="css/barangayOfficials.css">
    <div class="content-holder">
		<div class="container-fluid px-0">
			<div class="title-container pl-3">
				<h1>Barangay Officials</h1>
				<hr class="bg-dark">
			</div> 
		</div>
		<div class="container-fluid px-3 mt-3">
			<div class="card no-border">
				<div class="card-header text-center text-white header-color">
					Barangay Captain
				</div>
				<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
					<img src="../../PicturesNeeded/ranie-emperio.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
					<p class="ml-md- text-md-start fs-6">
						<a class="text-format" href="https://www.facebook.com/KuyaRanieEmperio2022">Hon. Ranulfo G. Emperio</a><br>
						0912-345-6789 <br>
						ranie.emperio@gmail.com
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="card no-border">
						<div class="card-header text-center text-white header-color">
							Barangay Secretary
						</div>
						<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
							<img src="../../PicturesNeeded/brgy-secretary.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
							<p class="ml-md- text-md-start fs-6">
								<a class="text-format" href="https://www.facebook.com/jessica.sm.tongol">Ms. Jessica San Mateo Tongol</a><br>
								0912-345-6789 <br>
								jessica.tongol@gmail.com
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 ml-0">
					<div class="card no-border">
						<div class="card-header text-center text-white header-color">
							Barangay Treasurer
						</div>
						<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
							<img src="../../PicturesNeeded/brgy-treasurer.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
							<p class="ml-md- text-md-start fs-6">
								<a class="text-format" href="https://www.facebook.com/sevillejo.mlas2100">Ms. Mary Liz Aton Sevillejo</a><br>
								0912-345-6789 <br>
								maryliz.sevillejo@gmail.com
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card no-border">
				<div class="card-header text-center text-white header-color">
					Barangay Officials
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/henry-booc.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Henry D. Booc</b><br>
									0912-345-6789 <br>
									henry.booc@gmail.com
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/litoy-booc.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Carlito P. Booc</b><br>
									0912-345-6789 <br>
									carlito.booc@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/bonifacio-gomez.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Bonifacio C. Gomez Jr.</b><br>
									0912-345-6789 <br>
									bonifaciojr.gomez@gmail.com
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/alven-berezo.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Alvin P. Berezo</b><br>
									0912-345-6789 <br>
									alvin.benezo@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/adle-nonoy.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Felizardo M. Alde Sr.</b><br>
									0912-345-6789 <br>
									felizardo.alde@gmail.com
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/pino-rudy.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Rodulfo T. Pino Jr.</b><br>
									0912-345-6789 <br>
									rodulfojr.pino@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/victoriano-booc.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Victoriano G. Booc</b><br>
									0912-345-6789 <br>
									victoriano.booc@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card mt-3 no-border">
				<div class="card-header text-center text-white header-color">
					SK Chairman
				</div>
				<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
					<img src="../../PicturesNeeded/alex-bailosis.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
					<p class="ml-md- text-md-start fs-6">
						<a class="text-format" href="https://www.facebook.com/bailosis.quirante">Hon. Alex Patricia Q. Bailosis</a><br>
						0912-345-6789 <br>
						alexpatricia.bailosis@gmail.com
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="card no-border">
						<div class="card-header text-center text-white header-color">
							Barangay SK Secretary
						</div>
						<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
							<img src="../../PicturesNeeded/leslie-tadlip.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
							<p class="ml-md- text-md-start fs-6">
								<b>Ms. Leslie C. Tadlip</b><br>
								0912-345-6789 <br>
								leslie.tadlip@gmail.com
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 ml-0">
					<div class="card no-border">
						<div class="card-header text-center text-white header-color">
							Barangay SK Treasurer
						</div>
						<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
							<img src="../../PicturesNeeded/jesther-sildura.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
							<p class="ml-md- text-md-start fs-6">
								<b>Mr. Jesther P. Sildura</b><br>
								0912-345-6789 <br>
								jesther.sildura@gmail.com
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card no-border">
				<div class="card-header text-center text-white header-color">
					Barangay SK Officials
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/arche-pino.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Arche T. Pino</b><br>
									0912-345-6789 <br>
									arche.pino@gmail.com
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/edgar-inot.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Edgar L. Inot</b><br>
									0912-345-6789 <br>
									edgar.inot@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="card no-border">
							<div class="card-body d-flex flex-column flex-md-row justify-content-center align-items-center">
								<img src="../../PicturesNeeded/chienna-pino.jpg" class="img-fluid rounded-circle w-25 mb-3 mb-md-0 me-md-4">
								<p class="ml-md- text-md-start fs-6">
									<b>Hon. Chienna Mae Pino</b><br>
									0912-345-6789 <br>
									chiennamae.pino@gmail.com
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>

<?php
    include 'include/footer.php';
?>
