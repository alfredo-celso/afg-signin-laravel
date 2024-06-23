
<?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = $labels['warehouse_index_start'];
        $toastClass = 'toast bg-info text-white fade show';
    } elseif ($var === 'success') {
        $toastMessage = $labels['warehouse_index_success'];
        $toastClass = 'toast bg-success text-white fade show';
    }
?>

<!-- Display form for GET method -->
<?php 
// Start the session to access session data
    session_start();

    // Retrieve the data from the session
    $results = $_SESSION['p_data'];

    // Remove the data from the session if it's no longer needed
    unset($_SESSION['p_data']);        
?>

<div class="container text-center">

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

</div>

<div class="container-sm">
    <?php echo "Warehouse inventory &nbsp; &nbsp; "?> <a href="index.php?url=WarehouseCheckin/showPage&var=start&slowa=G1T6TQraLpx!"> <i class="fa-solid fa-cart-plus"></i> Add </a>
</div>
<div class="container-sm">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Description</th>
                <th scope="col">Qty</th>
                <th scope="col">Location</th>
                <th scope="col">Device</th>
                <th scope="col">Check-in</th>
                <th scope="col">Category</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                
            <?php foreach ($results as $event): ?>

                <tr>
                <th scope="row"> <?php echo $event['ID']; ?> </th>
                <td> <?php echo $event['Description']; ?> </td>
                <td> <?php echo $event['Qty']; ?> </td>
                <td> <?php echo $event['Location']; ?> </td>
                <td> <?php echo $event['Device']; ?> </td>
                <td> <?php echo $event['CheckIn']; ?> </td>
                <td> <?php echo $event['Category']; ?> </td>
                <th>
                    &nbsp; | <a href="services/delete-crew.php?p_id=<?php echo $event['ID']; ?>"> <i class="fa-solid fa-ghost"></i> Inactive </a> 
                    &nbsp; | <a href="services/delete-crew.php?p_id=<?php echo $event['ID']; ?>"> <i class="fa-solid fa-check"></i> Transfer </a>
                    &nbsp; | <a href="services/delete-crew.php?p_id=<?php echo $event['ID']; ?>"> <i class="fa-solid fa-list"></i> Details </a> 
                </th>
                </tr>
                
            <?php endforeach; ?>

            </tbody>
        </table>
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
