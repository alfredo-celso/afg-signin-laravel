<?php
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);

    // Include the file where your database connection is established
    require_once '../../app/models/cnx-db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $v_sessionDate = $_POST['inputDate'];
        $v_nameSurname = strtoupper($_POST['inputName']);
        $v_role = strtoupper($_POST['selectRole']);
        $v_citizenship = strtoupper($_POST['selectCitizen']);
        $v_session = $_POST['trainingSession1'];
        $v_customer = strtoupper($_POST['inputCustomer']);
        $v_trainingCenter = strtoupper($_POST['inputTrainingCenter']);
        $v_device = $_POST['inputDevice'];
        $v_safety = isset($_POST['safetyCheck']) ? 1 : 0;
        $v_ip = $_POST['inputIP'];

        $sql = "INSERT INTO signin_form (d_session_date, s_name_surname, s_role, s_citizenship, s_session, s_customer, s_training_center, s_device, b_safety, s_ip)
                VALUES (:p_session_date, :p_name_surname, :p_role, :p_citizenship, :p_session, :p_customer, :p_training_center, :p_device, :p_safety, :p_ip)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_session_date', $v_sessionDate);
        $stmt->bindParam(':p_name_surname', $v_nameSurname);
        $stmt->bindParam(':p_role', $v_role);
        $stmt->bindParam(':p_citizenship', $v_citizenship);
        $stmt->bindParam(':p_session', $v_session);
        $stmt->bindParam(':p_customer', $v_customer);
        $stmt->bindParam(':p_training_center', $v_trainingCenter);
        $stmt->bindParam(':p_device', $v_device);
        $stmt->bindParam(':p_safety', $v_safety);
        $stmt->bindParam(':p_ip', $v_ip);

        if ($stmt->execute()) {
            if ($v_customer === 'GUEST'){
                header("Location: http://localhost:8080/index.php?url=Home/index&var=checkin");
            } else {
                header("Location: http://localhost:8080/index.php?url=Home/index&var=signin");
            }
            exit();
        } else {
            header("Location: http://localhost:8080/index.php?url=Home/index&var=error");
            exit();
        }
    } else {
        header("Location: http://localhost:8080/index.php?url=TCSessions/showPage&var=error");
        exit();
    }

?>
