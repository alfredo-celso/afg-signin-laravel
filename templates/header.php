<!-- header.php -->
<?php
$var = isset($_GET['slowa']) ? $_GET['slowa'] : 'G1T6TQraLpx!';
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?url=Home/index&var=start">
                <img src="/assets/img/Logo-AFG.jpg" alt="Your Logo" height="75" class="d-inline-block align-middle">
            </a>
            <div class="ml-auto"> 
                    <span class="text-center">
                    <?php
                        echo "<h3>".$labels['sign-in_hub_tittle']."</h3>"; 
                    ?>
                    </span>
                </div>
            <?php if ($_GET['slowa']<>'G1T6TQraLpx!'){ ?>
                <div class="ml-auto">
                    <span class="text-right"> <a href="/index.php?url=Login/showPage&var=start"> <i class="fa-solid fa-screwdriver-wrench"> </i> <span class="badge text-bg-danger"> Admin </span> </a> </span>
                </div>
            <?php } else { ?>
                <div class="ml-auto">
                    <span class="text-right"> <a href="/index.php?url=AdminReports/showPage&var=start&slowa=G1T6TQraLpx!"> <i class="fa-solid fa-file"></i> <span class="badge text-bg-info"> Reports </span> </a> </span>
                </div>
                <div class="ml-auto">
                    <span class="text-right"> <a href="/index.php?url=AdminSignin/showPage&var=start&slowa=G1T6TQraLpx!"> <i class="fa-solid fa-paper-plane"></i> <span class="badge text-bg-info"> Register FFS </span> </a> </span>
                </div>

                <div class="ml-auto">
                    <!-- <span class="text-right"> <a href="/index.php?url=WarehouseIndex/showPage&var=start&slowa=G1T6TQraLpx!"> <i class="fa-solid fa-screwdriver-wrench"></i> <span class="badge text-bg-info"> Warehouse </span> </a> </span> -->
                </div>


            <?php } ?>
            <!-- Add navigation or any other header content here -->
        </div>
    </nav>
</header>

