<?php
include '../../db/DBconn.php';

if (isset($_POST['staff_id'])) {
      $staff_id = $_POST['staff_id'];
      $firstName = encryptData($_POST['firstName']);
      $middleName = encryptData($_POST['middleName']);
      $lastName = encryptData($_POST['lastName']);
      $suffix = $_POST['suffix'];
      $birthDate = encryptDate($_POST['birthdayDate']);
      $gender = $_POST['gender'];
      $email = encryptData($_POST['emailAddress']);
      $phoneNumber = $_POST['phoneNumber'];
      $username = encryptData($_POST['username']);
      $accountType = $_POST['accountType'];
      $password = hashPassword($_POST['password']);

      $sql = "UPDATE barangay_staff SET staff_fname = :firstName, staff_lname = :lastName, staff_midname = :middleName, staff_suffix = :suffix, birth_date = :birthDate, gender = :gender, contact_no = :phoneNumber, userRole_id = :accountType, staff_email = :email, user_name = :username, staff_password = :password 
      WHERE staff_id = :staff_id";    
      $stmt = $pdo->prepare($sql);

      $stmt->bindParam(':staff_id', $staff_id);
      $stmt->bindParam(':firstName', $firstName);
      $stmt->bindParam(':lastName', $lastName);
      $stmt->bindParam(':middleName', $middleName);
      $stmt->bindParam(':suffix', $suffix);
      $stmt->bindParam(':birthDate', $birthDate);
      $stmt->bindParam(':gender', $gender);
      $stmt->bindParam(':phoneNumber', $phoneNumber);
      $stmt->bindParam(':accountType', $accountType);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $password);
      
      if ($stmt->execute()) {
            header('Location: ../manage_staff_account.php?staff_id=' . $staff_id . '&status=success');
            exit();
      } else {
            header('Location: ../manage_staff_account.php?staff_id=' . $staff_id . '&status=error');
            exit();
      }
} else {
      header('Location: ../manage_staff_account.php?status=error');
      exit();
}
?>
