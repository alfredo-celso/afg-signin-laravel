<?php
// admin/controllers/AdminReportsController.php
namespace App\Controllers;
use App\Controllers\Controller;

class AdminReportsController extends Controller {
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

        // Include the list of TC within the layout
        require_once BASE_DIR . '/../app/models/country-ip.php';
        $countryIPFilePath = BASE_DIR . '/../app/models/country_ip.json';
        // Create an instance of the model Country List
        $countryIP = new \CountryIP();
        // Load JSON data
        $jsonDataCountryIP = $countryIP->loadJsonData($countryIPFilePath);
        // Filter the data based on s_training_center different to '00'
        $filterTC = array_filter($jsonDataCountryIP, function($item) {
            return $item['s_training_center'] !== '00';
        });

        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/admin-reports.php';
        include BASE_DIR . '/../templates/layout.php';        
    }

    private function handleGet() {
        // Perform actions for the GET method (NO DATA RESULTS)
        $var = isset($_GET['var']) ? $_GET['var'] : 'start';

        if($_GET['var']==='start'){
        }

        if($_GET['var']==='norecords'){
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: No records match with the period and/or TC </div>";            
        }
        //echo "<div style='background-color: orange; color: black;'><i class='fa-solid fa-bug'></i> GET: Method GET launched! </div>";
    
    }

    private function handlePost() {
        // Perform actions for the POST method (e.g., process form submission)
        $var = isset($_POST['var']) ? $_POST['var'] : 'check';
        echo "<div style='background-color: blue; color: white;'><i class='fa-solid fa-bug'></i> WARNING: Reports result! </div>";

    }

}
?>
