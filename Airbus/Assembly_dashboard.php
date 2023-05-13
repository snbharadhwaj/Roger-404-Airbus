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
			<a class="p-2 text-dark" href="Assembly_dashboard.php">Dashboard</a>
			<a class="p-2 text-dark" href="logout.php">Logout</a>
		</nav>
	</div>

	<div class="container">
		<h2>Dashboard</h2>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Machine ID</th>
					<th>Process</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				session_start();
				include_once('config.php');
				$dept_id  = $_SESSION['ID'];
				$sql = "SELECT * FROM assembly WHERE Dept_No = '$dept_id'";
				$result = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result) > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row["Machine_ID"] . "</td>";
						echo "<td>" . $row["process"] . "</td>";
						echo "<td>" . date('Y-m-d', strtotime($row["Start_Date"])) . "</td>";
						echo "<td>" . date('Y-m-d', strtotime($row["END_Date"])) . "</td>";
                        echo "<td>";
                        echo "<a href='update_page_ass.php?Machine_ID=" . $row["Machine_ID"] . "' class='btn btn-primary btn-sm'>Update</a>";
                        echo "</td>";
						echo "</tr>";
					}
				}
				mysqli_close($conn);

				function getItemStatus($itemId)
				{
					global $conn;
					$query = "SELECT Ass_Status FROM Ass_Approval WHERE Machine_ID = '$itemId'";
					$result = mysqli_query($conn, $query);
					if ($result && mysqli_num_rows($result) > 0) {
						$row = mysqli_fetch_assoc($result);
						return $row['Ass_Status'];
					}
					return 0; 
				}
			?>
			</tbody>
		</table>
	</div>

	<script>
		function updateStatus(itemId) {
			$.ajax({
				type: "POST",
				url: "update_status_ass.php",
				data: { itemId: itemId },
				success: function(response) {
					console.log(response);
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}
	</script>
</body>
</html>
