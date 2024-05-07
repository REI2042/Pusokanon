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

	
	function fetchRegister($pdo) {
	    $sql = "SELECT * FROM registration_tbl";  
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll();  
	}

	function fetchResident($pdo) {
	    $sql = "SELECT * FROM resident_users";  
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll();  
	}

	function fetchCombinedData($pdo) {
    $sql = "SELECT * FROM registration_tbl 
            INNER JOIN resident_users ON registration_tbl.user_id = resident_users.id";  
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();  
	}
?>