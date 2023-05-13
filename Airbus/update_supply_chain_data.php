<?php
include_once('config.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['machineId'])) {
            $machineId = mysqli_real_escape_string($conn, $_POST['machineId']);

            $sql1 = "SELECT process,Process_ID , END_Date FROM assembly WHERE Machine_ID = '$machineId'";
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    $process = $row['process'];
                    $Process_ID = $row['Process_ID'];
                    $END_Date = $row['END_Date'];
                }
            }

            $processIdd = substr($Process_ID, 0, strpos($Process_ID, '_'));

            $sql2 = "SELECT Assembly_ID, process, start_date FROM sub_assembly WHERE Assembly_ID = '$processIdd'";
            $result2 = mysqli_query($conn, $sql2);

            if (mysqli_num_rows($result2) > 0) {
                while ($row = mysqli_fetch_assoc($result2)) {
                    $Assembly_ID = $row['Assembly_ID'];
                    $process_name = $row['process'];
                    $start_date = $row['start_date'];
                }
            }

            $sql = "INSERT INTO supply_chain_data (Assembly_ID, process_Name, process, Process_ID, Machine_ID, start_date, end_date)
                    VALUES ('$Assembly_ID', '$process_name', '$process', '$Process_ID' ,'$machineId', '$start_date', '$END_Date')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('status' => 'error', 'message' => 'Error updating data'));
            }
        mysqli_close($conn);
        }
    }
?>
