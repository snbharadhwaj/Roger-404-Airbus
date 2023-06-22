<?php
session_start();
include_once('../connect/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assembly_name = $_POST['assembly_name'];
    $item_name = $_POST['item_name'];
    $item_id = $_POST['item_id'];
    $inDate = $_POST['new_date'];
    $outDate = $_POST['end_date'];

    $duplicateCheckQuery = "SELECT COUNT(*) AS count 
    FROM sub_assembly s WHERE s.process = '$assembly_name'
          AND s.start_date <= '$inDate'
          AND s.end_date >= '$outDate'
          AND s.Approval = 0";
    $duplicateCheckResult = mysqli_query($conn, $duplicateCheckQuery);

    if ($duplicateCheckResult && mysqli_num_rows($duplicateCheckResult) > 0) {
        $duplicateCheckRow = mysqli_fetch_assoc($duplicateCheckResult);
        $count = $duplicateCheckRow['count'];
        
        if ($count > 0) {
            $response = array('success' => true, 'message' => 'Success');
        } else {
            $response = array('success' => false, 'message' => 'Failed');
        }
    } else {
        $response = array('success' => false, 'message' => 'Failed');
    }

    mysqli_close($conn);
    echo json_encode($response);
    exit;
}
?>
