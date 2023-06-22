<?php
session_start();
include_once('../connect/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $material = $_POST['material'];
    $quantity = $_POST['quantity'];
    $inDate = $_POST['in_date'];
    $outDate = $_POST['out_date'];

    $duplicateCheckQuery = "SELECT COUNT(*) AS count FROM fabrication WHERE item = '$item' AND raw_material = '$material' AND Quantity = '$quantity' AND in_date <= '$inDate' AND out_date >= '$outDate' AND Approval = 0";
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
