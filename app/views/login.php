<?php
    $var = isset($_GET['var']) ? $_GET['var'] : 'start';

    if($_GET['slowa']==='G1T6TQraLpx!'){
        $toastMessage = 'Welcome to Admin site';
        $toastClass = 'toast bg-success text-white fade show';
?>

<!-- index.php -->
<div class="container text-center">

    <!-- Add your background image styling here <div class="jumbotron home-banner"> -->
    <?php $stringclass = 'jumbotron '.strtolower(date('D')). '-banner'; ?>
    
    <div class="jumbotron fri-banner">
        <!-- Centered buttons -->
        <div class="text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">

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

<?php } else { ?>

<div class="container-sm">
<form class="row g-3" action="index.php?url=Login/showPage&var=check" method="POST" enctype="application/x-www-form-urlencoded" >

    <div class="col-md-6">
        <label for="inputUser" class="form-label">* User</label>
        <input type="text" class="form-control" id="inputUser" name="inputUser" placeholder="Type the user..." required>
    </div>
    <div class="col-md-6">
        <label for="inputPassword" class="form-label">* Password</label>
        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Type the password..." required>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>

</form>
</div>

<?php } ?>

