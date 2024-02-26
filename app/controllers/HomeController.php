<?php
// app/controllers/HomeController.php
namespace App\Controllers;
use App\Controllers\Controller;

class HomeController extends Controller {
    public function index() {
        define('BASE_DIR', __DIR__);
        // Correct the include path for config.php
        $configFilePath = BASE_DIR . '/../config.php';
        if (!file_exists($configFilePath)) {
            die('config.php not found');
        }
        
        $labels = include $configFilePath;
        
        // Get client's IP address from X-Forwarded-For header
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Fall back to REMOTE_ADDR if X-Forwarded-For is not present
            $clientIP = $_SERVER['REMOTE_ADDR'];
        }

        //
        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/home.php';
        include BASE_DIR . '/../templates/layout.php';        
    }
}
?>
