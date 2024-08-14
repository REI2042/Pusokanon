

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="../PicturesNeeded/pusokLogo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


	<link rel="stylesheet" href="css/headerADstyle.css">
    <!-- <link rel="stylesheet" href="css/sweetAlertStyle.css"> -->
	<title>Pusokanon Admin</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="Dashboard.php"> 
                <div class="logo-holder row">
                    <div class="col px-1">
                        <img src="../PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo">
                    </div>
                    <div class="col px-1 pt-1">
                        <span> PUSOKANON</span>
                    </div>
                </div>
            </a>
            <div class="dropdown ">
                <button class="nav-link text-light" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="row">
                        <div class="col px-1 mt-2 pt-1"><span class="admin-text">Admin</span></div>
                        <div class="col"><i class="bi bi-person-circle"></i></div>
                    </div>
                </button>
                <div class="dropdown-menu" aria-labelledby="loginDropdown">
                    <a class="dropdown-item" href="">Settings</a>
                    <a class="dropdown-item" href="../include/logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="holder-body">
        <div class="wrapper">
            <aside id="sidebar">
                <div class="d-flex">
                    <button class="toggle-btn" type="button">
                        <i class="bi bi-columns-gap"></i>
                    </button>
                    <div class="sidebar-logo">
                        <a href="Dashboard.php" id="span-word">
                            <span class="span-word">Dashboard</span>
                        </a>
                    </div>
                </div>
                    <hr class=" bg-white m-2">    
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="Manage-Users.php" class="sidebar-link">
                            <i class="fa-solid fa-users"></i>
                            <span class="span-word">Resident Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#staff" aria-expanded="false" aria-controls="staff">   
                            <i class="fa-solid fa-building-user"></i>
                            <span class="span-word">Staffs</span>
                        </a>
                        <ul id="staff" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="staff_Account_creation.php" class="sidebar-link">Create Staff Account</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="manage_staff_account.php" class="sidebar-link">Manage Staff Account</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="fa-solid fa-file-lines ms-1"></i>
                            <span class="span-word"> &nbsp;Document&nbsp;</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="Admin-Document.php" class="sidebar-link">Requested Document</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="ScanQR.php" class="sidebar-link">Scan QRcode</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="Document-requestHistory.php" class="sidebar-link">Document Request History </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-bullhorn"></i>
                            <span class="span-word">&nbsp;Post Announcement</span>
                        </a>
                    </li>
                    <?php  if ($_SESSION['userRole'] != 3): ?>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#blotter" aria-expanded="false" aria-controls="blotter">
                            <i class="bi bi-headset"></i>
                            <span class="span-word"> &nbsp;Blotter&Complaints&nbsp;</span>
                        </a>
                        <ul id="blotter" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="writeComplaints.php" class="sidebar-link">Write Complaints</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="complaintsList.php" class="sidebar-link">Complaints List </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="complaints_history.php" class="sidebar-link">Complaints History </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="pendingUser2.0.php" class="sidebar-link">
                            <i class="fa-solid fa-user-clock"></i>
                            <span class="span-word">Pending User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="DocumentRate.php" class="sidebar-link">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span class="span-word">Set Document Rate</span>
                            
                        </a>
                    </li> 
                    <li class="sidebar-item">
                        <a href="Graphs_Reports.php" class="sidebar-link">
                            <i class="fa-solid fa-chart-column"></i>
                            <span class="span-word">Graphs & Reports</span>
                        </a>
                    </li> 
                    <?php endif; ?>
                </ul>
            </aside>
            
    