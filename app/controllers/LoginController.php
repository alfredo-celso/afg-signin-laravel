<?php
// admin/controllers/LoginController.php
namespace App\Controllers;
use App\Controllers\Controller;

class LoginController extends Controller {
    public function showPage() {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Handle GET request
            $this->handleGet();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request
            $this->handlePost();
        }


        define('BASE_DIR', __DIR__);
        // Correct the include path for config.php
        $configFilePath = BASE_DIR . '/../config.php';
        if (!file_exists($configFilePath)) {
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-triangle-exclamation'></i> ERROR: config.php file doest not exist or not found. </div>";
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
        $content = BASE_DIR . '/../app/views/login.php';
        include BASE_DIR . '/../templates/layout.php';        
    }

    private function handleGet() {
        // Perform actions for the GET method (NO DATA RESULTS)
        $var = isset($_GET['var']) ? $_GET['var'] : 'start';

        if($_GET['var']==='start'){
        }

        if($_GET['var']==='loginchecked'){
            
        }
        //echo "<div style='background-color: orange; color: black;'><i class='fa-solid fa-bug'></i> GET: Method GET launched! </div>";
    
    }

    private function handlePost() {
        // Perform actions for the POST method (e.g., process form submission)
        $var = isset($_POST['var']) ? $_POST['var'] : 'check';
        $username = isset($_POST['inputUser']) ? $_POST['inputUser'] : '';
        $password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : '';

        if ($username == 'admin' && $password == 'afgsim') {
            // Redirect to login page on successful login
            header("Location: /index.php?url=Login/showPage&var=start&slowa=G1T6TQraLpx!");
            exit();
            } else {
            // Display login page with error message
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: user or password does not match! </div>";
        }


    }

}
?>
