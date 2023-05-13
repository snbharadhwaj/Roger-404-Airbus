<?php
    session_start();
    include_once('config.php');
    $ASS_ID = $_GET['Assembly_ID'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $out_date = $_POST['end_date'];
        $query = "UPDATE sub_assembly SET end_date = '$out_date' WHERE Assembly_ID = '$ASS_ID'";
        $result = mysqli_query($conn, $query);
        if ($result==true) {
            echo "<script type='text/javascript'>alert('End-date updated successfully');
            window.location='Sub_Assembly_dashboard.php';</script>";
            die;
        } else{
            echo "<script type='text/javascript'>alert('Error in updating details');
            window.location='Sub_Assembly_dashboard.php';</script>";
            die;
        } 
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
			<a class="p-2 text-dark" href="Sub_Assembly_dashboard.php">Dashboard</a>
			<a class="p-2 text-dark" href="Subassembly_Insert.php">Add Item</a>
            <a class="p-2 text-dark" href="Subassembly_Build.php">Build Sub-Assembly</a>
			<a class="p-2 text-dark" href="logout.php">Logout</a>
		</nav>
	</div>

    <div class="container">
        <h2>Dashboard</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Process</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $dept_id  = $_SESSION['ID'];
                $sql = "SELECT * FROM sub_assembly WHERE Assembly_ID='$ASS_ID'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["process"] . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row["start_date"])) . "</td>";
                        echo "<td>" . date('Y-m-d', strtotime($row["end_date"])) . "</td>";
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
