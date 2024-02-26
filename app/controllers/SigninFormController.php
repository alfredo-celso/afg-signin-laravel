<?php

// app/controllers/SigninFormController.php
namespace App\Controllers;

define('BASE_DIR', __DIR__);

require_once BASE_DIR . '/../app/models/2alpha-country-code.php';

class SigninFormController extends Controller {
    public function showPage() {
        // Get today's date
        $whatDateIsToday = date('Y-m-d');

        // Correct the include path for config.php
        $configFilePath = BASE_DIR . '/../config.php';
        if (!file_exists($configFilePath)) {
            die('config.php not found');
        }
        
        $labels = include $configFilePath;


        // Get TC's IP address
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Fall back to REMOTE_ADDR if X-Forwarded-For is not present
            $clientIP = $_SERVER['REMOTE_ADDR'];
        }

        // $filePath pointing to your JSON file
        $filePath = BASE_DIR . '/../app/models/2alpha_country_code.json';

        // Create an instance of the model
        $countryList = new \CountryList();

        // Load JSON data
        $jsonData = $countryList->loadJsonData($filePath);
       

        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/signin-form.php';
        include BASE_DIR . '/../templates/layout.php';        
    }
}
?>
