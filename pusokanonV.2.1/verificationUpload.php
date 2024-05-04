<?php
    session_start();
    if(isset($_POST['submit'])) {
    require 'db/DBconn.php';

    $userdata = $_SESSION['userdata'];

    $file_name = $_FILES['fileInput']['name'];
    $file_tmp = $_FILES['fileInput']['tmp_name'];
    $file_type = $_FILES['fileInput']['type'];
    $birthdate = $userdata['byear'].'-'.$userdata['bmonth'].'-'.$userdata['bday'];
        try {
            $stmt = $pdo->prepare("INSERT INTO registration_tbl (res_ID,res_fname, res_lname, res_midname, res_suffix, gender, birth_date, civil_status, registered_voter, citizenship, contact_no, place_birth, addr_sitio, addr_purok, res_email, res_password, userRole_id, verification_image)VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?)");
            
            $stmt->execute(['',$userdata['fname'], $userdata['lname'], $userdata['mname'], $userdata['sufname'], 
                            $userdata['gender'], $birthdate, $userdata['civilStatus'], $userdata['voter'],$userdata['citizenship'],$userdata['contactNo'],$userdata['placeBirth'],$userdata['addsitio'],$userdata['addpurok'],$userdata['accemail'], $userdata['accpassword'], $userdata['user_type'],$file_name]);
            
            // Move uploaded file to directory
            move_uploaded_file($file_tmp, "db/uploadedFiles/".$file_name);
            
            // Redirect to success page or any other page
            header("Location:success.php");
            exit();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
<?php
    require_once'include/header.php';
?>
<link rel="stylesheet" href="css/stylesuploadDocumentReg.css">
<form class="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
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

    <script src="js/script.js"></script>
</body>
</html>