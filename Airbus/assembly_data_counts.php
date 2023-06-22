<?php
    include_once('connect/config.php');

    $data = array();

    $sql = "SELECT COUNT(*) AS totalCount FROM assembly WHERE Approval = 0";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data['totalCount'] = $row['totalCount'];
    }

    $sql = "SELECT COUNT(*) AS duplicateCount
            FROM assembly f1
            INNER JOIN (
                SELECT process, MAX(END_Date) AS latest_End_Date
                FROM assembly WHERE Approval=0 AND END_Date<NOW()
                GROUP BY process
            ) f2 ON f1.process = f2.process AND f1.Approval=0 AND f1.END_Date<NOW()
            WHERE f1.END_Date < f2.latest_End_Date";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $data['duplicateCount'] = $row['duplicateCount'];
    }

    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($data);
?>
