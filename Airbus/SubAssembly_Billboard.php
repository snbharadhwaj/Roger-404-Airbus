<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a class="nav-link" href="admin_Approval.php">Approval</a>
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
    <br><br>
    <div class="container" style="max-width: 800px; height: 400px;">
        <h2>Assembly Items</h2>
        <canvas id="chart"></canvas>
    </div>
    <br><br><br>
    <div class="container">
        <h2>Assembly Table</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Process</th>
                    <th>Item ID</th>
                    <th>Machine ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('config.php');

                $sql = "SELECT DISTINCT process, Item_ID, Machine_ID,start_date,end_date FROM sub_assembly";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['process']."</td>";
                    echo "<td>".$row['Item_ID']."</td>";
                    echo "<td>".$row['Machine_ID']."</td>";
                    echo "<td>".$row['start_date']."</td>";
                    echo "<td>".$row['end_date']."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch data from the fetch_assembly_data.php endpoint
            $.ajax({
            url: 'fetch_subassembly_data.php',
            dataType: 'json',
            success: function(data) {
                // Prepare the data for the chart
                var processes = [];
                var counts = [];

                // Extract process names and counts from the response
                data.forEach(function(item) {
                processes.push(item.process);
                counts.push(item.count);
                });

                // Create the bar chart
                var ctx = document.getElementById('chart').getContext('2d');
                new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: processes,
                    datasets: [{
                    label: 'Count',
                    data: counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                    }
                }
                });
            }
            });
        });
        </script>
</body>
</html>
