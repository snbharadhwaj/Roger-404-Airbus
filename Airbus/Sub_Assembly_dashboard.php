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
                    <th>Item name</th>
                    <th>Item type</th>
                    <th>Item Quantity</th>
					<th>In Date</th>
					<th>Out Date</th>
					<th>Checklist</th>
				</tr>
			</thead>
			<tbody>
			<?php
				session_start();
				include_once('config.php');
				$dept_id  = $_SESSION['ID'];
				$sql = "SELECT * FROM fabrication F,sub_assembly S WHERE S.Dept_No = $dept_id AND S.item_id = F.item_id";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row["process"] . "</td>";
                        echo "<td>" . $row["item"] . "</td>";
						echo "<td>" . $row["raw_material"] . "</td>";
						echo "<td>" . $row["Quantity"] . "</td>";
						echo "<td>" . date('Y-m-d', strtotime($row["start_date"])) . "</td>";
						echo "<td>" . date('Y-m-d', strtotime($row["end_date"])) . "</td>";
						echo "<td>";
                        echo "<a href='update_page_sub.php?Assembly_ID=" . $row["Assembly_ID"] . "' class='btn btn-primary btn-sm'>Update</a>";
                        echo "</td>";
						echo "</tr>";
					}
				}
				mysqli_close($conn);
			?>
			</tbody>
		</table>
	</div>
</body>
</html>
