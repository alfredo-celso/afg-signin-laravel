<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

define('BASE_DIR', __DIR__);

// Old require_once wich is better than autoloader code
require_once BASE_DIR . '/../app/controllers/Controller.php';
require_once BASE_DIR . '/../app/controllers/HomeController.php';
require_once BASE_DIR . '/../app/controllers/TCSessionsController.php';
require_once BASE_DIR . '/../app/controllers/SigninFormController.php';
require_once BASE_DIR . '/../app/controllers/VisitorCheckinController.php';
require_once BASE_DIR . '/../app/controllers/VisitorCheckoutController.php';
require_once BASE_DIR . '/../app/controllers/LoginController.php';
require_once BASE_DIR . '/../app/controllers/AdminReportsController.php';
require_once BASE_DIR . '/../app/controllers/AdminSigninController.php';
require_once BASE_DIR . '/../app/controllers/WarehouseIndexController.php';
require_once BASE_DIR . '/../app/controllers/WarehouseCheckinController.php';
require_once BASE_DIR . '/../app/controllers/FilterTCSessionsController.php';

require_once BASE_DIR . '/../utilities/Router.php';

// Operations
use App\Controllers\Controller;
use App\Controllers\HomeController;
use App\Controllers\TCSessionsController;
use App\Controllers\SigninFormController;
use App\Controllers\VisitorCheckinController;
use App\Controllers\VisitorCheckoutController;
use App\Controllers\FilterTCSessionsController;
// Administration
use App\Controllers\LoginController;
use App\Controllers\AdminReportsController;
use App\Controllers\AdminSigninController;
//Warehouse
use App\Controllers\WarehouseIndexController;
use App\Controllers\WarehouseCheckinController;

use App\Utilities\Router;


$url = isset($_GET['url']) ? $_GET['url'] : '';
$route = Router::parseUrl($url);

$controllerName = $route['controller'];
$action = $route['action'];

$controllerClass = "App\\Controllers\\$controllerName";
$controller = new $controllerClass();

// Make sure the action method exists in the controller
if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Action not found!";
}

// Autoloading PSR-4 standard for namespace-to-directory mapping.
//spl_autoload_register(function ($class) {
//    $classPath = str_replace('\\', '/', $class);
//    $file = BASE_DIR . '/../' . $classPath . '.php';

//    if (file_exists($file)) {
//        require_once $file;
//    } else {
//        error_log("File not found: $file");
//    }
//});