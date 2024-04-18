<?php
    include 'headerAdmin.php';
?>  
<link rel="stylesheet" href="../css/list.css">


    <div class="main-container">
        <div class="d-flex justify-content-center">
            <h1>List of Cases</h1>
        </div>
        <div class="card main-card mt-4">
            <div class="card-body">
                <div class="card table-card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="col1">CASE ID</th>
                                    <th scope="col" class="col2">CASE TITLE</th>
                                    <th scope="col" class="col3">DATE OF INCIDENT</th>
                                    <th scope="col" class="col4">DATE REPORTED</th>
                                    <th scope="col" class="col5">STATUS</th>
                                    <th scope="col" class="col6">TOOLS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card data-card mt-3 d-flex justify-content-center">
                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row">10001</th>
                                    <td>Kawat</td>
                                    <td>01/23/24</td>
                                    <td>01/25/24</td>
                                    <td>
                                        <span class="badge bg-warning">ON GOING</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary tools-button">
                                            <i class="bi bi-eye-fill icon"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger tools-button">
                                            <i class="bi bi-trash3 icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10001</th>
                                    <td>Kawat</td>
                                    <td>01/23/24</td>
                                    <td>01/25/24</td>
                                    <td>
                                        <span class="badge bg-warning">ON GOING</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary tools-button">
                                            <i class="bi bi-eye-fill icon"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger tools-button">
                                            <i class="bi bi-trash3 icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10001</th>
                                    <td>Kawat</td>
                                    <td>01/23/24</td>
                                    <td>01/25/24</td>
                                    <td>
                                        <span class="badge bg-warning">ON GOING</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary tools-button">
                                            <i class="bi bi-eye-fill icon"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger tools-button">
                                            <i class="bi bi-trash3 icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10001</th>
                                    <td>Kawat</td>
                                    <td>01/23/24</td>
                                    <td>01/25/24</td>
                                    <td>
                                        <span class="badge bg-warning">ON GOING</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary tools-button">
                                            <i class="bi bi-eye-fill icon"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger tools-button">
                                            <i class="bi bi-trash3 icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10001</th>
                                    <td>Kawat</td>
                                    <td>01/23/24</td>
                                    <td>01/25/24</td>
                                    <td>
                                        <span class="badge bg-success">DONE</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary tools-button">
                                            <i class="bi bi-eye-fill icon"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger tools-button">
                                            <i class="bi bi-trash3 icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">10001</th>
                                    <td>Kawat</td>
                                    <td>01/23/24</td>
                                    <td>01/25/24</td>
                                    <td>
                                        <span class="badge bg-success">DONE</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary tools-button">
                                            <i class="bi bi-eye-fill icon"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger tools-button">
                                            <i class="bi bi-trash3 icon"></i>
                                        </button>
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