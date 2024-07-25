<?php
include '../../db/DBconn.php'; // This includes the database connection

header('Content-Type: application/json'); // Set the header to return JSON

$response = ['status' => 'UNKNOWN'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['complaint_id'])) {
        $complaint_id = $data['complaint_id'];

        try {
            // Use the existing database connection
            global $pdo;

            // Prepare the SQL query to fetch the complaint status
            $sql = "SELECT remarks FROM complaints_tbl WHERE complaint_id = :complaint_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':complaint_id', $complaint_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $response['status'] = $result['remarks'];
            } else {
                $response['status'] = 'NOT FOUND';
            }
        } catch (PDOException $e) {
            $response['status'] = 'ERROR';
            error_log("Error in check_case_status.php: " . $e->getMessage());
        }
    }
}

echo json_encode($response);
exit;
?>
