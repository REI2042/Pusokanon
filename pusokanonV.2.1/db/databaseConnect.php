<!--
	// $connect_db = mysqli_connect("localhost", "root", "2402", "pusokanon-db", "3307") OR die(mysql_error());
?>-->

<?php
$connect_db = mysqli_connect("localhost", "root", "2402", "pusokanon_db", "3307");
try {
    if (!$connect_db) {
        // If the connection failed, throw an exception
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    // Handle the error gracefully
    die('Connection error: ' . $e->getMessage());
}
?>
