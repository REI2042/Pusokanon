<?php
	include 'navbar.php';
	session_start(); 
	if(isset($_SESSION['registration_data'])) {
	    
	session_destroy();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/regSuccess.css">
	<title></title>
</head>
<body>
	<form action="loginPage.php">
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
						<button type="submit" class="btn">Proceed</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>
