<?php
session_start();
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assemblyName = $_POST['assembly_name'];
    $itemName = $_POST['item_name'];
    $endDate = $_POST['end_date'];
    $startDate = $_POST['new_date'];

    // Retrieve the item_id based on the selected item name
    $sql = "SELECT item_id FROM fabrication WHERE item = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $itemName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $itemId);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Insert the assembly record into the sub_assembly table
    $sql = "SELECT Assembly_ID, Machine_ID FROM Sub_Assembly ORDER BY Assembly_ID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastAssemblyId = $row['Assembly_ID'];
        $lastMachineId = $row['Machine_ID'];
        $lastAssemblyNumber = intval(substr($lastAssemblyId, -4));
        $lastMachineNumber = intval(substr($lastMachineId, -3));
        $newAssemblyNumber = $lastAssemblyNumber + 1;
        $newMachineNumber = $lastMachineNumber + 1;
        $newAssemblyId = substr($lastAssemblyId, 0, -4) . str_pad($newAssemblyNumber, 4, '0', STR_PAD_LEFT);
        $newMachineId = substr($lastMachineId, 0, -3) . str_pad($newMachineNumber, 3, '0', STR_PAD_LEFT);
    } else {
        $newAssemblyId = "SAWM0001"; 
        $newMachineId = "FA_WM001"; 
    }

    $sql = "INSERT INTO Sub_Assembly (Assembly_ID, process, Item_ID, Machine_ID, start_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssss", $newAssemblyId, $assemblyName, $itemId, $newMachineId, $startDate, $endDate);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: Subassembly_Build.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Assembly</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
		<h2>Create Assembly</h2>
		<form method="POST">
			<div class="form-group">
				<label for="assembly_name">Assembly Name:</label>
				<input type="text" class="form-control" id="assembly_name" name="assembly_name" required>
			</div>
            <div class="form-group">
                <label for="item_name">Select an Item:</label>
                <select class="form-control" id="item_name" name="item_name" required>
                    <option value="">Select an Item</option>
                    <?php
                    $sql = "SELECT DISTINCT item, raw_material, Quantity FROM fabrication";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $itemName = $row['item'];
                            $rawMaterial = $row['raw_material'];
                            $quantity = $row['Quantity'];
                            echo "<option value='" . $itemName . "'>" . $itemName . " (Raw Material: " . $rawMaterial . ", Quantity: " . $quantity . ")</option>";
                        }
                    }
                    mysqli_close($conn);
                    ?>
                </select>
            </div>

            <div class="form-group">
				<label for="new_date">Start Date:</label>
				<input type="date" class="form-control" id="new_date" name="new_date" required>
			</div>
			<div class="form-group">
				<label for="end_date">End Date:</label>
				<input type="date" class="form-control" id="end_date" name="end_date" required>
			</div>
			<button type="submit" class="btn btn-primary">Create</button>
		</form>
	</div>

	<script>
		$(document).ready(function() {
			$("#end_date").datepicker({
				minDate: 0,
				dateFormat: "yy-mm-dd"
			});
		});
	</script>
</body>
</html>
