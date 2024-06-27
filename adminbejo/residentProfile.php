<?php
    include 'headerAdmin.php';
?>  
    <link rel="stylesheet" href="css/residentProfile.css">
    <div class="container-fluid">
        <div class="profile-box row">
            <div class="row">
                <div class="col-1 d-flex justify-content-start">
                    <a href="#" class="back-button m-2">
                        <i class="fa-solid fa-chevron-left fa-2x fa-border" style="color: #fff; --fa-border-radius: 50%;"></i>
                    </a>
                </div>
                <div class="col-9 d-flex justify-content-start mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="col-1">
                            <img src="../PicturesNeeded/profile-pic.jpg" alt="Pusokanon Logo" class="profile">
                        </div>
                        <div class="col-11">
                            <p>Name: Dwight Estrada</p>
                            <p>Gender: Male</p>
                            <p>Age: 20</p>
                        </div>
                    </div>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <div class="dropdown show m-2">
                        <a class="btn" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis fa-2x" style="color: #fff;"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item">Edit User</a>
                            <a class="dropdown-item">Deactivate Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footerAdmin.php';?>