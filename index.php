<?php
	include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Pusokanon</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
 
</head>
<body>
 	<main>
        <section class="welcome-section">
            <div class="text-center">
                <span class="text-center">WELCOME <br>PUSOKANON</span><br>
               <button class="text-center" type="button" onclick="toRegistration()" id="padayonBtn">Padayon</button>
            </div>
            <script>
                function toRegistration() {
                    window.location.href = "registrationPage.php";
                }
            </script>
        </section>

        <section class="services">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="PicturesNeeded/documentIcon.svg" class="iconsServices" alt="icondocs">
                            <h3>Request Documents</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="PicturesNeeded/callIcon.svg" class="iconsServices" alt="iconphone">
                            <h3>Emergency Hotlines</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="PicturesNeeded/location.svg" class="iconsServices" alt="iconlocation">
                            <h3>Hazard Map</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="PicturesNeeded/directory.svg" class="iconsServices" alt="icondirectory">
                            <h3>Barangay Directory</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="PicturesNeeded/forum.svg" class="iconsServices" alt="iconForum">
                            <h3>Forum</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card">
                            <img src="PicturesNeeded/officials.svg" class="iconsServices" alt="iconOfficials">
                            <h3>Barangay Officials</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
	<footer>
	    <div class="container">
	        <p>&copy; 2024 Barangay Pusok, Lapu-Lapu City. All rights reserved.</p>
	    </div>
	</footer>
</body>
</html>