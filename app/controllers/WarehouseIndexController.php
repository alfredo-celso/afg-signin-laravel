<?php
// admin/controllers/WarehouseIndexController.php
namespace App\Controllers;
use App\Controllers\Controller;

class WarehouseIndexController extends Controller {
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
        //$deviceLocationId = '11';



       // Include the file where your database connection is established
       require_once BASE_DIR . '/../app/models/cnx-db-aux.php';


        $sql = "select * from view_warehouse_short";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Fetch the results into an associative array
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $numRows = count($results);

        if ($numRows === 0) {
            echo "<div style='background-color: yellow; color: black;'><i class='fa-solid fa-triangle-exclamation'></i> WARNING: No records match with TC </div>";
        } else {
            session_start();

            // Store the data in a session variable
            $_SESSION['p_data'] = $results;

        }

        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/warehouse-index.php';
        include BASE_DIR . '/../templates/layout.php';        

    }


    private function handleGet() {
        // Perform actions for the GET method (NO DATA RESULTS)
        $var = isset($_GET['var']) ? $_GET['var'] : 'start';

        if($_GET['var']==='start'){
        }

        if($_GET['var']==='error'){
            echo "<div style='background-color: red; color: white;'><i class='fa-solid fa-bug'></i> WARNING: upps... Something happen </div>";            
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
