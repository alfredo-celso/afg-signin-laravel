<?php
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);

    // Include the file where your database connection is established
    require_once '../../app/models/cnx-db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        /*
        $v_id = strtoupper($_GET['inputName']);

        $sql = "select n_id as 'ID', s_name_surname as 'NameSurname', s_session as 'Check_in' from signin_form where s_name_surname LIKE CONCAT('%', :p_name_surname, '%') and b_status = 1 and s_role = 'VISITOR' and d_check_out = '0000-00-00 00:00:00'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_name_surname', $v_nameSurname);
        $stmt->execute();

        // Fetch the results into an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numRows = count($results);

        if ($numRows === 0) {
            //echo "<div style='background-color: yellow; color: black;'><i class='fa-solid fa-triangle-exclamation'></i> WARNING: Does not exist any record with name/surname: ".$v_nameSurname." Try again... </div>";
            header("Location: http://localhost:8080/index.php?url=VisitorCheckout/showPage&var=noresults&p_visitor=".$v_nameSurname);
            exit();
        } else {

            header("Location: http://localhost:8080/index.php?url=VisitorCheckout/showPage&var=results&p_visitor=".$v_nameSurname."&p_data=". urlencode(json_encode($results)));
            exit();
        }
        */
        header("Location: /index.php?url=Home/index&var=checkout");
        exit();

    } else {
        header("Location: http://localhost:8080/index.php?url=TCSessions/showPage&var=error");
        exit();
    }

?>
