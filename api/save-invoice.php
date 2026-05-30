<?php
require '../config.php';

$input = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare("
    INSERT INTO invoices 
    (invoice_number, invoice_uuid, customer_name, customer_phone, customer_address, 
     items, subtotal, discount, tax, total, payment_status, payment_method, 
     payment_details, notes, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
");

$itemsJson = json_encode($input['items']);

$stmt->execute([
    $input['invoice_number'],
    $input['invoice_uuid'],
    $input['customer_name'],
    $input['customer_phone'],
    $input['customer_address'],
    $itemsJson,
    $input['subtotal'],
    $input['discount'],
    $input['tax'],
    $input['total'],
    $input['payment_status'],
    $input['payment_method'],
    $input['payment_details'],
    $input['notes']
]);

echo json_encode([
    "success" => true,
    "id" => $pdo->lastInsertId()
]);