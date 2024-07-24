<?php
include '../../db/DBconn.php';

header('Content-Type: application/json');

if (isset($_POST['firstName'])) {
    $firstName = encryptData($_POST['firstName']);
    $middleName = encryptData($_POST['middleName']);
    $lastName = encryptData($_POST['lastName']);
    $suffix = encryptData($_POST['suffix']);
    $birthDate = encryptData($_POST['birthdayDate']);
    $gender = encryptData($_POST['inlineRadioOptions']);
    $email = encryptData($_POST['emailAddress']);
    $phoneNumber = encryptData($_POST['phoneNumber']);
    $username = $_POST['username'];
    $accountType = $_POST['accountType'];


    $password = hashPassword($_POST['password']);

    $sql = "INSERT INTO barangay_staff (staff_fname, staff_lname, staff_midname, staff_suffix, birth_date, gender, contact_no, userRole_id, staff_email, user_name, staff_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$firstName, $lastName, $middleName, $suffix, $birthDate, $gender, $phoneNumber, $accountType, $email, $username ,$password])) {
        echo json_encode(['success' => 'New record created successfully']);
    } else {
        echo json_encode(['error' => 'Error creating record']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>

