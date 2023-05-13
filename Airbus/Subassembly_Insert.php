<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST['item_name'];
    $rawMaterial = $_POST['raw_material'];
    $quantity = $_POST['quantity'];
    $outDate = $_POST['out_date'];

    $sql = "SELECT item_id FROM sub_assembly WHERE item_id LIKE 'WM%' ORDER BY item_id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastItemId = $row['item_id'];
        $lastNumber = intval(substr($lastItemId, 2));
        $newNumber = $lastNumber + 1;
        $newItemId = substr($lastItemId, 0, 2) . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    } else {
        $newItemId = "WM001";
    }
    $startDate = date('Y-m-d H:i:s');

    $sql = "INSERT INTO fabrication (item, item_id, raw_material, Quantity, in_date, out_date)
            VALUES (?, ?, ?, ?, ? , ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssss" , $itemName, $newItemId, $rawMaterial, $quantity, $startDate,$outDate);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

	echo "<script type='text/javascript'>alert('Sub-Assembly details updated successfully');
	window.location='Subassembly_Insert.php';</script>";
	die;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create New Item</title>
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
		<h2>Create New Item</h2>
		<form method="POST">
			<div class="form-group">
				<label for="item_name">Item Name:</label>
				<input type="text" class="form-control" id="item_name" name="item_name" required>
			</div>
			<div class="form-group">
				<label for="raw_material">Raw Material:</label>
				<input type="text" class="form-control" id="raw_material" name="raw_material" required>
			</div>
			<div class="form-group">
				<label for="quantity">Quantity:</label>
				<input type="text" class="form-control" id="quantity" name="quantity" required>
			</div>
			<div class="form-group">
				<label for="out_date">Out Date:</label>
				<input type="date" class="form-control" id="out_date" name="out_date" required>
			</div>
			<button type="submit" class="btn btn-primary">Create</button>
		</form>
	</div>
</body>
</html>
