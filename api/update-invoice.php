<?php
require '../config.php';

$input = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
    UPDATE invoices
    SET payment_status = ?
    WHERE id = ?
");

$stmt->execute([$input['payment_status'], $input['id']]);

echo json_encode([
    "success" => true
]);