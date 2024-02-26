<div class="container text-center">
    <p>Client's IP Address: <?php echo $clientIP; ?></p>
    <p>Message from Signin Form Controller: <?php echo $msg ?> and today is: <?php echo $whatDateIsToday ?> </p>

    <?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = 'Please complete the form!';
    } elseif ($var === 'error') {
        $toastMessage = 'Warning';
    }
    ?>

    <!-- Add your background image styling here -->
    <div class="container">
        <p class="lead">Your content goes here...</p>
        <h2>Form Page</h2>

        <form action="#" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($param1) ?>" required>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="role1">Role 1</option>
                <option value="role2">Role 2</option>
                <!-- Add more options as needed -->
            </select>

            <label for="citizenship">Citizenship:</label>
            <select id="citizenship" name="citizenship">
                <option value="citizen0">Select citizenship</option>

                <?php
                    // Assuming $jsonData is your JSON data loaded from the model
                    foreach ($jsonData as $item) {
                        echo '<option value="' . $item['Code'] . '">' . $item['Country'] . '</option>';
                    }
                ?>
            </select>

            <input type="submit" value="Submit">
        </form>
        <?php        
            echo "List of country: ";
            echo $jsonData;
        ?>

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
