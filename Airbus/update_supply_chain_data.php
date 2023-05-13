<?php
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $processId = $_POST['Process_ID'];
    $processIdd = substr($processId, 0, strpos($processId, '_'));

    $sql1 = "SELECT Process_ID, Machine_ID, END_Date FROM assembly WHERE Process_ID = '$processId'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $Process_ID = $row['Process_ID'];
            $Machine_ID = $row['Machine_ID'];
            $END_Date = $row['END_Date'];
        }
    }

    $sql2 = "SELECT Assembly_ID, process, Item_ID, end_date, start_date FROM sub_assembly WHERE Assembly_ID = '$processIdd'";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            $Assembly_ID = $row['Assembly_ID'];
            $process = $row['process'];
            $item_id = $row['Item_ID'];
            $out_date = $row['end_date'];
            $start_date = $row['start_date'];
        }
    }

    $sql3 = "SELECT item, raw_material, Quantity, in_date FROM fabrication WHERE item_id = '$item_id'";
    $result3 = mysqli_query($conn, $sql3);

    if (mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
            $item = $row['item'];
            $raw_material = $row['raw_material'];
            $Quantity = $row['Quantity'];
            $in_date = $row['in_date'];
        }
    }

    $sql = "INSERT INTO supply_chain_data (item, item_id, raw_material, Quantity, in_date, out_date, Assembly_ID, process, Process_ID, Machine_ID, start_date, end_date)
            VALUES ('$item', '$item_id', '$raw_material', '$Quantity', '$in_date', '$out_date', '$Assembly_ID', '$process', '$Process_ID', '$Machine_ID', '$start_date', '$END_Date')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Error updating data'));
    }
}

mysqli_close($conn);
?>
