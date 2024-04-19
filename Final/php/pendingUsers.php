<?php include 'headerAdmin.php'; ?>  

<link rel="stylesheet" href="../css/pending.css">

<div class="container-fluid">
    <div class="main-container">
        <div class="d-flex justify-content-center">
            <h1>Pending Accounts</h1>
        </div>
        <div class="card main-card mt-4">
            <div class="card-body">
                <div class="card table-card">
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col" class="col1">ACCOUNT ID</th>
                                    <th scope="col" class="col2">ACCOUNT NAME</th>
                                    <th scope="col" class="col3">DOCUMENTS</th>
                                    <th scope="col" class="col4">STATUS</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card data-card mt-3">
                    <div class="card-body">
                        <table class="table text-center">
                            <tbody>
                                <tr>
                                    <th scope="col">10101</th>
                                    <td scope="col">Jose Marie Chan</td>
                                    <td scope="col">
                                         <a href="#" style="text-decoration: underline;">View Document</a>
                                    </td>
                                    <td scope="col">
                                        <button type="button" class="btn btn-primary tools-button button">ACCEPT</button>
                                        <button type="button" class="btn btn-danger tools-button button">DECLINE</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">10101</th>
                                    <td scope="col">Jose Marie Chan</td>
                                    <td scope="col">
                                         <a href="#" style="text-decoration: underline;">View Document</a>
                                    </td>
                                    <td scope="col">
                                        <button type="button" class="btn btn-primary tools-button button">ACCEPT</button>
                                        <button type="button" class="btn btn-danger tools-button button">DECLINE</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">10101</th>
                                    <td scope="col">Jose Marie Chan</td>
                                    <td scope="col">
                                         <a href="#" style="text-decoration: underline;">View Document</a>
                                    </td>
                                    <td scope="col">
                                        <button type="button" class="btn btn-primary tools-button button">ACCEPT</button>
                                        <button type="button" class="btn btn-danger tools-button button">DECLINE</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">10101</th>
                                    <td scope="col">Jose Marie Chan</td>
                                    <td scope="col">
                                         <a href="#" style="text-decoration: underline;">View Document</a>
                                    </td>
                                    <td scope="col">
                                        <button type="button" class="btn btn-primary tools-button button">ACCEPT</button>
                                        <button type="button" class="btn btn-danger tools-button button">DECLINE</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">10101</th>
                                    <td scope="col">Jose Marie Chan</td>
                                    <td scope="col">
                                         <a href="#" style="text-decoration: underline;">View Document</a>
                                    </td>
                                    <td scope="col">
                                        <button type="button" class="btn btn-primary tools-button button">ACCEPT</button>
                                        <button type="button" class="btn btn-danger tools-button button">DECLINE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <div class="row justify-content-end mr-5 mb-3 ml-2">
                    <div class="col-md-auto">
                        <button class="btn btn-primary button">ACCEPT ALL</button>
                    </div>
                    <div class="col-md-auto">
                        <button class="btn btn-danger button">DECLINE ALL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footerAdmin.php'; ?>
