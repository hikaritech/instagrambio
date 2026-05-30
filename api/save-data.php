<?php
require '../config.php';

$input = json_decode(file_get_contents("php://input"), true);
$data = json_encode($input['data']);

$stmt = $pdo->prepare("
    INSERT INTO store_data (data, created_at, updated_at)
    VALUES (?, NOW(), NOW())
");

$stmt->execute([$data]);

echo json_encode([
    "success" => true
]);