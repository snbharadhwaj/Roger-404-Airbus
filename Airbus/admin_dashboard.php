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
    <br><br><br>
    <div class="container">
        <h2>Real Time Data</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Raw Material</th>
                    <th>Quantity</th>
                    <th>In Date</th>
                    <th>Process</th>
                    <th>Machine ID</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include_once('config.php');

                $sql = "SELECT * FROM supply_chain_data";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['item'] . "</td>";
                    echo "<td>" . $row['raw_material'] . "</td>";
                    echo "<td>" . $row['Quantity'] . "</td>";
                    echo "<td>" . $row['in_date'] . "</td>";
                    echo "<td>" . $row['process'] . "</td>";
                    echo "<td>" . $row['Machine_ID'] . "</td>";
                    echo "<td>" . $row['end_date'] . "</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
    <div class="container" style="max-width: 500px; height: 400px; margin-top: 80px;margin-bottom: 80px;">
        <h2>Supply Chain Data</h2>
        <canvas id="chart"></canvas>
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_supply_chain_data.php',
                dataType: 'json',
                success: function(data) {
                    var supplyChainCount = data.length;

                    $.ajax({
                        url: 'fetch_assembly_data.php',
                        dataType: 'json',
                        success: function(data) {
                            var assemblyCount = data.length - supplyChainCount;

                            // Create the chart using Chart.js
                            var ctx = document.getElementById('chart').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Supply Chain Data', 'Assembly Data'],
                                    datasets: [{
                                        label: 'Data Count',
                                        data: [supplyChainCount, assemblyCount],
                                        backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
                                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
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
                }
            });
        });
    </script>
</body>
</html>
