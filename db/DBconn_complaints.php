<?php

    session_start();
    require_once 'DBconn.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $sufname = $_POST['sufname'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $incident_date = $_POST['incident-date'];
        $incident_time = $_POST['incident-time'];
        $addsitio = $_POST['addsitio'];
        $date_filed = $_POST['addsitio'];
        $case_type = $_POST['case_type'];
        $narrative = $_POST['narrative'];

        // Prepare the SQL statement
        $sql = "INSERT INTO complaints_tbl (respondent_fname, respondent_mname, respondent_lname, respondent_suffix, respondent_gender, respondent_age, incident_date, incident_time, incident_place, date_filed, case_type, narrative) 
                VALUES (:respondent_fname, :respondent_mname, :respondent_lname, :respondent_suffix, :respondent_gender, :respondent_age, :incident_date, :incident_time, :incident_place, :date_filed :case_type, :narrative)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':respondent_fname', $fname);
        $stmt->bindParam(':respondent_mname', $mname);
        $stmt->bindParam(':respondent_lname', $lname);
        $stmt->bindParam(':respondent_suffix', $sufname);
        $stmt->bindParam(':respondent_gender', $gender);
        $stmt->bindParam(':respondent_age', $age);
        $stmt->bindParam(':incident_date', $incident_date);
        $stmt->bindParam(':incident_time', $incident_time);
        $stmt->bindParam(':incident_place', $addsitio);
        $stmt->bindParam(':date_filed', $date_filed);
        $stmt->bindParam(':case_type', $case_type);
        $stmt->bindParam(':narrative', $narrative);

        // Execute the statement
        $stmt->execute();

        
    }



?>