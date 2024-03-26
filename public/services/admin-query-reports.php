<?php
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);

    // Include the file where your database connection is established
    require_once '../../app/models/cnx-db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $v_inputDateFrom = $_POST['inputDateFrom'];
        $v_inputDateTo = $_POST['inputDateTo'];
        $v_selectTC = strtoupper($_POST['selectTC']);

        switch (strtoupper($_POST['inlineRadioOptions'])) {
            case 'ALL':
                $sql = "select * from view_signin where Date between :p_dateFrom and :p_dateTo and TrainingCenter = :p_tc";
                break;
            case 'CREW':
                $sql = "select * from view_signin where Role != 'VISITOR' and Date between :p_dateFrom and :p_dateTo and TrainingCenter = :p_tc";
                break;
            case 'VISITOR':
                $sql = "select * from view_signin where Role = 'VISITOR' and Date between :p_dateFrom and :p_dateTo and TrainingCenter = :p_tc";
                break;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_dateFrom', $v_inputDateFrom);
        $stmt->bindParam(':p_dateTo', $v_inputDateTo);
        $stmt->bindParam(':p_tc', $v_selectTC);
        $stmt->execute();

        // Fetch the results into an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numRows = count($results);

        if ($numRows === 0) {
            //echo "<div style='background-color: yellow; color: black;'><i class='fa-solid fa-triangle-exclamation'></i> WARNING: Does not exist any record with name/surname: ".$v_nameSurname." Try again... </div>";
            header("Location: /index.php?url=AdminReports/showPage&var=start&slowa=G1T6TQraLpx!");
            exit();
        } else {
            header("Location: /index.php?url=AdminReports/showPage&var=results&slowa=G1T6TQraLpx!"."&p_data=". urlencode(json_encode($results)));
            exit();
        }
    } else {
        header("Location: /index.php?url=AdminReports/showPage&var=error&slowa=G1T6TQraLpx!");
        exit();
    }

?>
