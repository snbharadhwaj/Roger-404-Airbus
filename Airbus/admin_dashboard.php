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
    <style>
    body {
        background-color: #000;
        font-family: Tahoma, Verdana, sans-serif;
    }
    .cont{
        background-color: #0101;   
        margin-bottom: 10px;
        animation: fade-in 1s ease-in-out;
        
    }
    @keyframes fade-in {
        0% {opacity: 0;}
        100% {opacity: 1;}
    }
    table {
        background-color: white;
        border-radius: 10px;
    }
    .table thead th {
        border-bottom: 1px solid black;
        
    }
    .table tbody td {
        border-bottom: 1px solid black;
        border-right: 1px solid black;
    }
    .table tbody td:last-child {
        border-right: none;
    }
    </style>
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
                    <a class="nav-link" href="Admin_Dashboard/Fabrication_BillBoard.php">Fabrication</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Admin_Dashboard/SubAssembly_Billboard.php">Sub-Assembly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Admin_Dashboard/Assembly_Billboard.php">Assembly</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="chart.php">Charts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="max-width: 500px; margin-top: 40px; margin-bottom: 70px;">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center">Data Analytics</h2>
                <canvas id="chart" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <main role="main" class="container cont">
        <h2 style="color: white;" class="d-flex justify-content-center m-3 p-2">Approved Data - Dashboard</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Machine ID</th>
                        <th>Assembly Process</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        session_start();
                        include_once('connect/config.php');
                        $sql = "SELECT * FROM supply_chain_data";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['Machine_ID'] . "</td>";
                            echo "<td>" . ucwords($row['process_Name']) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["start_date"])) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["end_date"])) . "</td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_supply_chain_data.php',
                dataType: 'json',
                success: function(data) {
                    var ctx = document.getElementById('chart').getContext('2d');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Approved Data', 'Assembly Data'],
                            datasets: [{
                                label: 'Data Count',
                                data: [data.ApprovedCount, data.assemblyCount],
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
                },
                error: function(xhr, status, error) {
                    console.log('AJAX request error:', error);
                }
            });
        });
    </script>
</body>
</html>
