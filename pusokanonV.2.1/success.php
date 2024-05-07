<?php 
session_start();
	if(empty($_SESSION['userdata'])){
        header("location: registration.php");
        exit();
    }

	if(isset($_POST['submit'])){
		
		header("Location:login.php");
	    exit();
		session_destroy();

	}
	
?>
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

	<link rel="stylesheet" href="css/stylesRegistration2.css">
	<title>Register to Pusokanon</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="index.php"> 
                <img src="PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo"><span class> PUSOKANON</span>
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
                            <a class="dropdown-item" href="#">Request Documents</a>
                            <a class="dropdown-item" href="#">File Complaint</a>
                        </div>
                    </li>

                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="#">Forum</a>
                    </li>

                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <a class="dropdown-item" href="#">Barangay Info</a>
                            <a class="dropdown-item" href="#">Barangay Officials</a>
                            <a class="dropdown-item" href="#">Hazard Map</a>
                        </div>
                    </li>
    
                    <li class="nav-item mt-2 pt-1 me-3">
                        <a class="nav-link" href="#">Hotlines</a>
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
<link rel="stylesheet" href="css/regSuccess.css">

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<div class="wrapper m-3">
			<div class="container">
				<div class="row text-center">
					<div class="col">
						<h2 class="h2"><b>Registration Complete!</b></h2>
					</div>
					<div class="w-100"></div>
					<div class="col">
						<p class="p1">Your account will be verified by the Admin.</p>
					</div>
					<div class="w-100"></div>
					<div class="col">
						<p class="p2">A notification will be sent to your email when your account is ready.</p>
					</div>
					<div class="w-100"></div>
					<div class="col">
							<img src="PicturesNeeded/email_icon.png" class="image" alt="email_icon">
					</div>
					<div class="w-100"></div>
					<div class="col">
						<p class="p2" >(Estimated verification time: 1-2 business days)</p>
					</div>
					<div class="w-100"></div>
					<div class="col">
						<button type="submit" name="submit" class="btn">Proceed</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
