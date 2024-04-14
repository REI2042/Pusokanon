<?php
session_start();
include("database/databaseConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user data from the session
    $firstName = $_SESSION["fname"];
    $lastName = $_SESSION["lname"];
    $middleName = $_SESSION["mname"];
    $suffix = $_SESSION["sufname"];
    $birthDay = $_SESSION["bday"];
    $birthMonth = $_SESSION["bmonth"];
    $birthYear = $_SESSION["byear"];
    $civilStatus = $_SESSION["civilStatus"];
    $citizenship = $_SESSION["citizenship"];
    $gender = $_SESSION["gender"];
    $placeBirth = $_SESSION["placeBirth"];
    $contactNo = $_SESSION["contactNo"];
    $addressSitio = $_SESSION["addsitio"];
    $addressPurok = $_SESSION["addpurok"];
    $accountEmail = $_SESSION["accemail"];
    $accountPassword = $_SESSION["accpassword"];

    // Handle the file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['file']['name'];
        $tmp_name = $_FILES['file']['tmp_name'];
        $file_up_name = time() . $file_name;
        $file_path = "php/uploadedFiles/" . $file_up_name;
        move_uploaded_file($tmp_name, $file_path);
        $typeUser = "Resident";

        // Insert the user data and file information into the reg_table
        $sql = "INSERT INTO reg_table 
                VALUES ('', $firstName', '$lastName', '$middleName', '$suffix', '$birthDay', '$birthMonth', '$birthYear', '$civilStatus', '$citizenship', '$gender', '$placeBirth', '$contactNo', '$addressSitio', '$addressPurok', '$accountEmail', '$accountPassword', '$typeUser', '$file_path')";

        if ($connect_db->query($sql) === TRUE) {
            echo "<script>alert('Account has been created and file uploaded successfully!');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $connect_db->error;
        }

        $connect_db->close();
    } else {
        // Handle the case when no file is uploaded
        echo "<script>alert('Please upload a file!');</script>";
    }
}
?>