<!-- index.php -->
<div class="container text-center">

    <?php
    // Get the value of the 'var' parameter from the URL
    $var = isset($_GET['var']) ? $_GET['var'] : null;

    // Define the messages based on the 'var' value
    $toastMessage = '';
    if ($var === 'start') {
        $toastMessage = $labels['00_welcome_message'];
        $toastClass = 'toast bg-info text-white fade show';
    } elseif ($var === 'error') {
        $toastMessage = $labels['signin_error'];
        $toastClass = 'toast bg-danger text-white fade show';
    } elseif ($var === 'signin') {
        $toastMessage = $labels['signin_success'];
        $toastClass = 'toast bg-success text-white fade show';
    } elseif ($var === 'checkout') {
        $toastMessage = $labels['checkout_success'];
        $toastClass = 'toast bg-success text-white fade show';
    } elseif ($var === 'checkin') {
        $toastMessage = $labels['checkin_success'];
        $toastClass = 'toast bg-success text-white fade show';
    }
    ?>

    <!-- Add your background image styling here <div class="jumbotron home-banner"> -->
    <?php $stringclass = 'jumbotron '.strtolower(date('D')). '-banner'; ?>
    
    <?php echo "<div class='".$stringclass."'>"; ?>
        
        <!-- Centered buttons -->
        <div class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <a href="index.php?url=TCSessions/showPage&var=start" class="btn btn-primary btn-lg"> <i class="fa-solid fa-paper-plane"></i> SIMULATOR TRAINING </a>
            <br>
            <br>
            <button class="btn btn-secondary btn-lg mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">  <i class="fa-regular fa-user"> </i> VISITOR </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <a href="index.php?url=VisitorCheckin/showPage&var=start" class="btn btn-success btn-lg mx-2"> Check-in <i class="fa-solid fa-arrow-right-to-bracket"> </i> </a>
                        <a href="index.php?url=VisitorCheckout/showPage&var=start" class="btn btn-danger btn-lg mx-2"> <i class="fa-solid fa-arrow-right-from-bracket"> </i> Check-out</a>
                    </div>
                </div>

        </div>
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
