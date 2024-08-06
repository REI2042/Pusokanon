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
function hashPassword($password)
{
	return password_hash($password, PASSWORD_BCRYPT);
}

// Function to verify password
function verifyPassword($password, $hash)
{
	return password_verify($password, $hash);
}

// Encryption key (you should use a secure key management system)
define('ENCRYPTION_KEY', 'qwmnsdfghankyetr');

// Function to encrypt data
function encryptData($data)
{
	return openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_KEY);
}

// Function to decrypt data
function decryptData($data)
{
	return openssl_decrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_KEY);
}


function fetchRegister($pdo, $limit, $offset)
{
	$sql = "SELECT * FROM registration_tbl LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

//for pagination in the pending residents table
function fetchTotalPending($pdo)
{
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
function fetchTotalResidents($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users";
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
	$sql = "SELECT * FROM resident_users WHERE 1=1";
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
		$sql .= " AND is_active = :accountStatus";
		$params[':accountStatus'] = ($accountStatus == 'Active') ? 1 : 0;
	}

	$sql .= " ORDER BY is_active DESC, res_id ASC LIMIT :limit OFFSET :offset";
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
	$sql = "SELECT COUNT(*) FROM resident_users WHERE 1=1";
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
		$sql .= " AND is_active = :accountStatus";
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
	$sql = "SELECT * FROM resident_users WHERE 
				res_ID = ? OR 
				res_fname LIKE ? OR 
				res_lname LIKE ? OR 
				CONCAT(res_fname, ' ', res_lname) LIKE ?";
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
            bs.staff_email, 
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
            WHERE 1=1";

    $params = [];

    if ($caseType !== null && $caseType !== '') {
        if ($caseType === 'Other') {
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
        $params = array_merge($params, array_fill(0, 6, "%$searchTerm%"));
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
	$sql = "SELECT COUNT(*) FROM resident_users WHERE gender = 'Male'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchTotalFemales($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE gender = 'Female'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchPendingAccounts($pdo)
{
	$sql = "SELECT COUNT(*) FROM registration_tbl";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchRegisteredVoters($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE registered_voter = 'Registered'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchNonRegisteredVoters($pdo)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE registered_voter != 'Registered'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchColumn();
}

function fetchUsersBySitio($pdo, $sitio)
{
	$sql = "SELECT COUNT(*) FROM resident_users WHERE addr_sitio = :sitio";
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

function accountRole($pdo)
{
	$sql = "SELECT userRole_id, role_definition FROM account_role WHERE userRole_id != 2";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



//----------------------------------------------admin manage document request
function fetchdocsRequest($pdo,$doctype ,$status, $limit, $offset)
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
			WHERE dt.doc_name = :doctype AND stat = :status
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt-> bindParam(':doctype', $doctype, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}
function fetchdocsRequestSearch($pdo,$doctype ,$status, $limit, $offset,$search)
{
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

function fetchdocsRequestIndigency($pdo, $status, $limit, $offset)
{
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
			WHERE dt.doc_name = 'Barangay Indigency' AND stat = :status
			LIMIT :limit OFFSET :offset";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':status', $status, PDO::PARAM_STR);
	$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
}

function fetchdocsRequestRemarks($pdo, $status, $remarks, $limit, $offset)
{
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

function fetchResidentDetails($pdo, $residentId)
{
    $sql = "SELECT * FROM resident_users WHERE res_ID = :residentId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':residentId', $residentId, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetchChartData($pdo)
{
    $sql = "SELECT isp.sitio_name, isp.total_initial_residents, COUNT(ru.res_ID) as registered_residents
            FROM initial_sitio_population isp
            LEFT JOIN resident_users ru ON isp.sitio_name = ru.addr_sitio
            GROUP BY isp.sitio_name, isp.total_initial_residents
            ORDER BY isp.sitio_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}