<?php

	$host = 'localhost';
	$db   = 'database_pusokanon';
	$user = 'root';
	$pass = '';
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

	// function fetchResident($pdo) {
	//     $sql = "SELECT * FROM resident_users";  
	//     $stmt = $pdo->prepare($sql);
	//     $stmt->execute();
	//     return $stmt->fetchAll();  
	// }

	function fetchTotalResidents($pdo) {
    $sql = "SELECT COUNT(*) FROM resident_users";  
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();  
	}

	function fetchResident($pdo, $limit, $offset) {
	    $sql = "SELECT * FROM resident_users LIMIT :limit OFFSET :offset";  
	    $stmt = $pdo->prepare($sql);
	    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	    $stmt->execute();
	    return $stmt->fetchAll();  
	}

	// function fetchCombinedData($pdo) {
    // $sql = "SELECT * FROM registration_tbl 
    //         INNER JOIN resident_users ON registration_tbl.user_id = resident_users.id";  
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute();
    // return $stmt->fetchAll();  
	// }

	function fetchdocsRequest($pdo) {
		$sql = "SELECT 
					ru.res_id, doc_ID, stat,
					CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name, 
					dt.doc_name AS document_name, 
					rd.purpose_name AS purpose_name, 
					rd.date_req, 
					rd.remarks 
				FROM request_doc rd
				INNER JOIN resident_users ru ON rd.res_id = ru.res_id
				INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
				INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id";  
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();  
	}

	function fetchResdocsRequest($pdo, $userId) {
		$sql = "SELECT 
				ru.res_id, doc_ID, stat, ru.birth_date, ru.gender, ru.civil_status,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
				dt.doc_name AS document_name, 
				dp.purpose_name AS purpose_name, 
				rd.date_req, 
				rd.remarks 
			FROM request_doc rd
			INNER JOIN resident_users ru ON rd.res_id = ru.res_id
			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE ru.res_id = :userId";  // Filter by user ID
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();  
	}

	function fetchLatestRequest($pdo, $userId) {
		$sql = "SELECT
				rd.request_id,
				rd.res_id AS resident_id,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
				ru.addr_sitio AS sitio,
				dt.doc_name AS document_name,
				rd.doctype_id AS document_id, 
				rd.purpose_name AS purpose, 
				rd.date_req AS request_date,
				dt.doc_amount
				FROM request_doc rd 
				INNER JOIN resident_users ru ON rd.res_id = ru.res_id
				INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
				WHERE rd.res_id = :userId
				ORDER BY rd.date_req DESC
				LIMIT 1";  
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function fetchTotalMales($pdo) {
		$sql = "SELECT COUNT(*) FROM resident_users WHERE gender = 'Male'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();  
	}

	function fetchTotalFemales($pdo) {
		$sql = "SELECT COUNT(*) FROM resident_users WHERE gender = 'Female'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();  
	}

	function fetchPendingAccounts($pdo) {
		$sql = "SELECT COUNT(*) FROM registration_tbl";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchRegisteredVoters($pdo) {
		$sql = "SELECT COUNT(*) FROM resident_users WHERE registered_voter = 'Registered'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchNonRegisteredVoters($pdo) {
		$sql = "SELECT COUNT(*) FROM resident_users WHERE registered_voter != 'Registered'";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchUsersBySitio($pdo, $sitio) {
		$sql = "SELECT COUNT(*) FROM resident_users WHERE addr_sitio = :sitio";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':sitio', $sitio, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchNumberOfRequestedDocuments($pdo, $document) {
		$sql = "SELECT COUNT(*) FROM request_doc WHERE docType_id = :document";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':document', $document, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchDocumentRates($pdo, $id) {
		$sql = "SELECT doc_amount FROM doc_type WHERE docType_id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
?>