<?php
    session_start();
    include_once('../connect/config.php');
    $mach_id = $_POST['mach_id'];
    $out_date = $_POST['end_date'];
    
    $query = "UPDATE assembly SET END_Date = '$out_date' WHERE Machine_ID = '$mach_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $response = array('success' => true, 'message' => 'End-date updated successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error in updating details');
    }
    echo json_encode($response);
?>
