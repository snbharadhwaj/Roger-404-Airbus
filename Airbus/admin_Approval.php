<!DOCTYPE html>
<html>
<head>
    <title>Assembly Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Approval</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Fabrication_BillBoard.php">Fabrication</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="SubAssembly_Billboard.php">Sub-Assembly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Assembly_Billboard.php">Assembly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Assembly Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Process</th>
                    <th>Machine ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include_once('config.php');
                $sql = "SELECT DISTINCT a.process, a.Machine_ID ,a.Start_Date ,a.END_Date FROM assembly a LEFT JOIN supply_chain_data s ON a.Machine_ID = s.Machine_ID WHERE s.Machine_ID IS NULL;";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['process'] . "</td>";
                        echo "<td>" . $row['Machine_ID'] . "</td>";
						echo "<td>" . date('Y-m-d', strtotime($row["Start_Date"])) . "</td>";
						echo "<td>" . date('Y-m-d', strtotime($row["END_Date"])) . "</td>";
                        echo "<td><button class='btn btn-success' onclick='approveData(\"" . $row['Machine_ID'] . "\")'>Approve</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }

                mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function approveData(machineId) {
            $.ajax({
                url: 'update_supply_chain_data.php',
                method: 'POST',
                data: { machineId: machineId },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    </script>
</body>
</html>
