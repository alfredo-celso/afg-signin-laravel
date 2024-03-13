<?php

// app/controllers/VisitorCheckinController.php
namespace App\Controllers;

define('BASE_DIR', __DIR__);

require_once BASE_DIR . '/../app/models/2alpha-country-code.php';
require_once BASE_DIR . '/../app/models/country-ip.php';

class VisitorCheckinController extends Controller {
    public function showPage() {
        // Get today's date
        $whatDateIsToday = date('Y-m-d H:i');

        // Correct the include path for config.php
        $configFilePath = BASE_DIR . '/../config.php';
        if (!file_exists($configFilePath)) {
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-triangle-exclamation'></i> ERROR: config.php file doest not exist or not found. </div>";
        }
        
        $labels = include $configFilePath;

        // Get customer's IP address from X-Forwarded-For header
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $customerIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Fall back to REMOTE_ADDR if X-Forwarded-For is not present
            $customerIP = $_SERVER['REMOTE_ADDR'];
        }

        // $countryIPFilePath pointing to your JSON file
        $countryIPFilePath = BASE_DIR . '/../app/models/country_ip.json';
        // Create an instance of the model Country List
        $countryIP = new \CountryIP();
        // Load JSON data
        $jsonDataCountryIP = $countryIP->loadJsonData($countryIPFilePath);
        
        //$dataIP = json_decode($jsonDataCountryIP, true);

        $matchingRow = null;

        foreach ($jsonDataCountryIP as $row) {
            if ($row['s_ip'] === $customerIP) {
                echo "<div style='background-color: green; color: white;'><i class='fa-solid fa-circle-check'></i> INFO: Matching row found with the IP: " . $customerIP . "</div>";
                $matchingRow = $row;
                break; // Stop iterating once a match is found
            }
        }

        // Output the matching row
        if ($matchingRow !== null) {
            // print_r($matchingRow);
        } else {
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: No matching row found with the IP: " . $customerIP . " <br> Please inform to AFG staff of this case. </div>";
            $matchingRow = ["s_ip"=>$customerIP, "s_training_center"=>"00", "s_location"=>"N/A", "s_lang"=>"EN", "s_flag"=>"https://flagsapi.com/US/shiny/64.png"];
        }

        // $countryListFilePath pointing to JSON file
        $countryListFilePath = BASE_DIR . '/../app/models/2alpha_country_code.json';

        // Create an instance of the model Country List
        $countryList = new \CountryList();
        // Load JSON data
        $jsonDataCountryList = $countryList->loadJsonData($countryListFilePath);
       

        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/visitor-checkin.php';
        include BASE_DIR . '/../templates/layout.php';        
    }
}
?>
