<?php

session_start();
require_once 'DBconn.php';

if(isset($_POST['save_account'])) {
    $userData = $_POST;
    $password = $userData['accpassword'];

    if (strlen($password) < 12) {
        header("Location:../registration.php?alert=password_short");
        exit();
    }

    $firstName = $userData['fname'];
    $lastName = $userData['lname'];
    $middleName = $userData['mname'];
    $suffix = $userData['sufname'];
    $contactNo = $userData['contactNo'];
    $email = $userData['accemail'];

    $sql = "SELECT * FROM resident_users WHERE (res_fname = ? AND res_lname = ? AND res_midname = ? AND res_suffix = ?) OR (contact_no = ? OR res_email = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$firstName, $lastName, $middleName, $suffix, $contactNo, $email]);

    // Check if the user already exists
    if($stmt->rowCount() < 1) {
        $_SESSION['userdata'] = $userData;
        header("Location:../verificationUpload.php");
        exit();
    } else {
        header("Location:../registration.php?alert=exists");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		body {
		  font-family: Arial, sans-serif;
		  background-image: url("../PicturesNeeded/bannerBg.jpg");
		  background-size: cover;
		  background-position: center;
		  background-repeat: no-repeat;
		  background-attachment: fixed;
		  min-height: 100vh;
		  display: flex;
		  flex-direction: column;
		  padding-top: 60px;

		}

	</style>
</head>
<body>

</body>
</html>