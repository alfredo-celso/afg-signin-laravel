<?php
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 1);

    // Include the file where your database connection is established
    require_once '../../app/models/cnx-db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $v_description = strtoupper($_POST['inputDescription']);
        $v_part_number = strtoupper($_POST['inputPartNumber']);
        $v_model = strtoupper($_POST['inputModel']);
        $v_brand = strtoupper($_POST['inputBrand']);
        $v_purchase_price = $_POST['inputPrice'];
        $v_qty = $_POST['inputQty'];
        $v_training_center = strtoupper($_POST['inputTC']);
        $v_rack_position = strtoupper($_POST['inputRack']);
        $v_device = $_POST['selectDevice'];
        $v_status = strtoupper($_POST['selectStatus']);
        $v_category = $_POST['selectCat'];

        $sql = "INSERT INTO warehouse (s_description, s_part_number, s_model, s_brand, n_purchase_price, d_check_in, n_qty, s_training_center, s_rack_position, s_device, s_status, s_category)
                VALUES (:p_description, :p_part_number, :p_model, :p_brand, :p_purchase_price, NOW(), :p_qty, :p_training_center, :p_rack_position, :p_device, :p_status, :p_category)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':p_description', $v_description);
        $stmt->bindParam(':p_part_number', $v_part_number);
        $stmt->bindParam(':p_model', $v_model);
        $stmt->bindParam(':p_brand', $v_brand);
        $stmt->bindParam(':p_purchase_price', $v_purchase_price);
        $stmt->bindParam(':p_qty', $v_qty);
        $stmt->bindParam(':p_training_center', $v_training_center);
        $stmt->bindParam(':p_rack_position', $v_rack_position);
        $stmt->bindParam(':p_device', $v_device);
        $stmt->bindParam(':p_status', $v_status);
        $stmt->bindParam(':p_category', $v_category);

        //echo "SQL: " . $sql;

        if ($stmt->execute()) {
            header("Location: /index.php?url=WarehouseIndex/showPage&var=successt&slowa=G1T6TQraLpx!");
            exit();
        } else {
            header("Location: /index.php?url=WarehouseCheckin/showPage&var=error&slowa=G1T6TQraLpx!");
            exit();
        }
    } else {
        header("Location: /index.php?url=WarehouseIndex/showPage&var=error&slowa=G1T6TQraLpx!");
        exit();
    }

?>
