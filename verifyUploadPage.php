<?php
    include 'navbar.php';
    include("database/databaseConnect.php");

    session_start();

    if(isset($_FILES['fileInput']) && isset($_SESSION['userData'])) {
        // Retrieve user data from session
        $userData = $_SESSION['userData'];
        unset($_SESSION['userData']); // Clear session data after use

        // Retrieve user input
        $firstName = $userData['fname'];
        $lastName = $userData['lname'];
        $middleName = $userData['mname'];
        $suffix = $userData['sufname'];
        $gender = $userData['gender'];
        $bday = $userData['bday'];
        $bmonth = $userData['bmonth'];
        $byear = $userData['byear'];
        $civilStatus = $userData['civilStatus'];
        $registeredVoter = $userData['voter'];
        $citizenship = $userData['citizenship'];
        $contactNo = $userData['contactNo'];
        $placeOfBirth = $userData['placeBirth'];
        $addrSitio = $userData['addsitio'];
        $addrPurok = $userData['addpurok'];
        $userEmail = $userData['accemail'];
        $userPassword = $userData['accpassword'];
        $typeUser = $userData["user_type"]; 
        // Assuming regular user

        // Upload image file
        $targetDirectory = "php/uploadedFiles/"; // Change this to your desired directory
        $targetFile = $targetDirectory . basename($_FILES["fileInput"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileInput"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<script>alert(File is not an image.);</script>";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileInput"]["size"] > 1000000) {
            echo "<script>alert(Sorry, your file is too large. Please upload 10mb file size.);</script>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "<script>alert(Sorry, only JPG, JPEG, PNG & GIF files are allowed.);</script>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert(Sorry, your file was not uploaded.);</script>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetFile)) {
                // File uploaded successfully, now insert data into database

                $sql = "INSERT INTO register_table
                VALUES ('','$firstName', '$lastName', '$middleName', '$suffix', '$gender', '$bday', '$bmonth', '$byear', '$civilStatus', '$registeredVoter', '$citizenship', '$contactNo', '$placeOfBirth', '$addrSitio', '$addrPurok', '$userEmail', '$userPassword', '$typeUser', '$targetFile')";


                // Execute SQL query
                if(mysqli_query($connect_db, $sql)){
                    header("Location: registrationSuccess.php");
                exit();
                } else{
                    echo "<script>alert(ERROR: Could not able to execute $sql.);</script> " . mysqli_error($connect_db);
                }
            } else {
                echo "<script>alert(Sorry, there was an error uploading your file.);</script>";
            }
        }
    }
?>
<!-- Your HTML code -->


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href=
"https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="css/stylesuploadDocumentReg.css">
    <title>File Upload</title>
</head>

<body>
    <form class="form1" method="POST" enctype="multipart/form-data">
        <div class="card ">
            <h1 class="app-title">
                <i class="fas fa-file-upload"></i>
                Upload File
            </h1>
            
            <label for="fileInput" class="file-label">
            
                <i class="fas fa-cloud-upload-alt"></i> <br>
                <b>Choose file to upload</b>
                <p class="app-subtitle">
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
    <script src="script.js"></script>
</body>

</html>
