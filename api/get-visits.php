<?php
require '../config.php';

$start = $_GET['start'] ?? date('Y-m-d', strtotime('-7 days'));
$end = $_GET['end'] ?? date('Y-m-d');

$stmt = $pdo->prepare("
    SELECT visit_timestamp
    FROM visitor_traffic
    WHERE DATE(visit_timestamp) BETWEEN ? AND ?
    ORDER BY visit_timestamp ASC
");

$stmt->execute([$start, $end]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo json_encode([
    "success" => true,
    "data" => $rows
]);