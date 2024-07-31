<?php
include '../../db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $midname = $_POST['midname'];
    $suffix = $_POST['sufname'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $bmonth = $_POST['bmonth'];
    $byear = $_POST['byear'];
    $civilStatus = $_POST['civilStatus'];
    $citizenship = $_POST['citizenship'];
    $placeBirth = $_POST['placeBirth'];
    $voter = $_POST['voter'];
    $sitio = $_POST['addsitio'];
    $residentId = $_POST['res_ID'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['accemail'];

    
    $birthDate = $byear . '-' . $bmonth . '-' . $bday;

    $oldProfilePicture = $_POST['old_profile_picture'];
    
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profilePicture = $_FILES['profile_picture']['name'];
        $targetDirectory = '../../db/ProfilePictures/';
        $targetFile = $targetDirectory . basename($profilePicture);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile);

        
        if ($oldProfilePicture && file_exists($targetDirectory . $oldProfilePicture)) {
            unlink($targetDirectory . $oldProfilePicture);
        }
    } else {
        $profilePicture = $oldProfilePicture;
    }


    $sql = "UPDATE resident_users SET 
                res_fname = :fname,
                res_lname = :lname,
                res_midname = :midname,
                res_suffix = :suffix,
                gender = :gender,
                birth_date = :birthDate,
                civil_status = :civilStatus,
                citizenship = :citizenship,
                place_birth = :placeBirth,
                registered_voter = :voter,
                addr_sitio = :sitio,
                profile_picture = :profilePicture,
                contact_no = :contactNo, 
                res_email = :email
            WHERE res_ID = :userId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fname' => $fname,
        ':lname' => $lname,
        ':midname' => $midname,
        ':suffix' => $suffix,
        ':gender' => $gender,
        ':birthDate' => $birthDate,
        ':civilStatus' => $civilStatus,
        ':citizenship' => $citizenship,
        ':placeBirth' => $placeBirth,
        ':voter' => $voter,
        ':sitio' => $sitio,
        ':profilePicture' => $profilePicture,
        ':userId' => $residentId,
        ':contactNo' => $contactNo,
        ':email' => encryptData($email)
    ]);

    if (isset($_POST['return_url'])) {
        $returnUrl = $_POST['return_url'];
        header("Location: " . $returnUrl);
    } else {
        header("Location: ../Manage-Users.php");
    }
    exit();
}
?>
