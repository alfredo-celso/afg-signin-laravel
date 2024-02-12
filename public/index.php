<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_DIR', __DIR__);
require_once BASE_DIR . '/../app/controllers/HomeController.php';
include_once BASE_DIR . '/../config.php';

$controller = new HomeController();
$controller->index();
?>
