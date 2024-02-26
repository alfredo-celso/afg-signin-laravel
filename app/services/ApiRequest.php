<?php

namespace App\Services;

class ApiRequest {
    
    public static function fetchData($dateStart, $dateEnd, $locationId) {
        // TODO: Validate and sanitize input parameters

        $request = new HTTP_Request();
        $request->setUrl('https://flex.afgsim.com/wapi/v02/events.cfm');
        $request->setMethod(HTTP_Request::METHOD_POST);
        $request->setConfig(array(
            'follow_redirects' => TRUE
        ));
        $request->setHeader(array(
            'access_token' => 'Mm64SqNjpAXbFvy3aTrhGK9dJW7QZwnUfksg85',
            'date_range_start' => $dateStart,
            'date_range_end' => $dateEnd,
            'device_location_id' => $locationId,
            // Other headers...
        ));

        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                return $response->getBody();
            } else {
                return 'Unexpected HTTP status: ' . $response->getStatus() . ' ' . $response->getReasonPhrase();
            }
        } catch (HTTP_Request2_Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

// Old code

// Output the include path
// echo 'GET_INCLUDE_PATH ? ' . get_include_path();
// set_include_path(get_include_path() . PATH_SEPARATOR . '/opt/lampp/lib/php' . PATH_SEPARATOR . '/usr/share/php');

// Include the Net_URL2 and HTTP_Request2 libraries
// require_once 'HTTP/Request2.php';
// require_once 'PEAR/HTTP/Request2.php';
// require_once '/usr/share/php/HTTP/Request2.php';

?>

