<?php
    include 'include/res_restrict_pages.php';
    require_once 'include/header.php';
?>
<link rel="stylesheet" href="css/indexstyles.css">

    <main>
        <section class="welcome-section">
            <div class="text-center">
                <div class="banner">
                    <span class="text-center">WELCOME <br>PUSOKANON</span><br>
                    <button class="text-center" type="button" onclick="toServices()" id="padayonBtn">Padayon</button>
                </div>
            </div>
        </section>
        
        <section class="services " id="services-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 btn" onclick="requestDoc()">
                        <div class="service-card">
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <h3 class="mt-1 p-1">Request Documents</h3>
                            <p>Request official documents such as barangay clearance, certificates, Cedukla and other important papers through online.</p>                       
                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toHotlines()">
                        <div class="service-card">
                            <i class="fa-solid fa-phone-volume m-2"></i>
                            <h3>Emergency Hotlines</h3>
                            <p>Access important emergency contact numbers for quick response in case of urgent situations within the barangay.</p>                        
                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toMap()">
                        <div class="service-card">
                            <i class="fa-solid fa-map-location-dot fa-sm " style="color: white; margin:2rem"></i>
                            <h3>Barangay Map</h3>
                            <p>View an interactive map of the barangay to locate important landmarks, facilities, and services within our community.</p>                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 btn" onclick="toFileComplaints()">
                        <div class="service-card">
                            <i class="fa-solid fa-file-pen"></i>
                            <h3>File Complain</h3>
                            <p>Submit complaints or concerns about community issues directly to the barangay officials for prompt attention and resolution.</p>                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toNews()">
                        <div class="service-card">
                            <i class="bi bi-megaphone-fill m-2" style="font-size: 2.9rem;"></i>  
                            <h3>News & Updates</h3>
                            <p>Stay informed about the latest news, announcements, and events happening in Barangay Pusok through Pusokanon</p>      
                        </div>
                    </div>
                    <div class="col-md-4 btn" onclick="toOfficials()">
                        <div class="service-card">
                            <i class="fa-solid fa-users-line"></i>
                            <h3>Barangay Officials</h3>
                            <p>View information about Barangay Pusok officials, their roles, and responsibilities in our community.</p>                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<script>
    function toServices() {
        window.location.href = "#services-box";
    }
    function requestDoc(){
        window.location.href = 'requestDocument.php';
    }
    function toHotlines(){
        window.location.href = 'Resemergency-hotlines.php';
    }
    function toMap(){
        window.location.href = 'ResbarangayMap.php';
    }
    function toFileComplaints(){
        window.location.href ='residentComplaints.php';
    }
    function toNews(){
        window.location.href = '#';
    }
    function toOfficials(){
        window.location.href = 'Resaboutus-barangayOfficials.php';
    }
</script>
<?php require_once 'include/footer.php' ?>
