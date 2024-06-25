<!-- index.php -->
<div class="container text-center">

    <?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = $labels['sessions_start'];
        $toastClass = 'toast bg-info text-white fade show';
    } elseif ($var === 'error') {
        $toastMessage = $labels['sessions_error'];
        $toastClass = 'toast bg-danger text-white fade show';
    }
    ?>

    <div class="container">

        <?php $jsonEncodeArray = urlencode(json_encode($matchingRow)); ?>
        <img src="<?php echo $matchingRow['s_flag'] ?>">

        <?php
        // Group events by device_code
        $groupedData = [];
        foreach ($filteredEvents as $event) {
            $deviceCode = $event['device_code'];
            if (!isset($groupedData[$deviceCode])) {
                $groupedData[$deviceCode] = [];
            }
            $groupedData[$deviceCode][] = $event;
        }
        ?>
        
        <hr> <!-- Add a line separator between rows -->
        <?php
            if (count($filteredEvents) === 0){
                echo "<h3 style='background-color:red; color:white;'> NO SESSIONS </h3>";
                $toastMessage = $labels['sessions_cero'];    
            } else {
        ?>        
            <ul class="nav"> <b> Filter SIM model: &nbsp; &nbsp; </b>  
                <?php foreach ($filtersOption as $filterOption): ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" href=" <?php echo $filterOption['filter_url'] ?> " role="button"> <?php echo $filterOption['device_type']; ?> </a> &nbsp; &nbsp;
                        <!-- <a class="nav-link active" aria-current="page" href="#"> <span class="badge text-bg-primary">  </span> </a> -->
                    </li>        
                <?php endforeach; ?>
            </ul>
            <br>
            <br>
        <?php
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
                            <h3 class="card-title" style="color:red;"><?php echo date('H:i', strtotime($event['event_date_start'])); ?></h3>
                            <div class="card-body">
                                <img src="/assets/img/sim-icon.fw.jpg" class="card-img-top" alt="Simulator" style="width: 75%; height: 125px; object-fit: cover;">
                                <h4 class="card-text"><?php echo $event['customer_name']; ?></h4>
                                <p class="card-text"><?php echo date('Y-m-d', strtotime($event['event_date_start'])) ." / <span class='badge text-bg-info'>". $event['device_type'] ."</span>" ; ?></p>
                            </div>
                            <div class="card-footer">
                                <!-- Replace 'index.php?url=...' with the actual link -->
                                <a href="index.php?url=SigninForm/showPage&var=start&p_date=<?php echo $event['event_date_start']; ?>&p_tc=<?php echo $matchingRow['s_location']; ?>&p_customer=<?php echo $event['customer_name']; ?>&p_device=<?php echo $event['device_code']; ?>&p_data=<?php echo $jsonEncodeArray; ?>" class="btn btn-primary btn-lg mx-2">Signin</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr> <!-- Add a line separator between rows -->
        <?php endforeach; ?>

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
