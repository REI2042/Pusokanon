<?php
include 'db/DBconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $midname = $_POST['midname'];
    $sufname = $_POST['sufname'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['byear'] . '-' . $_POST['bmonth'] . '-' . $_POST['bday'];
    $civilStatus = $_POST['civilStatus'];
    $citizenship = $_POST['citizenship'];
    $placeBirth = $_POST['placeBirth'];
    $voter = $_POST['voter'];
    $addsitio = $_POST['addsitio'];
    $contactNo = $_POST['contactNo'];
    $accemail = encryptData($_POST['accemail']);

    if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $uploadDir = 'db/ProfilePictures/';
        $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
            $profilePicture = basename($_FILES['profile_picture']['name']);
        }
    }

    $sql = "UPDATE resident_users SET 
            res_fname = :fname,
            res_lname = :lname,
            res_midname = :midname,
            res_suffix = :sufname,
            gender = :gender,
            birth_date = :birthDate,
            civil_status = :civilStatus,
            citizenship = :citizenship,
            place_birth = :placeBirth,
            registered_voter = :voter,
            addr_sitio = :addsitio,
            contact_no = :contactNo,
            res_email = :accemail";

    if (isset($profilePicture)) {
        $sql .= ", profile_picture = :profilePicture";
    }

    $sql .= " WHERE res_ID = :resID";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':midname', $midname);
    $stmt->bindParam(':sufname', $sufname);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':birthDate', $birthDate);
    $stmt->bindParam(':civilStatus', $civilStatus);
    $stmt->bindParam(':citizenship', $citizenship);
    $stmt->bindParam(':placeBirth', $placeBirth);
    $stmt->bindParam(':voter', $voter);
    $stmt->bindParam(':addsitio', $addsitio);
    $stmt->bindParam(':contactNo', $contactNo);
    $stmt->bindParam(':accemail', $accemail);
    $stmt->bindParam(':resID', $_SESSION['res_ID']);

    if (isset($profilePicture)) {
        $stmt->bindParam(':profilePicture', $profilePicture);
    }

    if ($stmt->execute()) {

        $_SESSION['res_fname'] = $fname;
        $_SESSION['res_lname'] = $lname;
        $_SESSION['res_midname'] = $midname;
        $_SESSION['res_suffix'] = $sufname;
        $_SESSION['gender'] = $gender;
        $_SESSION['birth_date'] = $birthDate;
        $_SESSION['civil_status'] = $civilStatus;
        $_SESSION['citizenship'] = $citizenship;
        $_SESSION['place_birth'] = $placeBirth;
        $_SESSION['registered_voter'] = $voter;
        $_SESSION['addr_sitio'] = $addsitio;
        $_SESSION['contact_no'] = $contactNo;
        $_SESSION['res_email'] = decryptData($accemail);
        if (isset($profilePicture)) {
            $_SESSION['profile_picture'] = $profilePicture;
        }
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>