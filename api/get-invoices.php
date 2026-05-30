<?php
require '../config.php';

$start = $_GET['start'] ?? null;
$end = $_GET['end'] ?? null;

if ($start && $end) {
    $stmt = $pdo->prepare("
        SELECT * FROM invoices
        WHERE DATE(created_at) BETWEEN ? AND ?
        ORDER BY created_at DESC
    ");
    $stmt->execute([$start, $end]);
} else {
    $stmt = $pdo->query("
        SELECT * FROM invoices
        ORDER BY created_at DESC
    ");
}

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Parse items JSON for each invoice
foreach ($rows as &$row) {
    $row['items'] = json_decode($row['items'], true);
}

header('Content-Type: application/json');

echo json_encode([
    "success" => true,
    "data" => $rows
]);