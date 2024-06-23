<?php
// Archivo: app/models/cnx-db-aux for Warehouse module

define('BASE_DIR', __DIR__);
//echo 'BASE_DIR is: ' . BASE_DIR . '<br>';

// old assignation
// $envPath = '../../.env';

// New assignation
$envPath = BASE_DIR . '/../.env';

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        putenv($line);
    }
} else {
    echo ".env file not found. <br>";
}

try {
    $dbHost = getenv('DB_HOST');
    $dbPort = getenv('DB_PORT');
    $dbName = getenv('DB_DATABASE');
    $dbUsername = getenv('DB_USERNAME');
    $dbPassword = getenv('DB_PASSWORD');
    $options = array(
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    $pdo = new \PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUsername, $dbPassword, $options);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    // Definir $pdo como global
    $GLOBALS['pdo'] = $pdo;
} catch (\PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>
