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
                <div class="nav-link text-light">
                    <div class="row">
                        <div class="col px-1 mt-2 pt-1"><span class="admin-text"><?=  $_SESSION['staff_fname']?></span></div>
                        <div class="col"><i class="bi bi-person-circle"></i></div>
                    </div>
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
                    <?php  if ($_SESSION['userRole'] == 1): ?> <!--ADMIN SIDEBAR-->
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
                                    <a href="Document-requestHistory.php" class="sidebar-link">Docs Request History </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="Post-Announcements.php" class="sidebar-link">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span class="span-word">&nbsp;Post Announcement</span>
                            </a>
                        </li>

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
                            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#graphs" aria-expanded="false" aria-controls="graphs">   
                                <i class="fa-solid fa-chart-column"></i>
                                <span class="span-word">Graphs & Reports</span>
                            </a>
                            <ul id="graphs" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="Graphs_Reports.php" class="sidebar-link">Population Graph</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="GraphSales.php" class="sidebar-link">File Request Analytics</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="complaints_analytics.php" class="sidebar-link">
                                        <span class="span-word">Complaints Analytics</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                        <li class="sidebar-item mt" style="z-index: 1; position: absolute; bottom: 40px; width: 100%">
                            <a href="../include/logout.php" class="sidebar-link">
                                <i class="fa-solid fa-sign-out-alt"></i>
                                <span class="span-word">Logout</span>
                            </a>
                        </li>
                        
    
                    

                    <?php  if ($_SESSION['userRole'] == 3): ?> <!--SECRETARY-->
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
                                    <a href="Document-requestHistory.php" class="sidebar-link">Docs Request History </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="Post-Announcements.php" class="sidebar-link">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span class="span-word">&nbsp;Post Announcement</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="pendingUser2.0.php" class="sidebar-link">
                                <i class="fa-solid fa-user-clock"></i>
                                <span class="span-word">Pending User</span>
                            </a>
                        </li>    
                        <li class="sidebar-item">
                            <a href="Graphs_Reports.php" class="sidebar-link">
                                <i class="fa-solid fa-chart-column"></i>
                                <span class="span-word">Graphs & Reports</span>
                            </a>
                        </li> 
                    <?php  elseif ($_SESSION['userRole'] == 4): ?> <!--BARANGAY OFFICIALS-->
                        <li class="sidebar-item">
                            <a href="Post-Announcements.php" class="sidebar-link">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span class="span-word">&nbsp;Post Announcement</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="pendingUser2.0.php" class="sidebar-link">
                                <i class="fa-solid fa-user-clock"></i>
                                <span class="span-word">Pending User</span>
                            </a>
                        </li>   
                        <li class="sidebar-item">
                            <a href="Graphs_Reports.php" class="sidebar-link">
                                <i class="fa-solid fa-chart-column"></i>
                                <span class="span-word">Population Graph</span>
                            </a>
                        </li> 
                    <?php  elseif ($_SESSION['userRole'] == 5): ?> <!--document processing-->
                        <li class="sidebar-item ">
                            <a href="Admin-Document.php" class="sidebar-link">
                                <i class="fa-solid fa-file-import"></i>
                                <span class="span-word">&nbsp;Requested Document</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="ScanQR.php" class="sidebar-link">
                                <i class="fa-solid fa-qrcode"></i>
                                <span class="span-word">Scan QRcode</span>
                            </a>
                        </li>   
                        <li class="sidebar-item ">
                            <a href="Document-requestHistory.php" class="sidebar-link">
                                <i class="fa-solid fa-clipboard"></i>
                                <span class="span-word">Docs Request History </span>
                            </a>
                        </li> 

                    <?php  elseif ($_SESSION['userRole'] == 6): ?> <!--Blotter Officer-->
                        <li class="sidebar-item ">
                            <a href="writeComplaints.php" class="sidebar-link">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span class="span-word">&nbsp;Write Complaints</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="complaintsList.php" class="sidebar-link">
                                <i class="fa-solid fa-rectangle-list"></i>
                                <span class="span-word">Complaints List</span>
                            </a>
                        </li>   
                        <li class="sidebar-item ">
                            <a href="complaints_history.php" class="sidebar-link">
                                <i class="fa-solid fa-clipboard-list"></i>
                                <span class="span-word">Complaints History </span>
                            </a>
                        </li> 
                        <li class="sidebar-item">
                            <a href="complaints_analytics.php" class="sidebar-link">
                                <i class="fa-solid fa-chart-column"></i>
                                <span class="span-word">Complaints Analytics</span>
                            </a>
                        </li>
                      

                    <?php  elseif ($_SESSION['userRole'] == 7): ?> <!--Barangay treasurer-->
                        <li class="sidebar-item">
                            <a href="Graphs_Reports.php" class="sidebar-link">
                                <i class="fa-solid fa-chart-column"></i>
                                <span class="span-word">Population Graph</span>
                            </a>
                        </li> 
                        <li class="sidebar-item">
                            <a href="GraphSales.php" class="sidebar-link">
                                <i class="fa-solid fa-peso-sign"></i>
                                <span class="span-word">File Request Analytics</span>
                            </a>
                        </li> 
                        <li class="sidebar-item">
                            <a href="Document-requestHistory.php" class="sidebar-link">
                                <i class="fa-solid fa-history"></i>
                                <span class="span-word">Docs Request History</span>
                            </a>
                        </li>
                       

                    <?php endif; ?>  
                </ul>
            </aside>
            
    