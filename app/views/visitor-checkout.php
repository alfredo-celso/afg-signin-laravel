<div class="container text-center">
    <img src="<?php echo $matchingRow['s_flag'] ?>">
</div>

<?php 
    if ($_GET['var']!='results') {
        switch($_GET['var']){
            case "noresults":
                $toastMessage = $labels['checkout_error'];
                $toastClass = 'toast bg-danger text-white fade show';
                break;
            case "error":
                $toastMessage = $labels['checkout_error'];
                $toastClass = 'toast bg-danger text-white fade show';
                break;
            default:
                $toastMessage = $labels['sessions_start'];
                $toastClass = 'toast bg-info text-white fade show';
        }

?>;
<!-- Display form for GET method -->

<div class="container-sm">
    <p style="color: red;">Please complete the Check-out form.</p>

    <form class="row g-3" action="services/query-visitor-checkin.php" method="POST" enctype="application/x-www-form-urlencoded" >
        <div class="col-md-3">
            <label for="inputName" class="form-label">* Type partially the Name or Surname</label>
            <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Name or surname..." required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>

    </form>
</div>
<?php } else { ?>
    <!-- Display table for results -->
    <div class="container-sm">
        <?php echo "Results for ". $_GET['p_visitor'] .":"?> <a href="index.php?url=VisitorCheckout/showPage&var=start"> <i class="fa-solid fa-arrow-rotate-left"></i> </a>
    </div>
    <div class="container-sm">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name and surname</th>
                    <th scope="col">Check-In</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php foreach (json_decode($_GET['p_data'],true) as $event): ?>

                    <tr>
                    <th scope="row"> <?php echo $event['ID']; ?> </th>
                    <td> <?php echo $event['NameSurname']; ?> </td>
                    <td> <?php echo $event['Check_in']; ?> </td>
                    <th>
                        <a href="services/update-visitor-checkin.php?p_id=<?php echo $event['ID']; ?>"> <i class="fa-solid fa-arrow-right-from-bracket"> Check-out</i> </a> 
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
