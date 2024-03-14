<?php
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);

    // Include the file where your database connection is established
    require_once '../../app/models/cnx-db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        // Retrieve parameters from the URL
        $v_id = isset($_GET['p_id']) ? $_GET['p_id'] : 0;

        $sql = "update signin_form set d_check_out = NOW() where n_id = :p_id and b_status = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_id', $v_id);
        $stmt->execute();

        // Fetch the results into an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

        if ($numRows === 0) {
            header("/index.php?url=VisitorCheckout/showPage&var=error");
            exit();
        } else {
            header("Location: /index.php?url=Home/index&var=checkout");
            exit();    
        }
        

    } else {
        header("Location: index.php?url=VisitorCheckout/showPage&var=error");
        exit();
    }

?>
