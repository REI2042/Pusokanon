<?php
   session_start();

   if (empty($_SESSION['userdata'])) {
       header("location: registration.php");
       exit();
   }
   
   if (isset($_POST['submit'])) {
       require 'db/DBconn.php';
   
       $userdata = $_SESSION['userdata'];
   
       $file_name = $_FILES['fileInput']['name'];
       $file_tmp = $_FILES['fileInput']['tmp_name'];
       $file_type = $_FILES['fileInput']['type'];
       $birthdate = $userdata['byear'] . '-' . $userdata['bmonth'] . '-' . $userdata['bday'];
       
       // Hash the password
       $hashed_password = hashPassword($userdata['accpassword']);
       
       // Encrypt the email
       $encrypted_email = encryptData($userdata['accemail']);
   
       try {
           $stmt = $pdo->prepare("INSERT INTO registration_tbl (res_ID, res_fname, res_lname, res_midname, res_suffix, gender, birth_date, civil_status, registered_voter, citizenship, contact_no, place_birth, addr_sitio, res_email, res_password, userRole_id, verification_image) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
           
           $stmt->execute(['', $userdata['fname'], $userdata['lname'], $userdata['mname'], $userdata['sufname'], 
                           $userdata['gender'], $birthdate, $userdata['civilStatus'], $userdata['voter'], $userdata['citizenship'], $userdata['contactNo'], $userdata['placeBirth'], $userdata['addsitio'], $encrypted_email, $hashed_password, $userdata['user_type'], $file_name]);
           
           // Move uploaded file to directory
           move_uploaded_file($file_tmp, "db/uploadedFiles/" . $file_name);
           
           // Redirect to success page
           header("Location: success.php");
           exit();
       } catch (PDOException $e) {
           echo "Error: " . $e->getMessage();
       }
   }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="PicturesNeeded/pusokLogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titan+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="css/navbarstyles.css">
    <link rel="stylesheet" href="css/stylesuploadDocumentReg.css">

    <title>Pusokanon</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg ">
            <a class="navbar-brand" href="index.php"> 
                <img src="PicturesNeeded/pusokLogo.png" alt="Pusokanon Logo"><span class> PUSOKANON</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    
                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="#">Request Documents</a>
                            <a class="dropdown-item" href="#">File Complaint</a>
                        </div>
                    </li>

                    <li class="nav-item mt-2 pt-1">
                        <a class="nav-link" href="#">Forum</a>
                    </li>

                    <li class="nav-item dropdown mt-2 pt-1">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutUsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <a class="dropdown-item" href="#">Barangay Info</a>
                            <a class="dropdown-item" href="#">Barangay Officials</a>
                            <a class="dropdown-item" href="#">Hazard Map</a>
                        </div>
                    </li>
    
                    <li class="nav-item mt-2 pt-1 me-3">
                        <a class="nav-link" href="#">Hotlines</a>
                    </li>
                    <li class="nav-item mt-1">
                        <a class="nav-link" href="login.php">
                        <div class="row">
                            <div class="col px-1 mt-1 pt-1"><span class="login-text">Login</span></div>
                            <div class="col"><i class="bi-person-circle"></i></div>
                        </div>
                    </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<form class="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="card ">
            <h1 class="app-title">
                <i class="fas fa-file-upload"></i>
                Upload File
            </h1>
            
            <label for="fileInput" class="file-label">
            
                <i class="fas fa-cloud-upload-alt"></i> <br>
                <b>Choose file to upload</b>
                <p class="app-subtitle text-white">
                Upload image of your ID or Letter to <br>verify you are a Pusokanon</p>
            </label>
            <input type="file" id="fileInput" class="file-input" name="fileInput" />
            <div class="progress-container">
                <div class="progress-bar" id="progressBar"></div>
                <div class="progress-text" id="progressText"></div>
            </div>
            <div class="file-details">
                <div class="file-name" id="fileName"></div>
                <button class="clear-button" id="clearButton">
                    <i class="fas fa-times"></i>
                    Clear
                </button>
            </div>
            <div class="preview-container" id="previewContainer"></div>
            <div class="btn-container" id="btnContainer">
                <button type="submit" name="submit" class="submit-button">Verify account</button>
            </div>
        </div>
        <div class="modal" id="myModal">
            <span class="close" id="closeModal">&times;</span>
            <img class="modal-content" id="uploadedImageModal">
        </div>    
    </form>

    <script src="js/script.js"></script>
</body>
</html>