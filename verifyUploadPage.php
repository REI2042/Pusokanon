<?php
	include 'navbar.php';
?>

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
    <title>File Upload with Progress Bar</title>
</head>

<body>
    <form class="form1">
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
            <input type="file" id="fileInput" class="file-input" />
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
                <button type="submit" class="submit-button">Verify your account</button>
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
