<?php
session_start();
include_once('../connect/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assembly_name = $_POST['assembly_name'];
    $sub_assembly = $_POST['sub_assembly'];
    $sub_assembly_other = $_POST['sub_assembly_other'];
    $inDate = $_POST['new_date'];
    $outDate = $_POST['end_date'];
    $sub_assID_1 = $_POST['sub_assID_1'];
    $sub_assID_2 = $_POST['sub_assID_2'];

    $duplicateCheckQuery = "SELECT COUNT(*) AS count 
                            FROM assembly WHERE process = '$assembly_name'
                                AND Start_Date <= '$inDate'
                                AND END_Date >= '$outDate'
                                AND Approval = 0";
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
