<?php
    session_start();
    include_once('connect/config.php');

    $machineId = mysqli_real_escape_string($conn, $_POST['machineId']);

    $sql = "SELECT process, Process_ID, END_Date FROM assembly WHERE Machine_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $machineId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $process = $row['process'];
            $Process_ID = $row['Process_ID'];
            $END_Date = $row['END_Date'];
        }
    } else {
        $response = array('success' => false, 'message' => 'No matching process found for the given machine ID.');
        echo json_encode($response);
        exit;
    }

    $parts = explode("_", $Process_ID);
    $processId1 = $parts[0];
    $processId2 = implode("_", array_slice($parts, 1));
    
    $sql = "SELECT Item_ID, Assembly_ID, start_date FROM sub_assembly WHERE Assembly_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $processId1);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $start_date = $row['start_date'];
            $item_id_1 = $row['Item_ID'];
            $Assembly_ID_1 = $row['Assembly_ID'];
        }
    } else {
        $response = array('success' => false, 'message' => 'No matching sub-assembly found for Assembly_ID 1.');
        echo json_encode($response);
        exit;
    }

    $sql = "SELECT Item_ID, Assembly_ID FROM sub_assembly WHERE Machine_ID = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $processId2);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $item_id_2 = $row['Item_ID'];
            $Assembly_ID_2 = $row['Assembly_ID'];
        }
    } else {
        $response = array('success' => false, 'message' => 'No matching sub-assembly found for Assembly_ID 2.');
        echo json_encode($response);
        exit;
    }

    $sql = "UPDATE assembly SET Approval = 1 WHERE Machine_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $machineId);
    mysqli_stmt_execute($stmt);

    $sql = "UPDATE sub_assembly SET Approval = 1 WHERE Assembly_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Assembly_ID_1);
    mysqli_stmt_execute($stmt);

    $sql = "UPDATE sub_assembly SET Approval = 1 WHERE Assembly_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Assembly_ID_2);
    mysqli_stmt_execute($stmt);

    $sql = "INSERT INTO supply_chain_data (Machine_ID, Process_ID, process_Name, Assembly_ID, Item_ID_1, Item_ID_2, start_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", $machineId, $Process_ID, $process, $Assembly_ID_1, $item_id_1, $item_id_2, $start_date, $END_Date);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $response = array('success' => true, 'message' => 'The Assembly Process is Successfully Approved');
    } else {
        $response = array('success' => false, 'message' => 'Error in updating details');
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo json_encode($response);
?>
