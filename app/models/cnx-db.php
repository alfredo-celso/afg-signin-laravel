<?php

$envPath = '../../.env';

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        putenv($line);
    }
} else {
    echo ".env file not found. <br>";
}

$dbHost = getenv('DB_HOST');
$dbPort = getenv('DB_PORT');
$dbName = getenv('DB_DATABASE');
$dbUsername = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUsername, $dbPassword);
    // Additional configuration or actions with the $pdo object if needed
    echo "Connected to the database successfully. <br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
