<?php


	// $connect_db = mysqli_connect("localhost", "root", "2402", "", "3307") OR die(mysql_error());
	$host = 'localhost';
	$db   = 'database_pusokanon';
	$user = 'root';
	$pass = '2402';
	$port = '3307';
	$charset = 'utf8mb4';

	$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
	$options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	try {
	    $pdo = new PDO($dsn, $user, $pass, $options);
	} catch (\PDOException $e) {
	    throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

	// Function to fetch data
	function fetchAll($pdo) {
	    $sql = "SELECT * FROM registration_tbl";  // Replace 'your_table_name' with your actual table name
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll();  // Fetch all rows as an associative array
	}
?>