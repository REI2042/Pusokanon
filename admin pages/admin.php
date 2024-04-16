<?php
	include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="/Images/Pusok_Logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="this col-auto col-md-3 col-lg-3 min-vh-100 d-flex flex-column justify-content-between">
                    <div class="this p-2">
                        <ul class="nav-pills flex-column mt-4 p-0">
                            <li class="nav-item">
                                <a href="#" class="current nav-link text-white">
                                <img src="dashboard.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Dashboard</span>
                                </a>
                            </li>
                            <hr>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="user.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Users</span>
                                </a>
                            </li>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="staffs.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Staffs</span>
                                </a>
                            </li>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="documents.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Documents</span>
                                </a>
                            </li>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="posts.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Posts/Notice</span>
                                </a>
                            </li>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="cases.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Cases</span>
                                </a>
                            </li>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="pendingusers.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Pending Users</span>
                                </a>
                            </li>
                            <li class="nav-item mt-2 mb-2">
                                <a href="#" class="og nav-link text-white">
                                <img src="rates.svg" class="iconAccount" alt="acount icon" width="50px" height="50px"><span class="fs-4 ms-2 d-none d-sm-inline">Document Rates</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-12 d-flex justify-content-center m-3">
                            <h1 class="dashboard">PUSOK DASHBOARD</h1>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="one col-10 col-md-3" style="background-color: #2260A7">
                        <img src="user.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Total User</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #327CC5">
                        <img src="male.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Male</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #E73B61">
                        <img src="female.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Female</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #AEA7A0">
                        <img src="pendingusers.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Pending Accounts</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #F39229">
                        <img src="cases.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Cases</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #14B571">
                        <img src="voter.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Voters</h3>
                            <h4 class="data">100</h4>
                        </div>
                        <div class="one col-10 col-md-3" style="background-color: #C42929">
                        <img src="nonvoter.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h3 class="data">Non Voters</h3>
                            <h4 class="data">100</h4>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="one col-10 col-md-8 m-2 text-white" style="background-color: #347FD8">
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
                            <img src="location.svg" class="iconAccount mt-3" alt="acount icon" width="50px" height="50px">
                            <h2 class="text-center mb-4"># OF USERS BY SITIO</h2>
                            <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                <th class="table-light text-center">Sta. Maria</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center">Matumbo</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center ">Cemento</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">150</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center">Sewage</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">250</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center">Mustang</td>
                                </tr>
                                <tr>
                                <td class="text-center text-white">50</td>
                                </tr>
                                <tr>
                                <th class="table-light text-center">Sta. Rosaryo</td>
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
    </main>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>