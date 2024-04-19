<?php
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);

    // Include the file where your database connection is established
    require_once '../../app/models/cnx-db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        // Retrieve parameters from the URL
        $v_id = isset($_GET['p_id']) ? $_GET['p_id'] : 0;

        $sql = "update signin_form set b_status = 0 where n_id = :p_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_id', $v_id);
        $stmt->execute();

        // Fetch the results into an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numRows = $stmt->rowCount();

        if ($numRows === 0) {
            header("/index.php?url=AdminReports/showPage&var=error&slowa=G1T6TQraLpx!");
            exit();
        } else {
            header("Location: /index.php?url=AdminReports/showPage&var=start&slowa=G1T6TQraLpx!");
            exit();    
        }
        

    } else {
        header("Location: /index.php?url=AdminReports/showPage&var=error&slowa=G1T6TQraLpx!");
        exit();
    }

?>
