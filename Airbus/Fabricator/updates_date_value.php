<?php
    session_start();
    include_once('../connect/config.php');
    $item_id = $_POST['item_id'];
    $out_date = $_POST['end_date'];
    
    $query = "UPDATE fabrication SET out_date = '$out_date' WHERE item_id = '$item_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $response = array('success' => true, 'message' => 'End-date updated successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error in updating details');
    }
    echo json_encode($response);
?>
