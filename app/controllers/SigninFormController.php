<?php

// app/controllers/SigninFormController.php
namespace App\Controllers;

define('BASE_DIR', __DIR__);

// require_once BASE_DIR . '/../app/models/2alpha-country-code.php';
require_once BASE_DIR . '/../app/models/country-ip.php';

class SigninFormController extends Controller {
    public function showPage() {
        // Get today's date
        $whatDateIsToday = date('Y-m-d');

        // Correct the include path for config.php
        $configFilePath = BASE_DIR . '/../config.php';
        if (!file_exists($configFilePath)) {
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-triangle-exclamation'></i> ERROR: config.php file doest not exist or not found. </div>";
        }
        
        $labels = include $configFilePath;

        $matchingRow = json_decode(urldecode($_GET['p_data']), true);

        // $countryListFilePath pointing to JSON file
        // $countryListFilePath = BASE_DIR . '/../app/models/2alpha_country_code.json';

        // Create an instance of the model Country List
        // $countryList = new \CountryList();

        // Load JSON data
        // $jsonDataCountryList = $countryList->loadJsonData($countryListFilePath);
       

        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/signin-form.php';
        include BASE_DIR . '/../templates/layout.php';        
    }
}
?>
