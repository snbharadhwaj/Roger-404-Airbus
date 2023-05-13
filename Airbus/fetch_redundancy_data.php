<?php
include_once('config.php');

// Fetch the redundancy data
$sql = "SELECT COUNT(*) AS count FROM fabrication";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$fabricationCount = $row['count'];

$sql = "SELECT COUNT(*) AS count FROM sub_assembly";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$subAssemblyCount = $row['count'];

$sql = "SELECT COUNT(*) AS count FROM assembly";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$assemblyCount = $row['count'];

$data = [
    'fabrication' => $fabricationCount,
    'sub_assembly' => $subAssemblyCount,
    'assembly' => $assemblyCount
];

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>
