<!-- index.php -->
<div class="container text-center">

    <?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = $labels['00_welcome_message'];
    } elseif ($var === 'error') {
        $toastMessage = $labels['signin_error'];
    } elseif ($var === 'signin') {
        $toastMessage = $labels['signin_success'];
    }
    ?>

    <!-- Add your background image styling here -->
    <div class="jumbotron home-banner">
        <!-- Centered buttons -->
        <div class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <a href="index.php?url=TCSessions/showPage&var=start" class="btn btn-primary btn-lg mx-2"> &nbsp &nbsp FFS &nbsp &nbsp </a>
            <a href="#" class="btn btn-secondary btn-lg mx-2">Visitor </a>
        </div>

        <?php
        // Display toast message based on the 'var' value
        if ($toastMessage) {
            echo '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-body">
                        ' . $toastMessage . '
                    </div>
                </div>';
        }
        ?>        
    </div>
</div>
