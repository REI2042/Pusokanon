<?php
session_start();
include 'DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_account'])) {
    $userId = $_SESSION['res_ID'];
    
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['profile_picture']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($filetype), $allowed)) {
            
            $newname = pathinfo($filename, PATHINFO_FILENAME) . '_' . time() . '.' . $filetype;
            $uploaddir = __DIR__ . '/ProfilePictures/';
            $uploadfile = $uploaddir . $newname;

            
            if (!is_dir($uploaddir)) {
                mkdir($uploaddir, 0777, true);
            }
            
            $stmt = $pdo->prepare("SELECT profile_picture FROM resident_users WHERE res_ID = :userId");
            $stmt->execute(['userId' => $userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $oldPicture = $row['profile_picture'];
            
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadfile)) {
                if ($oldPicture && $oldPicture != 'default.jpg') {
                    $oldPicturePath = $uploaddir . $oldPicture;
                    if (file_exists($oldPicturePath)) {
                        unlink($oldPicturePath);
                    }
                }
                
                $stmt = $pdo->prepare("UPDATE resident_users SET profile_picture = :profile_picture WHERE res_ID = :userId");
                $stmt->execute(['profile_picture' => $newname, 'userId' => $userId]);
                $_SESSION['profile_picture'] = $newname;
            } else {
                echo "Failed to move uploaded file.";
            }
        }
    }
    
    $stmt = $pdo->prepare("UPDATE resident_users SET 
        res_fname = :fname,
        res_lname = :lname,
        res_midname = :midname,
        res_suffix = :suffix,
        gender = :gender,
        birth_date = :birthdate,
        civil_status = :civilStatus,
        citizenship = :citizenship,
        place_birth = :placeBirth,
        registered_voter = :voter,
        addr_sitio = :sitio,
        contact_no = :contactNo,
        res_email = :email
        WHERE res_ID = :userId");

    $birthdate = $_POST['byear'] . '-' . $_POST['bmonth'] . '-' . $_POST['bday'];
    
    $stmt->execute([
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'midname' => $_POST['midname'],
        'suffix' => $_POST['sufname'],
        'gender' => $_POST['gender'],
        'birthdate' => $birthdate,
        'civilStatus' => $_POST['civilStatus'],
        'citizenship' => $_POST['citizenship'],
        'placeBirth' => $_POST['placeBirth'],
        'voter' => $_POST['voter'],
        'sitio' => $_POST['addsitio'],
        'contactNo' => $_POST['contactNo'],
        'email' => encryptData($_POST['accemail']),
        'userId' => $userId
    ]);

    $_SESSION['res_fname'] = $_POST['fname'];
    $_SESSION['res_lname'] = $_POST['lname'];
    $_SESSION['res_midname'] = $_POST['midname'];
    $_SESSION['res_suffix'] = $_POST['sufname'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['birth_date'] = $birthdate;
    $_SESSION['civil_status'] = $_POST['civilStatus'];
    $_SESSION['citizenship'] = $_POST['citizenship'];
    $_SESSION['place_birth'] = $_POST['placeBirth'];
    $_SESSION['registered_voter'] = $_POST['voter'];
    $_SESSION['addr_sitio'] = $_POST['addsitio'];
    $_SESSION['contact_no'] = $_POST['contactNo'];
    $_SESSION['res_email'] = $_POST['accemail'];

    $update_success = true;
    if (isset($update_success)) {
        echo "<script>window.location.href = '../resident_landingPage.php';</script>";
        exit;
    }
}
?>
