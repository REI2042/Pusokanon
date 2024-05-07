<?php
    include '../include/staff_restrict_pages.php';
    include 'headerAdmin.php';
?>  

<link rel="stylesheet" href="css/admin.css">
<div class="main p-3">
    <div class="container-activity ">
        <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center m-3">
                            <h1 class="dashboard text-center">PUSOK DASHBOARD</h1>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="one col-10 col-md-3" style="background-color: #346BA9">
                            <i class="mt-2 fa-solid fa-users fa-2x";></i>
                            <h3 class="data">Total User</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #327CC5">
                        <i class="bi bi-gender-male fa-2x mt-2"></i>
                            <h3 class="data">Male</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #E73B61">
                        <i class="bi bi-gender-female fa-2x mt-2"></i>
                            <h3 class="data">Female</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #AEA7A0">
                        <i class="fa-solid fa-user-clock fa-2x mt-2"></i>
                            <h3 class="data">Pending Accounts</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #F39229">
                        <i class="fa-solid fa-scale-balanced fa-2x mt-2"></i>
                            <h3 class="data">Cases</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #14B571">
                        <i class="fa-solid fa-user-check fa-2x mt-2"></i>
                            <h3 class="data">Voters</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #C42929">
                        <i class="fa-solid fa-user-xmark fa-2x mt-2"></i>
                            <h3 class="data">Non Voters</h3>
                            <h4 class="data">100</h4>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center ml-0">
                        <div class="one col-10 col-md-8 m-2 text-white align-self-start" style="background-color: #347FD8">
                            <table class="table table-bordered">
                                <tr>
                                <th colspan="3" class="table-light text-center">TOTAL DOCUMENTS REVENUE</th>
                                </tr>
                                <tr>
                                <th colspan="3" class="text-center text-white">P100,000.00</th>
                                </tr>
                                <tr>
                                <th class="table-light text-center fw-bold">RESIDENCY</td>
                                <th class="table-light text-center fw-bold">INDIGENCY</td>
                                <th class="table-light text-center fw-bold">CLEARANCE</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">P 335.00</td>
                                <td class="text-center text-white">P 350.00</td>
                                <td class="text-center text-white">P 350.00</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center">CERTIFICATE</td>
                                <th class="table-light text-center">CEDULA</td>
                                <th class="table-light text-center">BUSINESS CLEARANCE</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">P 335.00</td>
                                <td class="text-center text-white">P 350.00</td>
                                <td class="text-center text-white">P 350.00</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center">CONSTRUCTION PERMIT</td>
                                <th class="table-light text-center">FENCING PERMIT</td>
                                <th class="table-light text-center">ELECTRICAL PERMIT</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">P 335.00</td>
                                <td class="text-center text-white">P 350.00</td>
                                <td class="text-center text-white">P 350.00</td>
                                </tr>
                            </table>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #347FD8">
                        <i class="fa-solid fa-map-location-dot mt-3 fa-2x"></i>
                            <h2 class="text-center mb-4"># OF USERS BY SITIO</h2>
                            <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                <th class="sitio table-light text-center">Sta. Maria</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                                <tr>
                                <th class="sitio table-light text-center">Matumbo</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                                <tr>
                                <th class="sitio table-light text-center ">Cemento</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">150</td>
                                </tr>
                                <tr>
                                <th class="sitio table-light text-center">Sewage</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                                <tr>
                                <th class="sitio table-light text-center">Mustang</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">50</td>
                                </tr>
                                <tr>
                                <th class="sitio table-light text-center">Sta. Rosaryo</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
        </div>           
    </div>
</div>

<?php include 'footerAdmin.php';?>