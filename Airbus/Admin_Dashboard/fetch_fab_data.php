<?php
include_once('../connect/config.php');

$sql = "SELECT item, COUNT(*) AS count
        FROM fabrication WHERE Approval = 0 GROUP BY item";

$result = mysqli_query($conn, $sql);

$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $row['item'] = ucwords(strtolower($row['item'])); // Capitalize item name
        $data[] = $row;
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>
