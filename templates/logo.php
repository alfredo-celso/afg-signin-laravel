<?php
    /**
     * Simple load logo by IP
     */

    // IP's country
    require_once BASE_DIR . '/../app/models/country-ip.php';

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
            $matchingRow = $row;
            break; // Stop iterating once a match is found
        }
    }

    // Output the matching row
    if ($matchingRow !== null) {
        //print_r($matchingRow);
    } else {
        $matchingRow = ["s_ip"=>$customerIP, "s_training_center"=>"00", "s_location"=>"N/A", "s_lang"=>"EN", "s_flag"=>"https://flagsapi.com/US/shiny/64.png", "s_logo"=>"/assets/img/iKarus.png"];
    }

    $jsonEncodeArray = urlencode(json_encode($matchingRow)); 
?>

<img src="<?php echo $matchingRow['s_logo'] ?>" alt="Your Logo" height="75" class="d-inline-block align-middle">
