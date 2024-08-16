<?php
include '../db/DBconn.php';
session_start();

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
    $contactNo = $_POST['contactNo'];
    $email = $_POST['accemail'];

    // Combine the birthdate
    $birthDate = $byear . '-' . $bmonth . '-' . $bday;

    $oldProfilePicture = $_SESSION['profile_picture']; // Get the old picture path
    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profilePicture = $_FILES['profile_picture']['name'];
        $targetDirectory = '../db/ProfilePictures/';
        $targetFile = $targetDirectory . basename($profilePicture);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile);

        // Remove the old profile picture from the folder
        if ($oldProfilePicture && file_exists($targetDirectory . $oldProfilePicture)) {
            unlink($targetDirectory . $oldProfilePicture);
        }
    } else {
        $profilePicture = $_SESSION['profile_picture']; // Retain old picture if no new one is uploaded
    }

    // Update profile in the database
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
                contact_no = :contactNo,
                res_email = :email,
                profile_picture = :profilePicture
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
        ':contactNo' => $contactNo,
        ':profilePicture' => $profilePicture,
        ':email' => encryptData($email),
        ':userId' => $_SESSION['res_ID']
    ]);

    // Update session variables
    $_SESSION['res_fname'] = $fname;
    $_SESSION['res_lname'] = $lname;
    $_SESSION['res_midname'] = $midname;
    $_SESSION['res_suffix'] = $suffix;
    $_SESSION['gender'] = $gender;
    $_SESSION['birth_date'] = $birthDate;
    $_SESSION['civil_status'] = $civilStatus;
    $_SESSION['citizenship'] = $citizenship;
    $_SESSION['place_birth'] = $placeBirth;
    $_SESSION['registered_voter'] = $voter;
    $_SESSION['addr_sitio'] = $sitio;
    $_SESSION['contact_no'] = $contactNo;
    $_SESSION['profile_picture'] = $profilePicture;
    $_SESSION['res_email'] = $email;

    // Redirect to the profile page
    header("Location: ../Profile.php");
    exit();
}
?>
