<?php
include 'include/header.php';
include 'db/DBconn.php';

$userId = $_SESSION['res_ID']; // Get logged-in user's ID from session
$requests = fetchResdocsRequest($pdo, $userId, $table, $fields, $where);

?>
<link rel="stylesheet" href="css/accountprofile.css">
<div class="prof-holder">
    <div class="profile-holder">
        <div class="row tools ms-1">
            <div class="col back"></div>
        </div>
        <div class="main">
            <div class="cover">
                <img src="PicturesNeeded/bannerBg.jpg" alt="Banner Background" />
            </div>
            <div class="profile">
                <img src="PicturesNeeded/profile-pic.jpg" alt="Profile Picture" />
                <span class="nameProfile row">
                    <strong class="bold">
                        <?= htmlspecialchars($_SESSION['res_fname']); ?>
                    </strong><br>
                    <p><?= htmlspecialchars($_SESSION['res_email']); ?></p>
                </span>
                <div class="col setting">
                    <div class="dropdown show" style="margin-top: 120px">
                        <a class="btn" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-white" style="color: #fff;"></i>
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
</div>
<div class="body-container pb-4">
    <div class="body-holder">
        <div class="row mt-4">
        <aside class="col-md-4 bg-white">
                <div class="info m-4 row">
                    <div class="user-info col">
                    <?php
                        if (isset($_SESSION['birth_date'])) {
                            $birthdateStr = $_SESSION['birth_date'];
                            $birthdate = DateTime::createFromFormat('Y-m-d', $birthdateStr);
                            if ($birthdate) {
                                $currentDate = new DateTime();
                                $age = $currentDate->diff($birthdate)->y;
                                echo '<b>Age:</b> ' . htmlspecialchars($age);
                            } else {
                                echo 'Invalid birth date format.';
                            }
                        } else {
                            echo 'Birth date not set.';
                        }
                    ?><br>
                    <strong>Gender: </strong><?= htmlspecialchars($_SESSION['gender']); ?><br>
                    <strong>Civil status:</strong> <?= htmlspecialchars($_SESSION['civil_status']); ?><br>
                    
                    </div>
                </div>
            </aside>
            <article class="col-md-8">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Document Requested</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Date & Time Requested</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($requests as $request): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($request['document_name']); ?></td>
                                        <td><?= htmlspecialchars($request['purpose_name']); ?></td>
                                        <td><?= htmlspecialchars($request['stat']); ?></td>
                                        <td><?= htmlspecialchars($request['date_req']); ?></td>
                                        <td><?= htmlspecialchars($request['remarks']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>
