<?php

include_once('config.php');

$sql = "SELECT process FROM assembly";
$result = mysqli_query($conn, $sql);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $process = $row['process'];
    $entry = array(
        'process' => $process
    );

    $data[] = $entry;
}

$jsonData = json_encode($data);

header('Content-Type: application/json');
echo $jsonData;
?>
