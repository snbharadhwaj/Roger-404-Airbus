<?php

    include_once('connect/config.php');

    $data = array();

    $sql = "SELECT COUNT(*) AS ApprovedCount FROM supply_chain_data";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $data['ApprovedCount'] = $row['ApprovedCount'];
    } else {
        $data['ApprovedCount'] = 0;
    }
    $sql = "SELECT COUNT(*) AS assemblyCount FROM assembly WHERE Approval = 0";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $data['assemblyCount'] = $row['assemblyCount'];
    } else {
        $data['assemblyCount'] = 0;
    }

    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($data);
?>