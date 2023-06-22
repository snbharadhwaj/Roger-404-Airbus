<?php
    session_start();
    include_once('../connect/config.php');
    $ASS_ID = $_POST['ASS_ID'];
    $out_date = $_POST['end_date'];
    
    $query = "UPDATE sub_assembly SET end_date = '$out_date' WHERE Assembly_ID = '$ASS_ID'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $response = array('success' => true, 'message' => 'End-date updated successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error in updating details');
    }
    echo json_encode($response);
?>
