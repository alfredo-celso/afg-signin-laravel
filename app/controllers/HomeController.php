<?php
// app/controllers/HomeController.php

class HomeController {
    public function index() {
        // Logic to fetch data from the model if needed
        $data = "Hello from HomeController!";

        // Get client's IP address from X-Forwarded-For header
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Fall back to REMOTE_ADDR if X-Forwarded-For is not present
            $clientIP = $_SERVER['REMOTE_ADDR'];
        }
        $pageTitle = "Home Page";

        //
        // Include the specific view (home.php) within the layout
        $content = BASE_DIR . '/../app/views/home.php';
        include BASE_DIR . '/../templates/layout.php';        
    }
}
?>
