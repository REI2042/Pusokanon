<?php
    include 'headerAdmin.php';
?>  
    <link rel="stylesheet" href="css/Manage-Users.css">
    <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex justify-content-center text-center">
                    <h1 class="mu-title">Manage Resident Users</h1>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="gap: 10px;">
                <div class="mudash col-10 col-md-2">
                    <h3 class="mu-data1">Total Registered Residents</h3>
                    <h4 class="mu-data2">100</h4>
                </div>
                <div class="mudash col-5 col-md-2">
                    <h3 class="mu-data1">Male</h3>
                    <h4 class="mu-data2">100</h4>
                </div>
                <div class="mudash col-5 col-md-2">
                    <h3 class="mu-data1">Female</h3>
                    <h4 class="mu-data2">100</h4>
                </div>
                <div class="mudash col-5 col-md-2">
                    <h3 class="mu-data1">Voters</h3>
                    <h4 class="mu-data2">100</h4>
                </div>
                <div class="mudash col-5 col-md-2">
                    <h3 class="mu-data1">Non-Voters</h3>
                    <h4 class="mu-data2">100</h4>
                </div>
            </div>
            <div class="mu-ds row d-flex justify-content-end">
                <div class="col-12 col-md-5 d-flex justify-content-center align-items-center">
                    <a class="btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Gender
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item">Male</a>
                        <a class="dropdown-item">Female</a>
                    </div>
                    <input class="form-control" type="number" placeholder="Search by Account ID" aria-label="Search">
                    <button class="btn my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>
                                        Account No.
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Gender
                                    </th>
                                    <th>
                                        Age
                                    </th>
                                    <th>
                                        Sitio
                                    </th>
                                    <th>
                                        Account Creation Date
                                    </th>
                                    <th>
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>4531</td>
                                    <td>Walter Bejo</td>
                                    <td>Male</td>
                                    <td>42</td>
                                    <td>Cemento</td>
                                    <td>March 15, 2015</td>
                                    <td class="tools">
                                        <div class="btn btn-danger btn-sm">Remove</div>
                                        <div class="btn btn-secondary btn-sm">View</div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

<?php include 'footerAdmin.php';?>