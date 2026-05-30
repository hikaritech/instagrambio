<?php

$host = "localhost";
$port = 3066;
$dbname = "aqunymcp_instagrambio";
$username = "aqunymcp_dev";
$password = "+uKymbD[4GONIObz";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch(PDOException $e) {
    die(json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]));
}