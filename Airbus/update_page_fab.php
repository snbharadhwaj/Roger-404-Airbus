<?php
    session_start();
    include_once('config.php');
    $item_id = $_GET['item_id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $out_date = $_POST['end_date'];
        $query = "UPDATE fabrication SET out_date = '$out_date' WHERE item_id = '$item_id'";
        mysqli_query($conn, $query);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Washing Machine Management</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="Fabricator_dashboard.php">Dashboard</a>
            <a class="p-2 text-dark" href="Fabricator_Insert.php">Insert Item</a>
            <a class="p-2 text-dark" href="logout.php">Logout</a>
        </nav>
    </div>

    <div class="container">
        <h2>Dashboard</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Raw Material</th>
                    <th>Quantity</th>
                    <th>In Date</th>
                    <th>Out Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $dept_id  = $_SESSION['ID'];
                $sql = "SELECT * FROM fabrication WHERE item_id='$item_id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["item"] . "</td>";
                        echo "<td>" . $row["raw_material"] . "</td>";
                        echo "<td>" . $row["Quantity"] . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row["in_date"])) . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row["out_date"])) . "</td>";
                        echo "</tr>";
                    }
                }
                mysqli_close($conn);
            ?>
            </tbody>
        </table>
        <form method="post">
            <div class="form-group">
				<label for="end_date">End Date:</label>
				<input type="date" class="form-control" id="end_date" name="end_date" required>
			</div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
