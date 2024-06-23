<?php
// admin/controllers/WarehouseCheckinController.php
namespace App\Controllers;
use App\Controllers\Controller;

class WarehouseCheckinController extends Controller {
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
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: No matching row found with the IP: " . $customerIP . " <br> Please inform to AFG staff of this case. </div>";
            $matchingRow = ["s_ip"=>$customerIP, "s_training_center"=>"00", "s_location"=>"N/A", "s_lang"=>"EN", "s_flag"=>"https://flagsapi.com/US/shiny/64.png"];
        }

        // 11 is MADRID, assumed as a default and uncomment fix value for testing purpose
        $deviceLocationId = $matchingRow['s_training_center'];
        //$deviceLocation = $matchingRow['s_location'];
        //$deviceLocationId = '11';
        $deviceLocation = "WAW";

        // Include the list of Devices within the layout
        require_once BASE_DIR . '/../app/models/devices.php';
        $devicesFilePath = BASE_DIR . '/../app/models/devices.json';
        // Create an instance of the model Devices List
        $devicesList = new \DevicesList();
        // Load JSON data
        $jsonDataDevices = $devicesList->loadJsonData($devicesFilePath);

        // Filter the data based on s_training_center different to '00'
        $filterDevices = array_filter($jsonDataDevices, function($item) use ($deviceLocation) {
            return $item['Location'] == $deviceLocation;
        });

        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/warehouse-checkin.php';
        include BASE_DIR . '/../templates/layout.php';        

    }


    private function handleGet() {
        // Perform actions for the GET method (NO DATA RESULTS)
        $var = isset($_GET['var']) ? $_GET['var'] : 'start';

        if($_GET['var']==='start'){
        }

        if($_GET['var']==='norecords'){
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: No records match with TC </div>";            
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
