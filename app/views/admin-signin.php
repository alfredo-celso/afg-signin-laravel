<?php 
    if ($_GET['var']==='start') {
        switch($_GET['var']){
            case "start":
                $toastMessage = $labels['report_start'];
                $toastClass = 'toast bg-info text-white fade show';
                break;
            case "results":
                $toastMessage = $labels['report_result'];
                $toastClass = 'toast bg-success text-white fade show';
                break;
            case "error":
                $toastMessage = $labels['report_error'];
                $toastClass = 'toast bg-danger text-white fade show';
                break;
            default:
            $toastMessage = $labels['report_start'];
            $toastClass = 'toast bg-info text-white fade show';
        }

?>;
<!-- Display form for GET method -->

<div class="container">
<div class="container text-center">
    <img src="<?php echo $matchingRow['s_flag'] ?>">
</div>

<form action="/index.php?url=AdminSignin/showPage&var=sessions&slowa=G1T6TQraLpx!" method="POST" enctype="application/x-www-form-urlencoded" >
    <!-- Objects predeterminated -->

    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputDateFrom" class="form-label">Sessions from*</label>
        <input type="date" class="form-control" id="inputDateFrom" name="inputDateFrom" value="<?php echo date('Y-m-d'); ?>" >
        </div>
    </div>
    
    <div class="form-group col-md-6">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>

</form>

</div>

<?php } else { ?>

    <?php $jsonEncodeArray = urlencode(json_encode($matchingRow)); ?>
    <?php
    // Group events by device_code
    $groupedData = [];
    foreach ($filteredDataWithHour as $event) {
        $deviceCode = $event['device_code'];
        if (!isset($groupedData[$deviceCode])) {
            $groupedData[$deviceCode] = [];
        }
        $groupedData[$deviceCode][] = $event;
    }
    ?>

    <div class="container text-center">
        <img src="<?php echo $matchingRow['s_flag'] ?>">
        <br> NOTE: For singular Signin record, another tab is going to be open and this result will remain open.
    <hr> <!-- Add a line separator between rows -->
    <?php
        if (count($filteredDataWithHour) === 0){
            echo "<h3 style='background-color:red; color:white;'> NO SESSIONS </h3>";
            $toastMessage = $labels['sessions_cero'];    
        }
    ?>
    <?php foreach ($groupedData as $deviceCode => $events): ?>
        <div>
            <h3>SIM:<?php echo $deviceCode; ?></h3>
        </div>

            <div class="row row-cols-1 row-cols-md-4 g-4">

            <?php foreach ($events as $event): ?>
                <div class="col">
                    <div class="card border-primary mb-3" style="max-width: 18rem;" >
                        <!-- Replace '...' with the actual image source -->
                        <h4 class="card-title" style="color:red;"><?php echo date('H:i', strtotime($event['event_date_start'])); ?></h4>
                        <div class="card-body">
                            <h5 class="card-text"><?php echo $event['customer_name']; ?></h5>
                            <p class="card-text"><?php echo date('Y-m-d', strtotime($event['event_date_start'])); ?></p>
                        </div>
                        <div class="card-footer">
                            <!-- Replace 'index.php?url=...' with the actual link -->
                            <a target="_blank" href="index.php?url=SigninForm/showPage&var=start&p_date=<?php echo $event['event_date_start']; ?>&p_tc=<?php echo $matchingRow['s_location']; ?>&p_customer=<?php echo $event['customer_name']; ?>&p_device=<?php echo $event['device_code']; ?>&p_data=<?php echo $jsonEncodeArray; ?>" class="btn btn-primary btn-lg mx-2">Signin</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr> <!-- Add a line separator between rows -->
    <?php endforeach; ?>
    
    </div>

<?php } ?>

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
