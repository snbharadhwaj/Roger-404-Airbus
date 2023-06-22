<?php
    include_once('connect/config.php');

    $data = array();

    $sql = "SELECT COUNT(*) AS totalCount FROM fabrication WHERE Approval=0";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data['totalCount'] = $row['totalCount'];
    }

    $sql = "SELECT COUNT(*) AS duplicateCount
            FROM fabrication f1
            INNER JOIN (
                SELECT item,raw_material,Quantity,MAX(out_date) AS latest_End_Date
                FROM fabrication WHERE Approval=0 AND out_date<NOW()
                GROUP BY item,raw_material,Quantity
            ) f2 ON f1.item = f2.item AND f1.raw_material = f2.raw_material AND f1.Quantity=f2.Quantity
            AND f1.Approval=0 AND f1.out_date<NOW() WHERE f1.out_date < f2.latest_End_Date";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data['duplicateCount'] = $row['duplicateCount'];
    }

    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($data);
?>
