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

<form class="row g-3" action="/services/admin-query-reports.php" method="POST" enctype="application/x-www-form-urlencoded" >
    <!-- Objects predeterminated -->
    <!-- Radio buttons to filter report -->
    <div class="col-md-6" id="radioPersonel0">
        <label for="radioPersonel0" class="form-label">Personel*</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="ALL" checked>
            <label class="form-check-label" for="inlineRadio1">All</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="CREW">
            <label class="form-check-label" for="inlineRadio2">Crew</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="VISITOR">
            <label class="form-check-label" for="inlineRadio3">Visitor</label>
        </div>
    </div>


    <div class="col-md-6" id="inputDateFrom0">
        <label for="inputDateFrom" class="form-label">Date from*</label>
        <input type="date" class="form-control" id="inputDateFrom" name="inputDateFrom" value="<?php echo date('Y-m-d'); ?>" >
    </div>

    <div class="col-md-6" id="inputDateTo0">
        <label for="inputDateTo" class="form-label">Date to*</label>
        <input type="date" class="form-control" id="inputDateTo" name="inputDateTo" value="<?php echo date('Y-m-d'); ?>" >
    </div>

    <div class="col-md-6" id="selectTrainingCenter0">
        <label for="selectTC" class="form-label">Training Center:</label>
        <select class="form-select" id="selectTC" name="selectTC" >
            <option value=""> Select Training Center </option>
            <?php
                // Assuming $jsonData is your JSON data loaded from the model
                foreach ($filterTC as $item) {
                    echo '<option value="' . $item['s_location'] . '">' . $item['s_location'] . '</option>';
                }
            ?>
        </select>
    </div>


    <div class="col-12">
        <button type="submit" class="btn btn-primary">View results</button>
    </div>
</form>

</div>
<?php } else { ?>
    <div class="container-sm">
        <?php echo "This is the list of the Results "?> <a href="index.php?url=AdminReports/showPage&var=start&slowa=G1T6TQraLpx!"> <i class="fa-solid fa-arrow-rotate-left"></i> </a>
    </div>
    <div class="container-sm">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Name and surname</th>
                    <th scope="col">Role</th>
                    <th scope="col">Entry</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Training Center</th>
                    <th scope="col">Device</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach (json_decode($_GET['p_data'],true) as $event): ?>

                    <tr>
                    <th scope="row"> <?php echo $event['ID']; ?> </th>
                    <td> <?php echo $event['Date']; ?> </td>
                    <td> <?php echo $event['NameSurname']; ?> </td>
                    <td> <?php echo $event['Role']; ?> </td>
                    <td> <?php echo $event['Entry']; ?> </td>
                    <td> <?php echo $event['Customer']; ?> </td>
                    <td> <?php echo $event['TrainingCenter']; ?> </td>
                    <td> <?php echo $event['Device']; ?> </td>
                    <th>
                        <a href="services/update-visitor-checkin.php?p_id=<?php echo $event['ID']; ?>"> <i class="fa-solid fa-minus"></i> </a> 
                    </th>
                    </tr>
                    
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
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
