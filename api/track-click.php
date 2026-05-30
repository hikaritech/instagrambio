<?php

require '../config.php';

$input = json_decode(file_get_contents("php://input"), true);

$productId = intval($input['product_id'] ?? 0);

$stmt = $pdo->prepare("
    INSERT INTO product_clicks
    (product_id, click_timestamp)
    VALUES (?, NOW())
");

$stmt->execute([$productId]);

echo json_encode([
    "success" => true
]);