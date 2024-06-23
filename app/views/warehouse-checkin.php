<?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = $labels['warehouse-checkin-start'];
        $toastClass = 'toast bg-info text-white fade show';
    } elseif ($var === 'error') {
        $toastMessage = $labels['warehouse-checkin-error'];
        $toastClass = 'toast bg-danger text-white fade show';
    }
?>

<div class="container text-center">
    <img src="<?php echo $matchingRow['s_flag'] ?>">
</div>

<div class="container-sm">
    <p style="color: red;">Please complete the Sign-in form (* All fields are mandatory) </p>

    <form class="row g-3" action="services/insert-warehouse-checkin.php" method="POST" enctype="application/x-www-form-urlencoded" >        
        <!-- Objects to be completed by user typing -->
        <div class="col-md-6">
            <label for="inputDescription" class="form-label">* Description</label>
            <input type="text" class="form-control" id="inputDescription" name="inputDescription" placeholder="Type the description..." required>
        </div>

        <div class="col-md-6">
            <label for="inputPartNumber" class="form-label">* Part number</label>
            <input type="text" class="form-control" id="inputPartNumber" name="inputPartNumber" placeholder="Type the Part number..." required>
        </div>

        <div class="col-md-6">
            <label for="inputModel" class="form-label">* Model number</label>
            <input type="text" class="form-control" id="inputModel" name="inputModel" placeholder="Type the Model..." required>
        </div>

        <div class="col-md-6">
            <label for="inputBrand" class="form-label">* Brand</label>
            <input type="text" class="form-control" id="inputBrand" name="inputBrand" placeholder="Type the Brand..." required>
        </div>

        <div class="col-md-6">
            <label for="inputPrice" class="form-label">* Price USD</label>
            <input type="text" class="form-control" id="inputPrice" name="inputPrice" value="0.00" required>
        </div>

        <div class="col-md-6">
            <label for="inputQty" class="form-label">* Quantity</label>
            <input type="text" class="form-control" id="inputQty" name="inputQty" value="0" required>
        </div>

        <div class="col-md-6">
            <label for="inputTC" class="form-label">* Training center</label>
            <input type="text" class="form-control" id="inputTC" name="inputTC" value="<?php echo $matchingRow['s_training_center']; ?>" readonly>
        </div>

        <div class="col-md-6">
            <label for="inputRack" class="form-label">* Rack/Locker</label>
            <input type="text" class="form-control" id="inputRack" name="inputRack" placeholder="Type the Rack/Locker..." required>
        </div>

        <div class="col-md-6" id="selectDevice">
            <label for="selectDevice" class="form-label">Device:</label>
            <select class="form-select" id="selectDevice" name="selectDevice" >
                <option value="000"> Select Device </option>
                <?php
                    // Assuming $jsonData is your JSON data loaded from the model
                    foreach ($filterDevices as $item) {
                        echo '<option value="' . $item['Code'] . '">' . $item['Code'] . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="col-md-6">
        <label for="selectStatus" class="form-label">* Status</label>
        <select class="form-select" id="selectStatus" name="selectStatus" >
            <option value="Select status" selected>Select status...</option>
            <option value="New">Serviceable</option>
            <option value="Overhaul">Out of Service</option>
            <option value="Fixed">Repairable</option>
            <option value="Broken">Calibrated</option>
        </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">* Category:</label>
            <?php include 'SelectWarehouseCat.php'; ?>
        </div>


        <div class="col-12">
        <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>

    <?php
        // Display toast message based on the 'var' value
        if ($toastMessage) {
            echo '<div class="toast-container" style="position: absolute; top: 10px; right: 10px;" id="myToast">
                    <div class="'. $toastClass .' ">
                        <div class="toast-body">
                            '. $toastMessage .'
                        </div>
                    </div>
                </div>'; 
        }
    ?>

</div>

<script>
    function myToast(){
        //alert("Page is loaded");
        var element = document.getElementById("myToast");

        /* Create toast instance */
        var myToast = new bootstrap.Toast(element, {
            delay: 3000
        });
        myToast.show(1500);
    };

</script>
