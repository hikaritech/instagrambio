<?php

require '../config.php';

$stmt = $pdo->query("
    SELECT data
    FROM store_data
    ORDER BY updated_at DESC
    LIMIT 1
");

$row = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

echo $row
    ? $row['data']
    : '{}';