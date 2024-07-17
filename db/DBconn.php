<?php

	$host = 'localhost';
	$db   = 'database_pusokanon';
	$user = 'root';
	$pass = '';
	$port = '3307';
	// $host = 'ba3mgkm7ybvrjelzfj5p-mysql.services.clever-cloud.com';
	// $db   = 'ba3mgkm7ybvrjelzfj5p';
	// $user = 'uokt9ejhkioabyku';
	// $pass = 'PZg0wRK0jtIFuchrP0Ck';
	// $port = '3306';
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

	// Function to hash passwords
	function hashPassword($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

	// Function to verify password
	function verifyPassword($password, $hash) {
		return password_verify($password, $hash);
	}

	// Encryption key (you should use a secure key management system)
	define('ENCRYPTION_KEY', 'qwmnsdfghankyetr'); 

	// Function to encrypt data
	function encryptData($data) {
		return openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_KEY);
	}

	// Function to decrypt data
	function decryptData($data) {
		return openssl_decrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_KEY);
	}
	
	
	function fetchRegister($pdo, $limit, $offset) {
		$sql = "SELECT * FROM registration_tbl LIMIT :limit OFFSET :offset";  
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();  
	}

	//for pagination in the pending residents table
	function fetchTotalPending($pdo) {
		$sql = "SELECT COUNT(*) FROM registration_tbl";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
	}	

	// function fetchResident($pdo) {
	//     $sql = "SELECT * FROM resident_users";  
	//     $stmt = $pdo->prepare($sql);
	//     $stmt->execute();
	//     return $stmt->fetchAll();  
	// }

//for pagination in the manage residents table
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


function fetchdocsRequest($pdo, $status, $limit, $offset) {
	$sql = "SELECT 
				ru.res_id, ru.res_email AS res_email, doc_ID, stat,
				CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) AS resident_name, 
				dt.doc_name AS document_name, 
				rd.purpose_name AS purpose_name, 
				rd.date_req, 
				rd.remarks 
			FROM request_doc rd
			INNER JOIN resident_users ru ON rd.res_id = ru.res_id
			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE dt.doc_name = 'Barangay Clearance' AND stat = :status
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();  
}

function fetchdocsRequestRemarks($pdo, $status, $remarks ,$limit, $offset) {
	$sql = "SELECT 
				ru.res_id, doc_ID, stat,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name, 
				dt.doc_name AS document_name, 
				rd.purpose_name AS purpose_name, 
				rd.date_req, 
				rd.date_processed,
				rd.remarks 
			FROM request_doc rd
			INNER JOIN resident_users ru ON rd.res_id = ru.res_id
			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE dt.doc_name = 'Barangay Clearance' AND stat = :status AND remarks = :remarks
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();  
}

function fetchdocSearchNames($pdo, $limit, $offset,$search) {
	$sql = "SELECT 
				ru.res_id, ru.res_email AS res_email, doc_ID, stat,
				CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) AS resident_name, 
				dt.doc_name AS document_name, 
				rd.purpose_name AS purpose_name, 
				rd.date_req, 
				rd.remarks 
			FROM request_doc rd
			INNER JOIN resident_users ru ON rd.res_id = ru.res_id
			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE dt.doc_name = 'Barangay Clearance'
			AND ru.res_fname LIKE '{$search}%' OR ru.res_lname LIKE '{$search}%' 
			OR ru.res_midname LIKE '{$search}%' OR CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) LIKE '{$search}%'
			OR ru.res_id LIKE '{$search}%'
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	$stmt->rowCount();
	return $stmt->fetchAll();  
}

	function fetchLatestRequest($pdo, $userId) {
		$sql = "SELECT
				rd.request_id,
				rd.res_id AS resident_id,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
				ru.addr_sitio AS sitio,
				rd.doc_ID AS document_id,
				dt.doc_name AS document_name,
				rd.doctype_id AS document_type_id, 
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

	// function fetchDocRateClearance($pdo, $docType_id){
	// 	$sql = "SELECT doc_amount FROM doc_type WHERE docType_id = :docType_id";
	// 	$stmt = $pdo->prepare($sql);
	// 	$stmt->bindParam(':docType_id', $docType_id, PDO::PARAM_INT);
	// 	$stmt->execute();
	// 	$result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row
	// 	return $result ? $result['doc_amount'] : null; // Return the doc_amount or null if no result
	// }

	// function fetchListofComplaints($pdo, $offset = 0, $limit = null, $caseType = null) {
	// 	$sql = "SELECT 
	// 				ct.complaint_id AS complaint_id,
	// 				CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) AS respondent_name,
	// 				ct.case_type AS case_type, 
	// 				ct.incident_date AS incident_date, 
	// 				ct.incident_time AS incident_time, 
	// 				ct.incident_place AS incident_place, 
	// 				ct.date_filed AS date_filed, 
	// 				ct.status AS status,
	// 				ct.remarks AS remarks,
	// 				ct.narrative AS narrative,
	// 				ct.evidence AS evidence,
	// 				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
	// 				ru.res_email AS resident_email,
	// 				ct.respondent_age AS respondent_age,
	// 				ct.respondent_gender AS respondent_gender
	// 			FROM complaints_tbl ct 
	// 			INNER JOIN resident_users ru ON ct.res_id = ru.res_id";
	
	// 	if ($caseType !== null && $caseType !== '') {
	// 		$sql .= " WHERE ct.case_type = :caseType";
	// 	}
	
	// 	$sql .= " ORDER BY ct.date_filed DESC";
	
	// 	if ($limit !== null) {
	// 		$sql .= " LIMIT :offset, :limit";
	// 	}
	
	// 	$stmt = $pdo->prepare($sql);
	
	// 	if ($limit !== null) {
	// 		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	// 		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	// 	}
	
	// 	if ($caseType !== null && $caseType !== '') {
	// 		$stmt->bindParam(':caseType', $caseType, PDO::PARAM_STR);
	// 	}
	
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }
	
	// function countTotalComplaints($pdo, $caseType = null) {
	// 	$sql = "SELECT COUNT(*) FROM complaints_tbl ct";
	// 	if ($caseType !== null && $caseType !== '') {
	// 		$sql .= " WHERE ct.case_type = :caseType";
	// 	}
	// 	$stmt = $pdo->prepare($sql);
	// 	if ($caseType !== null && $caseType !== '') {
	// 		$stmt->bindParam(':caseType', $caseType, PDO::PARAM_STR);
	// 	}
	// 	$stmt->execute();
	// 	return $stmt->fetchColumn();
	// }
	
	function fetchListofComplaints($pdo, $offset = 0, $limit = null, $caseType = null, $incidentPlace = null) {
		$sql = "SELECT 
					ct.complaint_id AS complaint_id,
					CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) AS respondent_name,
					ct.case_type AS case_type, 
					ct.incident_date AS incident_date, 
					ct.incident_time AS incident_time, 
					ct.incident_place AS incident_place, 
					ct.date_filed AS date_filed, 
					ct.status AS status,
					ct.comment AS comment,
					ct.narrative AS narrative,
					ct.evidence AS evidence,
					CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
					ru.res_email AS resident_email,
					ct.respondent_age AS respondent_age,
					ct.respondent_gender AS respondent_gender
				FROM complaints_tbl ct 
				INNER JOIN resident_users ru ON ct.res_id = ru.res_id";
		
		$conditions = [];
		$params = [];
	
		if ($caseType !== null && $caseType !== '') {
			$conditions[] = "ct.case_type = :caseType";
			$params[':caseType'] = $caseType;
		}
	
		if ($incidentPlace !== null && $incidentPlace !== '') {
			$conditions[] = "ct.incident_place = :incidentPlace";
			$params[':incidentPlace'] = $incidentPlace;
		}
	
		if (count($conditions) > 0) {
			$sql .= " WHERE " . implode(" AND ", $conditions);
		}
	
		$sql .= " ORDER BY ct.date_filed DESC";
		
		if ($limit !== null) {
			$sql .= " LIMIT :offset, :limit";
			$params[':offset'] = $offset;
			$params[':limit'] = $limit;
		}
		
		$stmt = $pdo->prepare($sql);
		
		foreach ($params as $key => $value) {
			if ($key == ':offset' || $key == ':limit') {
				$stmt->bindValue($key, $value, PDO::PARAM_INT);
			} else {
				$stmt->bindValue($key, $value, PDO::PARAM_STR);
			}
		}
		
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	

	

	// function fetchHistoricalComplaints($pdo,$offset, $limit) {
	// 	$sql = "SELECT 
	// 				ct.complaint_id AS complaint_id,
	// 				CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) AS respondent_name,
	// 				ct.case_type AS case_type, 
	// 				ct.incident_date AS incident_date, 
	// 				ct.incident_time AS incident_time, 
	// 				ct.incident_place AS incident_place, 
	// 				ct.date_filed AS date_filed, 
	// 				ct.status AS status,
	// 				ct.remarks AS remarks,
	// 				ct.narrative AS narrative,
	// 				ct.evidence AS evidence,
	// 				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
	// 				ru.res_email AS resident_email,
	// 				ct.respondent_age AS respondent_age,
	// 				ct.respondent_gender AS respondent_gender
	// 			FROM complaints_tbl ct 
	// 			INNER JOIN resident_users ru ON ct.res_id = ru.res_id
	// 			ORDER BY date_filed DESC";
	// 	$stmt = $pdo->prepare($sql);
	// 	$stmt->execute();
	// 	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	// }
	
	// function fetchTotalComplaints($pdo) {
	// 	$sql = "SELECT COUNT(*) FROM complaints_tbl";
	// 	$stmt = $pdo->prepare($sql);
	// 	$stmt->execute();
	// 	return $stmt->fetchColumn();
	// }

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

	function fetchProfilePicture($pdo, $userId) {
		$sql = "SELECT profile_picture FROM resident_users WHERE res_ID = :userId";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchResdocsRequest($pdo, $userId, $status, $limit, $offset) {
		$sql = "SELECT 
				rd.doc_ID, dt.doc_name AS document_name, rd.stat, 
				rd.date_req, rd.remarks, rd.purpose_name, rd.qrCode_image,
				dt.doc_amount AS document_price
			FROM request_doc rd
			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			WHERE rd.res_id = :userId AND rd.stat = :status
			ORDER BY rd.date_req DESC
			LIMIT :limit OFFSET :offset";
	
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':status', $status, PDO::PARAM_STR);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function countResdocsRequest($pdo, $userId, $status) {
		$sql = "SELECT COUNT(*) FROM request_doc WHERE res_id = :userId AND stat = :status";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':status', $status, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchColumn();
	}

	function fetchComplaints($pdo, $userId, $limit, $offset) {
		$sql = "SELECT * FROM complaints_tbl WHERE res_id = :userId ORDER BY date_filed DESC LIMIT :limit OFFSET :offset";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	function countComplaints($pdo, $userId) {
		$sql = "SELECT COUNT(*) FROM complaints_tbl WHERE res_id = :userId";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
?>