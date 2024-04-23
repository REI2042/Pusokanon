<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

    <link rel="stylesheet" href="admin.css">
	<link rel="stylesheet" href="headerADstyle.css">

	<title>Pusokanon</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="index.php"> 
                <div class="logo-holder row">
                    <div class="col px-1">
                        <img src="../PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo">
                    </div>
                    <div class="col px-1 pt-1">
                        <span> PUSOKANON</span>
                    </div>
                </div>
            </a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mt-1">
                    <a class="nav-link" href="loginPage.php">
                        <div class="row">
                            <div class="col px-1 mt-2 pt-1"><span class="admin-text">Admin</span></div>
                            <div class="col"><i class="bi bi-person-circle"></i></div>
                        </div>
                    </a>
                </li>
            </ul>
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
                        <a href="Admin-Dashboard.php">DASHBOARD</a>
                    </div>
                </div>
                    <hr class=" bg-white m-2">    
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-users"></i>
                            <span id="span-word">Resident User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-building-user"></i>
                            <span>Staff</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="fa-solid fa-file-lines ms-1"></i>
                            <span> &nbsp;Document&nbsp;</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Requested Document</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Document Request History </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-bullhorn"></i>
                            <span>&nbsp;Post Announcement</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                            data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="bi bi-headset"></i>
                            <span> &nbsp;Blotter&Complaints&nbsp;</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="writeComplaints.php" class="sidebar-link">Write Complaints</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="complaintsList.php" class="sidebar-link">Complaints List </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-user-clock"></i>
                            <span>Pending User</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-chart-column"></i>
                            <span>Set Document Rate</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-file-pen"></i>
                            <span>Publication</span>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="main pt-5 px-3">
    