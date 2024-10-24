<?php

$host = 'localhost';
$db   = 'database_pusokanon';
$user = 'root';
$pass = '';
$port = '3307';

// $host = 'localhost';
// $db   = 'pfnvpzmi_database_pusokanon';
// $user = 'pfnvpzmi_database_pusokanon';
// $pass = 'LZ9NQrFT57aycz2yXJHN';
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
function hashPassword($password){
	return password_hash($password, PASSWORD_BCRYPT);
}

// Function to verify password
function verifyPassword($password, $hash){
	return password_verify($password, $hash);
}

// Encryption key (you should use a secure key management system)
define('ENCRYPTION_KEY', 'qwmnsdfghankyetr');

// Function to encrypt data
function encryptData($data){
	return openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_KEY);
}

// Function to decrypt data
function decryptData($data){
	return openssl_decrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_KEY);
}

function verifyEncryptedUser($username, $encryptedVal){
    $decryptedVal = decryptData($encryptedVal);
    return verifyPassword($username,$decryptedVal);
}

// Function to encrypt date
function encryptDate($date){
    $timestamp = strtotime($date);
    return encryptData($timestamp);
}

// Function to decrypt date
function decryptDate($encryptedDate){
    $timestamp = decryptData($encryptedDate);
    return date('Y-m-d', $timestamp);
}

// Function to encrypt number
function encryptNumber($number){
    return encryptData((string)$number);
}

// Function to decrypt number
function decryptNumber($encryptedNumber){
    return (int)decryptData($encryptedNumber);
}

// Function to compare encrypted dates
function compareEncryptedDates($encryptedDate1, $encryptedDate2){
    return strcmp($encryptedDate1, $encryptedDate2);
}


function fetchRegister($pdo, $limit, $offset, $sitio = null, $search = null) {
    $sql = "SELECT * FROM resident_users WHERE account_active_status = 'Unregistered'";
    $params = [];

    if ($sitio && $sitio != 'All') {
        $sql .= " AND addr_sitio = ?";
        $params[] = $sitio;
    }

    if ($search) {
        $sql .= " AND (res_fname LIKE ? OR res_lname LIKE ? OR CONCAT(res_fname, ' ', res_lname) LIKE ?)";
        $searchTerm = "%$search%";
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
    }

    $sql .= " ORDER BY register_at DESC LIMIT ? OFFSET ?";
    $params[] = $limit;
    $params[] = $offset;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

//for pagination in the pending residents table
function fetchTotalPending($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status = 'Unregistered'";
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
function fetchTotalResidents($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}


// function fetchResident($pdo, $limit, $offset) {
// 	$sql = "SELECT * FROM resident_users LIMIT :limit OFFSET :offset";  
// 	$stmt = $pdo->prepare($sql);
// 	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
// 	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
// 	$stmt->execute();
// 	return $stmt->fetchAll();  
// }

function fetchResident($pdo, $limit, $offset, $gender = null, $ageRange = null, $sitio = null, $accountStatus = null)
{
	$sql = "SELECT * FROM resident_users WHERE account_active_status != 'Unregistered'";
	$params = [];

	if ($gender !== null && $gender !== 'All') {
		$sql .= " AND gender = :gender";
		$params[':gender'] = $gender;
	}

	if ($ageRange !== null && $ageRange !== 'All') {

		switch ($ageRange) {
			case 'Under 18':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18";
				break;
			case 'Young Adults (18-24)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 24";
				break;
			case 'Adults (25-39)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 39";
				break;
			case 'Middle-Aged (40-59)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 59";
				break;
			case 'Seniors (60 and Over)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60";
				break;
		}
	}

	if ($sitio !== null && $sitio !== 'All') {
		$sql .= " AND addr_sitio = :sitio";
		$params[':sitio'] = $sitio;
	}

	if ($accountStatus !== null && $accountStatus !== 'All') {
		$sql .= " AND account_active_status = :accountStatus";
		$params[':accountStatus'] = ($accountStatus == 'Active') ? 'Active' : 'Deactivated';
	}

	$sql .= " ORDER BY account_active_status DESC, res_id ASC LIMIT :limit OFFSET :offset";
	$params[':limit'] = $limit;
	$params[':offset'] = $offset;

	$stmt = $pdo->prepare($sql);
	foreach ($params as $key => &$val) {
		$stmt->bindParam($key, $val);
	}
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchTotalResidentsWithFilters($pdo, $gender = null, $ageRange = null, $sitio = null, $accountStatus = null)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered'";
    $params = [];

	if ($gender !== null && $gender !== 'All') {
		$sql .= " AND gender = :gender";
		$params[':gender'] = $gender;
	}

	if ($ageRange !== null && $ageRange !== 'All') {

		switch ($ageRange) {
			case 'Young Adults (18-24)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 24";
				break;
			case 'Adults (25-39)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 39";
				break;
			case 'Middle-Aged (40-59)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 59";
				break;
			case 'Seniors (60 and Over)':
				$sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60";
				break;
		}
	}

	if ($sitio !== null && $sitio !== 'All') {
		$sql .= " AND addr_sitio = :sitio";
		$params[':sitio'] = $sitio;
	}

	if ($accountStatus !== null && $accountStatus !== 'All') {
		$sql .= " AND account_active_status = :accountStatus";
		$params[':accountStatus'] = ($accountStatus == 'Active') ? 1 : 0;
	}

	$stmt = $pdo->prepare($sql);
	foreach ($params as $key => &$val) {
		$stmt->bindParam($key, $val);
	}
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchResidentById($pdo, $search)
{
	$sql = "SELECT * FROM resident_users WHERE account_active_status != 'Unregistered' AND
				(res_ID = ? OR 
				res_fname LIKE ? OR 
				res_lname LIKE ? OR 
				CONCAT(res_fname, ' ', res_lname) LIKE ?)";
	$stmt = $pdo->prepare($sql);
	$searchLike = "%$search%";
	$stmt->execute([$search, $searchLike, $searchLike, $searchLike]);
	return $stmt->fetchAll();
}



// function fetchdocSearchNames($pdo ,$limit, $offset, $search)
// {
// 	$sql = "SELECT 
// 				ru.res_id, ru.res_email AS res_email, doc_ID, stat,
// 				CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) AS resident_name, 
// 				dt.doc_name AS document_name, 
// 				rd.purpose_name AS purpose_name, 
// 				rd.date_req, 
// 				rd.remarks 
// 			FROM request_doc rd
// 			INNER JOIN resident_users ru ON rd.res_id = ru.res_id
// 			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
// 			INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
// 			WHERE stat != 'Done' AND (ru.res_fname LIKE '{$search}%' OR ru.res_lname LIKE '{$search}%' 
// 			OR ru.res_midname LIKE '{$search}%' OR CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) LIKE '{$search}%'
// 			OR ru.res_id LIKE '{$search}%') AND dt.doc_name = 'Barangay Residency'
// 			LIMIT :limit OFFSET :offset";
// 	$stmt = $pdo->prepare($sql);
// 	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
// 	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
// 	$stmt->execute();
// 	$stmt->rowCount();
// 	return $stmt->fetchAll();
// }

function fetchLatestRequest($pdo, $userId)
{
	$sql = "SELECT
				rd.request_id,
				rd.res_id AS resident_id,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
				ru.addr_sitio AS sitio,
				rd.doc_ID AS document_id,
				dt.doc_name AS document_name,
				rd.doctype_id AS document_type_id, 
				rd.purpose_name AS purpose, 
				rd.stat AS stat,
				rd.remarks AS remarks,
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

function fetchSpecificRequest($pdo, $request_id)
{
	$sql = "SELECT
				rd.request_id,
				rd.res_id AS resident_id,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
				ru.addr_sitio AS sitio,
				rd.doc_ID AS document_id,
				dt.doc_name AS document_name,
				rd.doctype_id AS document_type_id, 
				rd.purpose_name AS purpose, 
				rd.stat AS stat,
				rd.remarks AS remarks,
				rd.date_req AS request_date,
				dt.doc_amount
				FROM request_doc rd 
				INNER JOIN resident_users ru ON rd.res_id = ru.res_id
				INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
				WHERE rd.request_id = :request_id 
				ORDER BY rd.date_req DESC
				LIMIT 1";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':request_id', $request_id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getTotalStaffCount($pdo, $search = null) {
    $query = "SELECT COUNT(*) FROM barangay_staff bs";
    
    if (!empty($search)) {
        $query .= " WHERE bs.staff_id = :search 
                    OR AES_DECRYPT(bs.staff_fname, :key) LIKE :search_like
                    OR AES_DECRYPT(bs.staff_midname, :key) LIKE :search_like
                    OR AES_DECRYPT(bs.staff_lname, :key) LIKE :search_like
                    OR AES_DECRYPT(bs.staff_email, :key) LIKE :search_like";
    }

    $stmt = $pdo->prepare($query);

    if (!empty($search)) {
        $search_like = "%$search%";
        $stmt->bindParam(':search', $search);
        $stmt->bindParam(':key', ENCRYPTION_KEY);
        $stmt->bindParam(':search_like', $search_like);
    }

    $stmt->execute();
    return $stmt->fetchColumn();
}


function fetchStaffAccounts($pdo, $search = null) {
    $sql = "SELECT bs.staff_id, 
            bs.staff_fname,
            bs.staff_midname,
            bs.staff_lname,
			bs.staff_suffix,
            bs.staff_email, 
			bs.user_name,
			bs.birth_date,
			bs.gender,
            bs.contact_no, 
            bs.userRole_id, 
            ac.role_definition, 
            bs.status
            FROM barangay_staff bs
            INNER JOIN account_role ac ON bs.userRole_id = ac.userRole_id
            ORDER BY bs.staff_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($search)) {
        $filtered_results = array_filter($results, function($staff) use ($search) {
            $full_name = strtolower(
                decryptData($staff['staff_fname']) . ' ' . 
                decryptData($staff['staff_midname']) . ' ' . 
                decryptData($staff['staff_lname'])
            );
            $email = strtolower(decryptData($staff['staff_email']));
            $search_lower = strtolower($search);

            return (
                strpos($full_name, $search_lower) !== false ||
                strpos($email, $search_lower) !== false ||
                $staff['staff_id'] == $search
            );
        });
        return array_values($filtered_results);
    }

    return $results;
}

function fetchStaffInfo($pdo, $staffId) {
    $sql = "SELECT bs.staff_id, 
                   bs.staff_fname,
                   bs.staff_midname,
                   bs.staff_lname,
                   bs.staff_email, 
                   bs.contact_no, 
                   bs.userRole_id, 
                   ac.role_definition, 
                   bs.status,
                   bs.birth_date,
                   bs.gender,
                   bs.staff_suffix,
                   bs.user_name,
                   bs.staff_password
            FROM barangay_staff bs
            INNER JOIN account_role ac ON bs.userRole_id = ac.userRole_id";

    if ($staffId !== null) {
        $sql .= " WHERE bs.staff_id = :staff_id";
    }

    try {
        $stmt = $pdo->prepare($sql);
        if ($staffId !== null) {
            $stmt->bindParam(':staff_id', $staffId, PDO::PARAM_INT);
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            // Decrypt the data
            foreach ($results as &$row) {
                $row['staff_fname'] = decryptData($row['staff_fname']);
                $row['staff_midname'] = decryptData($row['staff_midname']);
                $row['staff_lname'] = decryptData($row['staff_lname']);
                $row['staff_email'] = decryptData($row['staff_email']);
               
                $row['birth_date'] = decryptDate($row['birth_date']);
                $row['gender'] = $row['gender'];
                $row['staff_suffix'] = $row['staff_suffix'];
                $row['contact_no'] = $row['contact_no'];
                $row['user_name'] = decryptData($row['user_name']);
				$row['staff_password'] = $row['staff_password'];
            }
        }
        return $results;
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());
        return [];
    }
}


// function safeDecrypt($data, $fieldName) {
//     if (is_null($data)) {
//         error_log("Null data passed for decryption in $fieldName.");
//         return $data; // Or return a default value if needed
//     }
//     try {
//         $decrypted = decryptData($data);
//         if ($decrypted === false) {
//             error_log("Decryption failed for $fieldName: " . error_get_last()['message']);
//             return $data;
//         }
//         return $decrypted;
//     } catch (Exception $e) {
//         error_log("Decryption error for $fieldName: " . $e->getMessage());
//         return $data;
//     }
// }

// function safeDecryptDate($data, $fieldName) {
//     if (is_null($data)) {
//         error_log("Null data passed for decryption in $fieldName.");
//         return $data; // Or return a default value if needed
//     }
//     try {
//         $decrypted = decryptDate($data);
//         if ($decrypted === false) {
//             error_log("Decryption failed for $fieldName: " . error_get_last()['message']);
//             return $data;
//         }
//         return $decrypted;
//     } catch (Exception $e) {
//         error_log("Decryption error for $fieldName: " . $e->getMessage());
//         return $data;
//     }
// }

// function decryptDate($encryptedDate) {
//     $decryptedDate = decryptData($encryptedDate); // Reuse the same decryption function
    
//     if ($decryptedDate === false) {
//         return false; // Indicate decryption failure
//     }

//     // Ensure the decrypted date is in a valid format
//     $date = DateTime::createFromFormat('Y-m-d', $decryptedDate);
//     if ($date === false) {
//         return false; // Indicate format validation failure
//     }

//     return $date->format('Y-m-d'); // Return the date in 'Y-m-d' format
// }


// function fetchStaffAccounts($pdo){
// 	$sql = "SELECT bs.staff_id, 
// 			bs.staff_fname, bs.staff_midname, bs.staff_lname,
// 			bs.staff_email, bs.contact_no, bs.userRole_id, ac.role_definition
// 			FROM barangay_staff bs
// 			INNER JOIN account_role ac ON bs.userRole_id = ac.userRole_id";
// 	$stmt = $pdo->prepare($sql);
// 	$stmt->execute();
// 	return $stmt->fetchAll();
// }

// function fetchDocRateClearance($pdo, $docType_id){
// 	$sql = "SELECT doc_amount FROM doc_type WHERE docType_id = :docType_id";
// 	$stmt = $pdo->prepare($sql);
// 	$stmt->bindParam(':docType_id', $docType_id, PDO::PARAM_INT);
// 	$stmt->execute();
// 	$result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row
// 	return $result ? $result['doc_amount'] : null; // Return the doc_amount or null if no result
// }

function fetchListofComplaints($pdo, $offset = 0, $limit = null, $caseType = null, $incidentPlace = null, $status = null, $searchTerm = null) {
    $sql = "SELECT 
                ct.complaint_id AS complaint_id,
                CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) AS respondent_name,
                ct.case_type AS case_type, 
                ct.incident_date AS incident_date, 
                ct.incident_time AS incident_time, 
                ct.incident_place AS incident_place, 
                ct.date_filed AS date_filed, 
                ct.hearing_date AS hearing_date,
                ct.hearing_time AS hearing_time,
                ct.status AS status,
                ct.remarks AS remarks,
                ct.comment AS comment,
                ct.narrative AS narrative,
                ct.evidence AS evidence,
                CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
                ru.res_email AS resident_email,
                ct.respondent_age AS respondent_age,
                ct.respondent_gender AS respondent_gender
            FROM complaints_tbl ct 
            INNER JOIN resident_users ru ON ct.res_id = ru.res_id";

    $params = [];

    // List of predefined case types
    $predefinedCaseTypes = [
        "Bullying", 
        "Damaging Properties", 
        "Defamation", 
        "Libel", 
        "Physical Abuse", 
        "Threat", 
        "Trespassing", 
        "Theft", 
        "Vandalism"
    ];

    // Add WHERE clause only if filters are provided
    if ($caseType || $incidentPlace || $status || $searchTerm) {
        $sql .= " WHERE 1=1";
        
        if ($caseType !== null && $caseType !== '') {
            if ($caseType === 'Other') {
                // Fetch cases that are NOT in the predefined list when "Other" is selected
                $placeholders = implode(',', array_fill(0, count($predefinedCaseTypes), '?'));
                $sql .= " AND ct.case_type NOT IN ($placeholders)";
                $params = array_merge($params, $predefinedCaseTypes);
            } else {
                $sql .= " AND ct.case_type = ?";
                $params[] = $caseType;
            }
        }

        if ($incidentPlace !== null && $incidentPlace !== '') {
            $sql .= " AND ct.incident_place = ?";
            $params[] = $incidentPlace;
        }

        if ($status !== null && $status !== '') {
            $sql .= " AND ct.status = ?";
            $params[] = $status;
        }

        if ($searchTerm !== null && $searchTerm !== '') {
            $sql .= " AND (CONCAT(ru.res_fname, ' ', ru.res_lname) LIKE ? 
                      OR CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) LIKE ?)";
            $params[] = "%$searchTerm%";
            $params[] = "%$searchTerm%";
        }
    }

    $sql .= " ORDER BY ct.date_filed DESC";

    if ($limit !== null) {
        $sql .= " LIMIT ?, ?";
        $params[] = (int)$offset;
        $params[] = (int)$limit;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

	
// function fetchListofComplaints($pdo, $offset = 0, $limit = null, $caseType = null, $incidentPlace = null, $status = null, $searchTerm = null) {
//     $sql = "SELECT 
//                 ct.complaint_id AS complaint_id,
//                 CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) AS respondent_name,
//                 ct.case_type AS case_type, 
//                 ct.incident_date AS incident_date, 
//                 ct.incident_time AS incident_time, 
//                 ct.incident_place AS incident_place, 
//                 ct.date_filed AS date_filed, 
//                 ct.hearing_date AS hearing_date,
//                 ct.hearing_time AS hearing_time,
//                 ct.status AS status,
//                 ct.remarks AS remarks,
//                 ct.comment AS comment,
//                 ct.narrative AS narrative,
//                 ct.evidence AS evidence,
//                 CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
//                 ru.res_email AS resident_email,
//                 ct.respondent_age AS respondent_age,
//                 ct.respondent_gender AS respondent_gender
//             FROM complaints_tbl ct 
//             INNER JOIN resident_users ru ON ct.res_id = ru.res_id";

//     $params = [];

//     // Add WHERE clause only if filters are provided
//     if ($caseType || $incidentPlace || $status || $searchTerm) {
//         $sql .= " WHERE 1=1";
        
//         if ($caseType !== null && $caseType !== '') {
//             $sql .= " AND ct.case_type = ?";
//             $params[] = $caseType;
//         }

//         if ($incidentPlace !== null && $incidentPlace !== '') {
//             $sql .= " AND ct.incident_place = ?";
//             $params[] = $incidentPlace;
//         }

//         if ($status !== null && $status !== '') {
//             $sql .= " AND ct.status = ?";
//             $params[] = $status;
//         }

//         if ($searchTerm !== null && $searchTerm !== '') {
//             $sql .= " AND (CONCAT(ru.res_fname, ' ', ru.res_lname) LIKE ? 
//                       OR CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) LIKE ?)";
//             $params[] = "%$searchTerm%";
//             $params[] = "%$searchTerm%";
//         }
//     }

//     $sql .= " ORDER BY ct.date_filed DESC";

//     if ($limit !== null) {
//         $sql .= " LIMIT ?, ?";
//         $params[] = (int)$offset;
//         $params[] = (int)$limit;
//     }

//     $stmt = $pdo->prepare($sql);
//     $stmt->execute($params);
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function fetchComplaintsHistory($pdo, $offset = 0, $limit = null, $caseType = null, $incidentPlace = null, $status = null, $searchTerm = null) {
    $sql = "SELECT 
                ct.complaint_id AS complaint_id,
                CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) AS respondent_name,
                ct.case_type AS case_type, 
                ct.incident_date AS incident_date, 
                ct.incident_time AS incident_time, 
                ct.incident_place AS incident_place, 
                ct.date_filed AS date_filed, 
				ct.date_closed AS date_closed, 
                ct.status AS status,
                ct.remarks AS remarks,
				ct.comment AS comment,
                ct.narrative AS narrative,
                ct.evidence AS evidence,
                CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name,
                ru.res_email AS resident_email,
                ct.respondent_age AS respondent_age,
                ct.respondent_gender AS respondent_gender
            FROM complaints_tbl ct 
            INNER JOIN resident_users ru ON ct.res_id = ru.res_id
            WHERE ct.remarks LIKE 'CASE CLOSED'";

    $params = [];

    if ($caseType !== null && $caseType !== '') {
		if (strtolower($caseType) === 'other') {
			$predefinedTypes = ["Bullying", "Damaging Properties", "Defamation", "Libel", 
								"Physical Abuse", "Threat", "Trespassing", "Theft", "Vandalism"];
			$placeholders = implode(',', array_fill(0, count($predefinedTypes), '?'));
			$sql .= " AND ct.case_type NOT IN ($placeholders)";
			$params = array_merge($params, $predefinedTypes);
		} else {
			$sql .= " AND ct.case_type = ?";
			$params[] = $caseType;
		}
	}

    if ($incidentPlace !== null && $incidentPlace !== '') {
        $sql .= " AND ct.incident_place = ?";
        $params[] = $incidentPlace;
    }

    if ($status !== null && $status !== '') {
        $sql .= " AND ct.status = ?";
        $params[] = $status;
    }

    if ($searchTerm !== null && $searchTerm !== '') {
        $sql .= " AND (CONCAT(ru.res_fname, ' ', ru.res_lname) LIKE ? 
                  OR CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) LIKE ?
                  OR ru.res_fname LIKE ?
                  OR ru.res_lname LIKE ?
                  OR ct.respondent_fname LIKE ?
                  OR ct.respondent_lname LIKE ?)";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
    }


    $sql .= " ORDER BY ct.date_closed DESC";

    if ($limit !== null) {
        $sql .= " LIMIT ?, ?";
        $params[] = (int)$offset;
        $params[] = (int)$limit;
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getTotalComplaints($pdo, $caseType, $incidentPlace, $status, $searchTerm) {
    $sql = "SELECT COUNT(*) 
            FROM complaints_tbl ct
            INNER JOIN resident_users ru ON ct.res_id = ru.res_id
            WHERE ct.remarks LIKE 'CASE CLOSED'";

    $params = [];

    if ($caseType !== null && $caseType !== '') {
		if (strtolower($caseType) === 'other') {
			$predefinedTypes = ["Bullying", "Damaging Properties", "Defamation", "Libel", 
								"Physical Abuse", "Threat", "Trespassing", "Theft", "Vandalism"];
			$placeholders = implode(',', array_fill(0, count($predefinedTypes), '?'));
			$sql .= " AND ct.case_type NOT IN ($placeholders)";
			$params = array_merge($params, $predefinedTypes);
		} else {
			$sql .= " AND ct.case_type = ?";
			$params[] = $caseType;
		}
	}

    if ($incidentPlace !== null && $incidentPlace !== '') {
        $sql .= " AND ct.incident_place = ?";
        $params[] = $incidentPlace;
    }

    if ($status !== null && $status !== '') {
        $sql .= " AND ct.status = ?";
        $params[] = $status;
    }

    if ($searchTerm !== null && $searchTerm !== '') {
        $sql .= " AND (CONCAT(ru.res_fname, ' ', ru.res_lname) LIKE ? 
                  OR CONCAT(ct.respondent_fname, ' ', ct.respondent_lname) LIKE ?
                  OR ru.res_fname LIKE ?
                  OR ru.res_lname LIKE ?
                  OR ct.respondent_fname LIKE ?
                  OR ct.respondent_lname LIKE ?)";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
        $params[] = "%$searchTerm%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

function fetchTotalPendingComp($pdo)
{
	$sql = "SELECT COUNT(*) FROM complaints_tbl WHERE status = 'Pending'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchTotalApprovedComp($pdo)
{
	$sql = "SELECT COUNT(*) FROM complaints_tbl WHERE status = 'Approved'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchTotalRejectedComp($pdo)
{
	$sql = "SELECT COUNT(*) FROM complaints_tbl WHERE status = 'Rejected'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchTotalMales($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered' AND gender = 'Male'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchTotalFemales($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered' AND gender = 'Female'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchPendingAccounts($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status = 'Unregistered'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchRegisteredVoters($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered' AND registered_voter = 'Registered'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchNonRegisteredVoters($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered' AND registered_voter != 'Registered'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchUsersBySitio($pdo, $sitio)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE account_active_status != 'Unregistered' AND addr_sitio = :sitio";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':sitio', $sitio, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchNumberOfRequestedDocuments($pdo, $document)
{
	$sql = "SELECT COUNT(*) FROM request_doc WHERE docType_id = :document";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':document', $document, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function numRequestedDocsInPending($pdo, $document)
{
	$sql = "SELECT COUNT(*) FROM request_doc WHERE stat = 'Pending' AND docType_id = :document";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':document', $document, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchDocumentRates($pdo, $id)
{
	$sql = "SELECT doc_amount FROM doc_type WHERE docType_id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchProfilePicture($pdo, $userId)
{
	$sql = "SELECT profile_picture FROM resident_users WHERE res_ID = :userId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchResdocsRequest($pdo, $userId, $status, $limit, $offset)
{
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

function countResdocsRequest($pdo, $userId, $status)
{
	$sql = "SELECT COUNT(*) FROM request_doc WHERE res_id = :userId AND stat = :status";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchComplaints($pdo, $userId, $limit, $offset)
{
	$sql = "SELECT * FROM complaints_tbl WHERE res_id = :userId ORDER BY date_filed DESC LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countComplaints($pdo, $userId)
{
	$sql = "SELECT COUNT(*) FROM complaints_tbl WHERE res_id = :userId";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchDocumentHistory($pdo, $userId, $limit, $offset)
{
    $sql = "SELECT 
                rd.doc_ID, dt.doc_name AS document_name, rd.stat, 
                rd.date_req, rd.remarks, rd.purpose_name, rd.qrCode_image,
                CASE 
                    WHEN rd.purpose_id BETWEEN 1 AND 4 THEN dp.purpose_fee
                    ELSE dt.doc_amount
                END AS document_price
            FROM request_doc rd
            INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
            INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
            WHERE rd.res_id = :userId AND rd.stat = 'Done' AND rd.remarks = 'Released'
            ORDER BY rd.date_req DESC
            LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countDocumentHistory($pdo, $userId)
{
    $sql = "SELECT COUNT(*) FROM request_doc WHERE res_id = :userId AND stat = 'Done' AND remarks = 'Released'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function accountRole($pdo){
	$sql = "SELECT userRole_id, role_definition FROM account_role WHERE userRole_id != 2";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



//------------admin manage document request connection
function fetchdocsRequest($pdo,$doctype ,$status, $limit, $offset)//connection in getting document request without search function
{
	$sql = "SELECT 
                ru.res_id, 
                ru.res_email AS res_email, 
                rd.doc_ID AS doc_ID,  -- Specify the source of doc_ID
                rd.stat,
                CONCAT(ru.res_fname, ' ', ru.res_midname, ' ', ru.res_lname) AS resident_name, 
                dt.doc_name AS document_name, 
                dp.purpose_name AS purpose_name,
                rd.purpose_name AS purp_name,
                rd.request_id,
                rd.date_req, 
                rd.remarks 
            FROM request_doc rd
            INNER JOIN resident_users ru ON rd.res_id = ru.res_id
            INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
            INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
            WHERE dt.doc_name = :doctype AND rd.stat = :status
            LIMIT :limit OFFSET :offset ";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt-> bindParam(':doctype', $doctype, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchdocsRequestPermits($pdo,$doctype ,$status, $limit, $offset)//connection in getting document request without search function
{
	$sql = "SELECT 
                ru.res_id, 
                ru.res_email AS res_email, 
                rd.doc_ID AS doc_ID,  -- Specify the source of doc_ID
                rd.stat,
                CONCAT(ru.res_fname, ' ', ru.res_midname, ' ', ru.res_lname) AS resident_name, 
                dt.doc_name AS document_name, 
                dp.purpose_name AS purpose_name, 
                rd.request_id,
                rd.date_req, 
                at.appt_date AS  appt_date,
                at.appt_time AS appt_time,
                rd.remarks 
            FROM request_doc rd
            INNER JOIN appointment_tbl at ON rd.doc_ID = at.doc_ID
            INNER JOIN resident_users ru ON rd.res_id = ru.res_id
            INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
            INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
            WHERE dt.doc_name = :doctype AND rd.stat = :status
            LIMIT :limit OFFSET :offset ";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt-> bindParam(':doctype', $doctype, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchDocumentRequirements($pdo, $requestid)
{
    $sql = "SELECT dr.requirement_file AS document_requirements
            FROM doc_requirements dr
            INNER JOIN request_doc rd ON dr.doc_ID = rd.doc_ID
            WHERE rd.request_id = :requestid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':requestid', $requestid, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchdocsRequestSearch($pdo,$doctype ,$status, $limit, $offset,$search)//connection in getting document request with search functionality
{
	$sql = "SELECT 
				ru.res_id, ru.res_email AS res_email, doc_ID, stat,
                CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) AS resident_name, 
                dt.doc_name AS document_name, 
                rd.purpose_name AS purpose_name, 
                rd.request_id, 
                rd.date_req, 
                rd.remarks 
            FROM request_doc rd
            INNER JOIN resident_users ru ON rd.res_id = ru.res_id
            INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
            INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE dt.doc_name = :doctype AND stat = :status AND (ru.res_fname LIKE '{$search}%' OR ru.res_lname LIKE '{$search}%' 
			OR ru.res_midname LIKE '{$search}%' OR CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) LIKE '{$search}%'
			OR CONCAT(ru.res_fname,' ', ru.res_lname) LIKE '{$search}%'
			OR ru.res_id LIKE '{$search}%')
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt-> bindParam(':doctype', $doctype, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchdocsRequestHistorySearch($pdo,$doctype ,$status, $remarks, $limit, $offset,$search)//connection in getting document request with search functionality
{
	$sql = "SELECT 
				ru.res_id, ru.res_email AS res_email, doc_ID, stat,
                CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) AS resident_name, 
                dt.doc_name AS document_name, 
                rd.purpose_name AS purpose_name, 
                rd.request_id, 
                rd.date_req, 
				rd.date_processed,
                rd.remarks,
                CASE 
                    WHEN rd.purpose_id = 5 THEN dt.doc_amount 
                    ELSE dp.purpose_fee 
                END AS fee
            FROM request_doc rd
            INNER JOIN resident_users ru ON rd.res_id = ru.res_id
            INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
            INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE dt.doc_name = :doctype AND stat = :status AND remarks = :remarks AND (ru.res_fname LIKE '{$search}%' OR ru.res_lname LIKE '{$search}%' 
			OR ru.res_midname LIKE '{$search}%' OR CONCAT(ru.res_fname,' ', ru.res_midname,' ', ru.res_lname) LIKE '{$search}%'
			OR CONCAT(ru.res_fname,' ', ru.res_lname) LIKE '{$search}%'
			OR ru.res_id LIKE '{$search}%')
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt-> bindParam(':doctype', $doctype, PDO::PARAM_STR);
	$stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchdocsRequestHistory($pdo, $doctype, $status, $remarks, $limit, $offset){
	$sql = "SELECT 
				ru.res_id, doc_ID, stat,
				CONCAT(ru.res_fname, ' ', ru.res_lname) AS resident_name, 
				dt.doc_name AS document_name, 
				rd.purpose_name AS purpose_name, 
				rd.date_req, 
				rd.date_processed,
				rd.remarks,
                CASE 
                    WHEN rd.purpose_id = 5 THEN dt.doc_amount 
                    ELSE dp.purpose_fee 
                END AS fee
			FROM request_doc rd
			INNER JOIN resident_users ru ON rd.res_id = ru.res_id
			INNER JOIN doc_type dt ON rd.docType_id = dt.docType_id
			INNER JOIN docs_purpose dp ON rd.purpose_id = dp.purpose_id
			WHERE dt.doc_name = :doctype AND stat = :status AND remarks = :remarks 
			ORDER BY rd.date_processed DESC
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':doctype', $doctype, PDO::PARAM_STR);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->bindParam(':remarks', $remarks, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchResidentDetails($pdo, $residentId){
    $sql = "SELECT * FROM resident_users WHERE account_active_status != 'Unregistered' AND res_ID = :residentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':residentId', $residentId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function fetchChartData($pdo){
    $sql = "SELECT isp.sitio_name, isp.total_initial_residents, 
            COUNT(CASE WHEN ru.account_active_status != 'Unregistered' THEN ru.res_ID END) as registered_residents
            FROM initial_sitio_population isp
            LEFT JOIN resident_users ru ON isp.sitio_name = ru.addr_sitio
            GROUP BY isp.sitio_name, isp.total_initial_residents
            ORDER BY isp.sitio_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchPost($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT p.* 
                           FROM announcement_posts p
                           WHERE p.post_id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetch();
}

function fetchPostMedia($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT * FROM announcement_posts_media WHERE post_id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetchAll();
}

function fetchPinnedPosts($pdo, $limit = 5) {
    $query = "SELECT p.*
              FROM announcement_posts p
              WHERE p.pinned = 1
              ORDER BY p.created_at DESC
              LIMIT :limit";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function fetchPosts($pdo, $sort, $offset, $postsPerPage) {
    switch ($sort) {
        case 'latest':
            $orderBy = "p.created_at DESC";
            break;
        case 'oldest':
            $orderBy = "p.created_at ASC";
            break;
        case 'trending':
        default:
            $orderBy = "(p.upvotes - p.downvotes) DESC, p.created_at DESC";
            break;
    }

    $query = "SELECT p.*
              FROM announcement_posts p 
              WHERE p.pinned = 0
              ORDER BY $orderBy
              LIMIT :offset, :postsPerPage";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':postsPerPage', $postsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTotalPosts($pdo) {
    $query = "SELECT COUNT(*) FROM announcement_posts WHERE pinned = 0";
    return $pdo->query($query)->fetchColumn();
}

function getUserReaction($pdo, $post_id, $res_id) {
    $stmt = $pdo->prepare("SELECT reaction_type FROM announcement_posts_reactions WHERE post_id = ? AND res_id = ?");
    $stmt->execute([$post_id, $res_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchAllPosts($pdo, $sort) {
    switch ($sort) {
        case 'latest':
            $orderBy = "p.created_at DESC";
            break;
        case 'oldest':
            $orderBy = "p.created_at ASC";
            break;
        case 'trending':
        default:
            $orderBy = "(p.upvotes - p.downvotes) DESC, p.created_at DESC";
            break;
    }

    $query = "SELECT p.*
              FROM announcement_posts p 
              WHERE p.pinned = 0
              ORDER BY $orderBy";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTotalPendingDocuments($pdo) {
    $sql = "SELECT COUNT(*) FROM request_doc WHERE stat = 'Pending' OR stat = 'Ready to pickup'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getTotalReleasedDocuments($pdo) {
    $sql = "SELECT COUNT(*) FROM request_doc WHERE stat = 'Done' AND remarks = 'Released'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getTotalDocuments($pdo) {
    $sql = "SELECT COUNT(*) FROM request_doc";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function fetchResidentPost($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT p.* 
                           FROM user_posts p
                           WHERE p.post_id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetch();
}

function fetchResidentPostMedia($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT * FROM user_posts_media WHERE post_id = ?");
    $stmt->execute([$post_id]);
    return $stmt->fetchAll();
}

function fetchPosterDetails($pdo, $residentId){
    $sql = "SELECT * FROM resident_users WHERE res_ID = :residentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':residentId', $residentId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getResidentReaction($pdo, $post_id, $res_id) {
    $stmt = $pdo->prepare("SELECT reaction_type FROM user_posts_reactions WHERE post_id = ? AND res_id = ?");
    $stmt->execute([$post_id, $res_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchAllResidentPosts($pdo, $sort) {
    switch ($sort) {
        case 'latest':
            $orderBy = "p.created_at DESC";
            break;
        case 'oldest':
            $orderBy = "p.created_at ASC";
            break;
        case 'trending':
        default:
            $orderBy = "(p.upvotes - p.downvotes) DESC, p.created_at DESC";
            break;
    }

    $query = "SELECT p.*, ru.res_fname, ru.res_lname, ru.profile_picture
              FROM user_posts p
              JOIN resident_users ru ON p.res_id = ru.res_ID
              WHERE approval_status = 'approved'
              ORDER BY $orderBy";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function fetchResidentPosts($pdo, $sort, $offset, $postsPerPage) {
    switch ($sort) {
        case 'latest':
            $orderBy = "p.created_at DESC";
            break;
        case 'oldest':
            $orderBy = "p.created_at ASC";
            break;
        case 'trending':
        default:
            $orderBy = "(p.upvotes - p.downvotes) DESC, p.created_at DESC";
            break;
    }

    $query = "SELECT p.*, ru.res_fname, ru.res_lname, ru.profile_picture
              FROM user_posts p 
              JOIN resident_users ru ON p.res_id = ru.res_ID
              WHERE p.approval_status = 'approved'
              ORDER BY $orderBy
              LIMIT :offset, :postsPerPage";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':postsPerPage', $postsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getTotalResidentPosts($pdo) {
    $query = "  SELECT COUNT(*) 
                FROM user_posts
                WHERE approval_status = 'approved'";
    return $pdo->query($query)->fetchColumn();
}

function fetchComments($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT c.*, ru.res_fname, ru.res_lname, ru.profile_picture 
                           FROM user_posts_comments c
                           JOIN resident_users ru ON c.res_id = ru.res_ID
                           WHERE c.post_id = ?
                           ORDER BY c.created_at DESC");
    $stmt->execute([$post_id]);
    return $stmt->fetchAll();
}

function fetchCommentsAnnouncements($pdo, $post_id) {
    $stmt = $pdo->prepare("SELECT c.*, ru.res_fname, ru.res_lname, ru.profile_picture 
                           FROM announcement_comments c
                           JOIN resident_users ru ON c.res_id = ru.res_ID
                           WHERE c.post_id = ?
                           ORDER BY c.created_at DESC");
    $stmt->execute([$post_id]);
    return $stmt->fetchAll();
}


function getTotalDocAmountByDocType($pdo) {
    $sql = "SELECT COALESCE(SUM(rd.doc_amount), 0) as doc_amount, COUNT(rd.docType_id) as doc_count, dt.doc_name 
            FROM doc_type dt
            LEFT JOIN request_doc rd ON rd.docType_id = dt.docType_id
            GROUP BY dt.docType_id, dt.doc_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalSum($pdo) {
    $sql = "SELECT COALESCE(SUM(rd.doc_amount), 0) as doc_amount
            FROM request_doc rd";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}
function getMonthlyDocumentSales($pdo) {
    $query = "SELECT DATE_FORMAT(date_req, '%Y-%m') as month, SUM(doc_amount) as total_amount 
              FROM request_doc 
              GROUP BY DATE_FORMAT(date_req, '%Y-%m') 
              ORDER BY month";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchOwnPostById($pdo, $resId, $search)
{
	$sql = "SELECT * FROM user_posts WHERE res_id = :resId AND
				(post_id = :search OR 
				title LIKE :searchLike)";
	$stmt = $pdo->prepare($sql);
	$searchLike = "%$search%";
	$stmt->execute([
		':resId' => $resId,
		':search' => $search,
		':searchLike' => $searchLike
	]);
	return $stmt->fetchAll();
}

function fetchTotalOwnPostsWithFilters($pdo, $resId, $popularity = null, $status = null) {
    $sql = "SELECT COUNT(*) FROM user_posts WHERE res_id = :resId";
    $params = [':resId' => $resId];

    if ($status !== null && $status !== 'all') {
        $sql .= " AND approval_status = :status";
        $params[':status'] = $status;
    }

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    $stmt->execute();
    return $stmt->fetchColumn();
}

function fetchOwnPosts($pdo, $resId, $perPage, $offset, $popularity = null, $status = null) {
    $sql = "SELECT * FROM user_posts WHERE res_id = :resId";
    $params = [':resId' => $resId];

    if ($status !== null && $status !== 'all') {
        $sql .= " AND approval_status = :status";
        $params[':status'] = $status;
    }

    switch ($popularity) {
        case 'latest':
            $sql .= " ORDER BY created_at DESC";
            break;
        case 'oldest':
            $sql .= " ORDER BY created_at ASC";
            break;
        case 'trending':
        default:
            $sql .= " ORDER BY (upvotes - downvotes) DESC, created_at DESC";
            break;
    }

    $sql .= " LIMIT :offset, :perPage";
    $params[':offset'] = $offset;
    $params[':perPage'] = $perPage;

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchAllPostById($pdo, $search)
{
    $sql = "SELECT up.*, 
                   bs.staff_fname AS encrypted_fname,
                   bs.staff_lname AS encrypted_lname
            FROM user_posts up
            LEFT JOIN barangay_staff bs ON up.approved_by = bs.staff_id
            WHERE up.post_id = :search OR up.title LIKE :searchLike";
    $stmt = $pdo->prepare($sql);
    $searchLike = "%$search%";
    $stmt->execute([
        ':search' => $search,
        ':searchLike' => $searchLike
    ]);
    $results = $stmt->fetchAll();

    foreach ($results as &$row) {
        $row['approved_by_name'] = $row['encrypted_fname'] && $row['encrypted_lname'] 
            ? decryptData($row['encrypted_fname']) . ' ' . decryptData($row['encrypted_lname'])
            : null;
        unset($row['encrypted_fname'], $row['encrypted_lname']);
    }

    return $results;
}

function getAllResPosts($pdo, $perPage, $offset, $status = null) {
    $sql = "SELECT up.*, 
                   bs.staff_fname AS encrypted_fname,
                   bs.staff_lname AS encrypted_lname
            FROM user_posts up
            LEFT JOIN barangay_staff bs ON up.approved_by = bs.staff_id";
    $params = [];

    if ($status !== null && $status !== 'all') {
        $sql .= " WHERE up.approval_status = :status";
        $params[':status'] = $status;
    }

    $sql .= " ORDER BY up.created_at DESC LIMIT :offset, :perPage";
    $params[':offset'] = $offset;
    $params[':perPage'] = $perPage;

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as &$row) {
        $row['approved_by_name'] = $row['encrypted_fname'] && $row['encrypted_lname'] 
            ? decryptData($row['encrypted_fname']) . ' ' . decryptData($row['encrypted_lname'])
            : null;
        unset($row['encrypted_fname'], $row['encrypted_lname']);
    }

    return $results;
}


function fetchTotalResPostsWithFilters($pdo, $status = null) {
    $sql = "SELECT COUNT(*) FROM user_posts";
    $params = [];

    if ($status !== null && $status !== 'all') {
        $sql .= " WHERE approval_status = :status";
        $params[':status'] = $status;
    }

    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getPostCountByStatus($pdo, $status) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_posts WHERE approval_status = :status");
    $stmt->execute(['status' => $status]);
    return $stmt->fetchColumn();
}

function countFiledCases($pdo) {
    $caseTypes = ['Bullying', 'Damaging Properties', 'Defamation', 'Libel', 'Physical Abuse', 'Threat', 'Trespassing', 'Theft', 'Vandalism'];

    $sql = "SELECT 
            CASE
                WHEN case_type IN ('" . implode("','", $caseTypes) . "') THEN case_type
                ELSE 'Others'
            END AS case_type,
            MONTH(date_filed) AS month_num, 
            MONTHNAME(date_filed) AS month, 
            COUNT(*) AS case_count 
          FROM complaints_tbl 
          GROUP BY 1, 2
          ORDER BY month_num";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Prepare data for ApexCharts
    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $caseType = $row['case_type'];
        $month = $row['month']; 
        $caseCount = $row['case_count'];

        // Add data directly to the month index (0-based)
        if (!isset($data[$caseType])) {
            $data[$caseType] = array_fill(0, 12, 0); 
        }
        $monthIndex = intval($row['month_num']) - 1; 
        $data[$caseType][$monthIndex] = $caseCount; 
    }

    return $data; 
}

function countCasesBySitioAndType($pdo) {
    $mainCaseTypes = [
        "Bullying", "Damaging Properties", "Defamation", "Libel", 
        "Physical Abuse", "Threat", "Trespassing", "Theft", "Vandalism"
    ];

    $sql = "SELECT 
            incident_place AS sitio,
            CASE WHEN case_type IN ('" . implode("','", $mainCaseTypes) . "') THEN case_type ELSE 'Others' END AS case_type,
            COUNT(*) AS case_count
          FROM complaints_tbl
          GROUP BY sitio, 
            CASE WHEN case_type IN ('" . implode("','", $mainCaseTypes) . "') THEN case_type ELSE 'Others' END
          ORDER BY sitio, case_type";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Prepare data for ApexCharts
    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $sitio = $row['sitio'];
        $caseType = $row['case_type'];
        $caseCount = $row['case_count'];

        if (!isset($data[$caseType])) {
            $data[$caseType] = [];
        }
        $data[$caseType][$sitio] = $caseCount;
    }

    return $data;
}

function fetchSitioData($pdo) {
    $sql = "SELECT isp.sitio_name, isp.total_initial_residents, 
            COUNT(CASE WHEN ru.account_active_status != 'Unregistered' THEN ru.res_ID END) as registered_residents
            FROM initial_sitio_population isp
            LEFT JOIN resident_users ru ON isp.sitio_name = ru.addr_sitio
            GROUP BY isp.sitio_name, isp.total_initial_residents
            ORDER BY isp.sitio_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

