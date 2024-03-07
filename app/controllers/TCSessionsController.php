<?php

// app/controllers/TCSessionsController.php
namespace App\Controllers;

class TCSessionsController extends Controller {
    public function showPage() {
        define('BASE_DIR', __DIR__);
        // Correct the include path for config.php
        $configFilePath = BASE_DIR . '/../config.php';
        if (!file_exists($configFilePath)) {
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-triangle-exclamation'></i> ERROR: config.php file doest not exist or not found. </div>";
        }
        
        // labels
        $labels = include $configFilePath;
        // IP's country
        require_once BASE_DIR . '/../app/models/country-ip.php';

        // Get today's date
        $whatDateIsToday = date('Y-m-d');

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
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: No matching row found with the IP: " . $customerIP . " <br> Please notify to AFG staff of this notification. </div>";
        }


        // 11 is Spain, assumed as a default for testing purpose
        $deviceLocationId = $matchingRow['s_training_center'];
        //$deviceLocationId = '11';
        
        // Init curl library
        $curl = curl_init();

        // Build the URL with dynamic parameters
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://flex.afgsim.com/wapi/v02/events.cfm',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
              'access_token: Mm64SqNjpAXbFvy3aTrhGK9dJW7QZwnUfksg85',
              'date_range_start: ' . $whatDateIsToday,
              'date_range_end:' . $whatDateIsToday,
              'device_location_id: ' . $deviceLocationId,
              'Cookie: CFGLOBALS=urltoken%3DCFID%23%3D1877276%26CFTOKEN%23%3Dfc0f1a97c0f5b73e%2D76118BC9%2DFEE2%2DC60B%2D8255A1EB79C21C42%23lastvisit%3D%7Bts%20%272024%2D01%2D29%2023%3A40%3A52%27%7D%23hitcount%3D6%23timecreated%3D%7Bts%20%272024%2D01%2D29%2023%3A36%3A41%27%7D%23cftoken%3Dfc0f1a97c0f5b73e%2D76118BC9%2DFEE2%2DC60B%2D8255A1EB79C21C42%23cfid%3D1877276%23; CFID=2232476; CFTOKEN=837c4326c639f1dd-3E574580-DAE8-8B4B-AAA7DC2673B8F501; CK_OPEN_LEFT_BAR=1'
            ),
        ));

        $apiCurlResponse = curl_exec($curl);

        curl_close($curl);

        // Decode JSON data into an associative array
        $data = json_decode($apiCurlResponse, true);

        // Filter data by event_type_name = "Full Motion" NOTE: Modify code to return and empty array []
        $filteredData = array_filter($data['data']['events'], function($event) {
            return $event['event_type_name'] === 'Full Motion';
        });

        // Sort the filtered data by device_code and event_date_start
        usort($filteredData, function($a, $b) {
            // First, compare by device_code
            $deviceCodeComparison = strcmp($a['device_code'], $b['device_code']);

            // If device_code is the same, then compare by event_date_start
            if ($deviceCodeComparison === 0) {
                return strtotime($a['event_date_start']) - strtotime($b['event_date_start']);
            }

            return $deviceCodeComparison;
        });

        // Add an extra column for the hour of event_date_start to each event
        $filteredDataWithHour = array_map(function($event) {
            $event['event_hour_start'] = date('H', strtotime($event['event_date_start']));
            return $event;
        }, $filteredData);


        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/tc-sessions.php';
        include BASE_DIR . '/../templates/layout.php';        
    }
}
?>
