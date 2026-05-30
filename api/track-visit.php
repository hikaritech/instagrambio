<?php

require '../config.php';

$stmt = $pdo->prepare("
    INSERT INTO visitor_traffic
    (visit_timestamp)
    VALUES (NOW())
");

$stmt->execute();

echo json_encode([
    "success" => true
]);