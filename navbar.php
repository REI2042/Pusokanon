<?php
	// session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusokanon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/navbarstyles.css">

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="index.php"> 
                <img src="PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo"><span> PUSOKANON</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link mt-2" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown mt-2">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="#">Request Documents</a>
                            <a class="dropdown-item" href="#">Forum</a>
                            <a class="dropdown-item" href="#">Hazard Map</a>
                            <a class="dropdown-item" href="#">Barangay Directory</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown mt-2">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <a class="dropdown-item" href="#">Barangay Officials</a>
                            <a class="dropdown-item" href="#">VMGO</a>
                        </div>
                    </li>

                    <li class="nav-item mt-2 me-3">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item mt-1">
                        <a class="nav-link" href="loginPage.php">
                            Login <img src="PicturesNeeded/accountCircle.svg" class="iconAccount" alt="iconaccount">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</body>
</html>
