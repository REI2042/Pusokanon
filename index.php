<?php
	require_once 'include/header.php';
?>
<link rel="stylesheet" href="css/indexstyles.css">

	<main>
        <section class="welcome-section">
            <div class="text-center">
            	<div class="banner">
	                <span class="text-center">WELCOME <br>PUSOKANON</span><br>
	               	<button class="text-center" type="button" onclick="toRegistration()" id="padayonBtn">Padayon</button>
               	</div>
            </div>
            <script>
                function toRegistration() {
                    window.location.href = "login.php";
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

<?php require_once 'include/footer.php' ?>
