<?php
require '../config.php';

$stmt = $pdo->query("
    SELECT product_id, click_timestamp
    FROM product_clicks
    ORDER BY click_timestamp DESC
");

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo json_encode([
    "success" => true,
    "data" => $rows
]);