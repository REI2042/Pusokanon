<?php
include '../../db/DBconn.php';

header('Content-Type: application/json');

if (isset($_POST['firstName'])) {
    $firstName = encryptData($_POST['firstName']);
    $middleName = encryptData($_POST['middleName']);
    $lastName = encryptData($_POST['lastName']);
    $suffix = $_POST['suffix'];
    $birthDate = encryptDate($_POST['birthdayDate']); // Expecting 'YYYY-MM-DD'
    $gender = $_POST['inlineRadioOptions'];
    $email = encryptData($_POST['emailAddress']);
    $phoneNumber = $_POST['phoneNumber'];
    $username = encryptData($_POST['username']);
    $accountType = $_POST['accountType'];
    $status = 'ACTIVE';
    $password = hashPassword($_POST['password']);

    // Check if the email and userRole_id already exist
    $checkSql = "SELECT * FROM barangay_staff WHERE staff_email = ? AND userRole_id = ?";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([$email, $accountType]);
    $existingStaff = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($existingStaff) {
        echo json_encode(['error' => 'An account with this email and role already exists.']);
    } else {
        // If no existing record is found, proceed with the insertion
        $sql = "INSERT INTO barangay_staff (staff_fname, staff_lname, staff_midname, staff_suffix, birth_date, gender, contact_no, userRole_id, staff_email, user_name, staff_password, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([$firstName, $lastName, $middleName, $suffix, $birthDate, $gender, $phoneNumber, $accountType, $email, $username, $password, $status])) {
            echo json_encode(['success' => 'New record created successfully']);
        } else {
            echo json_encode(['error' => 'Error creating record']);
        }
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
