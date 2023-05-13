<?php
include_once('config.php');

$sql = "SELECT DISTINCT item, raw_material, CAST(Quantity AS UNSIGNED) AS Quantity FROM fabrication";

$result = mysqli_query($conn, $sql);

$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>
