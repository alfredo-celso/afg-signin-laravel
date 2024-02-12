<!-- index.php -->
<div class="container text-center">
    <h1>Mi casa es su casa</h1>
    <p>Client's IP Address: <?php echo $clientIP; ?></p>
    <p>Message from Home Controller: <?php echo $data ?> </p>

    <?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = 'Welcome';
    } elseif ($var === 'error') {
        $toastMessage = 'Warning';
    } elseif ($var === 'signin') {
        $toastMessage = 'Data store';
    }
    ?>

    <!-- Add your background image styling here -->
    <div class="jumbotron home-banner">
        <!-- Centered buttons -->
        <div class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <a href="#" class="btn btn-primary btn-lg mx-2"> &nbsp &nbsp FFS &nbsp &nbsp </a>
            <a href="#" class="btn btn-secondary btn-lg mx-2">Visitor </a>
        </div>

        <p class="lead">Your content goes here...</p>
        <?php
        // Display toast message based on the 'var' value
        if ($toastMessage) {
            echo '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                    <div class="toast-header">
                        <strong class="mr-auto">Toast Message</strong>
                        <small class="text-muted">Just now</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        ' . $toastMessage . '
                    </div>
                </div>';
        }
        ?>        
    </div>
</div>
