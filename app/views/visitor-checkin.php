<div class="container text-center">
    <img src="<?php echo $matchingRow['s_flag'] ?>">
</div>

<?php
    $p_date = $whatDateIsToday;
    $p_tc = $matchingRow['s_location'];
    $p_customer = 'GUEST';
    $p_device = $matchingRow['s_location'];

    $toastMessage = 'Check-in start. Please complete the data required!';
    $toastClass = 'toast bg-info text-white fade show';
?>
<div class="container-sm">
    <p style="color: red;">Please complete the Sign-in form (* All fields are mandatory) <input type="checkbox" id="viewObjects" name="viewObjects" onclick="viewObjects()";</p>

    <form class="row g-3" action="services/insert-signin-form.php" method="POST" enctype="application/x-www-form-urlencoded" >
        <!-- Objects predeterminated -->
        <div class="col-md-3" id="inputDate0">
            <label for="inputDate" class="form-label">Date*</label>
            <input type="text" class="form-control" id="inputDate" name="inputDate" value="<?php echo substr($p_date, 0, 10); ?>" readonly>
        </div>

        <div class="col-md-3" id="inputTrainingCenter0">
            <label for="inputTrainingCenter" class="form-label">Training center*</label>
            <input type="text" class="form-control" id="inputTrainingCenter" name="inputTrainingCenter" value="<?php echo $p_tc; ?>" readonly>
        </div>

        <div class="col-md-3" id="inputCustomer0">
            <label for="inputCustomer" class="form-label">Customer*</label>
            <input type="text" class="form-control" id="inputCustomer" name="inputCustomer" value="<?php echo $p_customer; ?>" readonly>
        </div>

        <div class="col-md-3" id="inputDevice0" >
            <label for="inputDevice" class="form-label">Device*</label>
            <input type="text" class="form-control" id="inputDevice" name="inputDevice" value="<?php echo $p_device; ?> -Facility " readonly>
        </div>

        <div class="col-md-3" id="inputIP0" >
            <label for="inputIP" class="form-label">IP*</label>
            <input type="text" class="form-control" id="inputIP" name="inputIP" value="<?php echo $matchingRow['s_ip']; ?>" readonly>
        </div>

        <div class="form-group">
            <input class="form-check-input" type="radio" name="trainingSession1" value="<?php echo substr($p_date, -5); ?>" id="trainingSession1" checked>
            <label class="form-check-label" for="trainingSession1">
                Session: <?php echo substr($p_date, -5); ?>
            </label>
        </div>

        
        <!-- Objects to be completed by user typing -->
        <div class="col-md-6">
            <label for="inputName" class="form-label">* Name and Surname</label>
            <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Type your name and surname..." required>
        </div>

        <div class="col-md-6">
        <label for="selectRole" class="form-label">* Role</label>
        <select class="form-select" id="selectRole" name="selectRole" >
            <option value="Visitor" selected>Visitor</option>
        </select>
        </div>
        <div class="col-md-6">
            <label for="selectCitizen" class="form-label">Citizenship:</label>
            <select class="form-select" id="selectCitizen" name="selectCitizen" >
                <option value=""> Select citizenship </option>
                <?php
                    // Assuming $jsonData is your JSON data loaded from the model
                    foreach ($jsonDataCountryList as $item) {
                        echo '<option value="' . $item['Code'] . '">' . $item['Country'] . '</option>';
                    }
                ?>
            </select>
        </div>

        <div class="col-md-6">
        <input class="form-check-input" type="checkbox" value="" id="safetyCheck" name="safetyCheck" required>
        <label class="form-check-label" for="safetyCheck">
            <bold style="color: rgb(255, 0, 0);">I declare that I am familiar with the FIRE SAFETY and SAFETY BRIEFING instructions provided by AFG.</bold>
        </label>
        </div>

        <div class="col-12">
        <button type="submit" class="btn btn-primary">Check in</button>
        </div>
    </form>
</div>

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


<script>
    window.onload = function() {
        document.getElementById("inputDate0").style.display = "none";
        document.getElementById("inputTrainingCenter0").style.display = "none";
        document.getElementById("inputCustomer0").style.display = "none";
        document.getElementById("inputDevice0").style.display = "none";
        document.getElementById("inputIP0").style.display = "none";

        document.getElementById("inputName").focus();

    };

    function viewObjects() {
        if (document.getElementById("inputDate0").style.display === "none") {
            document.getElementById("inputDate0").style.display = "block";
            document.getElementById("inputTrainingCenter0").style.display = "block";
            document.getElementById("inputCustomer0").style.display = "block";
            document.getElementById("inputDevice0").style.display = "block";
            document.getElementById("inputIP0").style.display = "block";
        } else {
            document.getElementById("inputDate0").style.display = "none";
            document.getElementById("inputTrainingCenter0").style.display = "none";
            document.getElementById("inputCustomer0").style.display = "none";
            document.getElementById("inputDevice0").style.display = "none";
            document.getElementById("inputIP0").style.display = "none";
        }

    };

    document.getElementById("selectRole").addEventListener("focusout", selectRole);

    function selectRole() {
        if (document.getElementById("selectRole").value == "Select role..."){
            document.getElementById("selectRole").focus();
        }
    }

    function closeModal(){
        $('#exampleModal').modal('hide')
    }

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
