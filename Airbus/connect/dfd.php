<?php
    session_start();
    include_once('connect/config.php');

    $sql = "SELECT process,Process_ID,Machine_ID,END_Date FROM assembly WHERE Approval = 0 AND END_Date < NOW ()";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $process = $row['process'];
            $processId = $row['Process_ID'];
            $MachineID = $row['Machine_ID'];
            $end_date = $row['END_Date'];

            $parts = explode("_", $Process_ID);
            $processId1 = $parts[0];
            $processId2 = implode("_", array_slice($parts, 1));

            $sql1 = "SELECT Item_ID, Assembly_ID, start_date FROM sub_assembly WHERE Assembly_ID = '$processId1'";
            $result1 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result1) > 0) {
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $start_date = $row1['start_date'];
                    $item_id_1 = $row1['Item_ID'];
                    $Assembly_ID_1 = $row1['Assembly_ID'];
                }
            }

            $sql2 = "SELECT Item_ID, Assembly_ID FROM sub_assembly WHERE Machine_ID = '$processId2' LIMIT 1";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $item_id_2 = $row2['Item_ID'];
                    $Assembly_ID_2 = $row2['Assembly_ID'];
                }
            }

            $sql3 = "UPDATE assembly SET Approval = 1 WHERE Machine_ID = '$MachineID'";
            mysqli_query($conn, $sql3);

            $sql4 = "UPDATE sub_assembly SET Approval = 1 WHERE Assembly_ID = '$Assembly_ID_1'";
            mysqli_query($conn, $sql4);

            $sql5 = "UPDATE sub_assembly SET Approval = 1 WHERE Assembly_ID = '$Assembly_ID_2'";
            mysqli_query($conn, $sql5);

            $sql6 = "INSERT INTO supply_chain_data (Machine_ID, Process_ID, process_Name, Assembly_ID, Item_ID_1, Item_ID_2, start_date, end_date)
            VALUES ('$MachineID','$processId','$process','$Assembly_ID_1','$item_id_1','$item_id_2','$start_date','$end_date')";
            mysqli_query($conn, $sql6);
        }
    }
?>
