<?php
include '../../db/DBconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sitio = $_POST['sitio'];
    $population = $_POST['population'];

    $sql = "UPDATE initial_sitio_population SET total_initial_residents = :population WHERE sitio_name = :sitio";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':population' => $population,
        ':sitio' => $sitio
    ]);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}