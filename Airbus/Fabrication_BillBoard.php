<!DOCTYPE html>
<html>
<head>
    <title>Unique Items</title>
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
        <h2>Fabrication Items</h2>
        <div style="max-width: 1000px; height: 400px;">
            <canvas id="barChart"></canvas>
        </div>
        <br>
        <br>
        <h2>Redundant Data</h2>
        <div style="max-width: 500px; height: 400px; margin-top: 80px;margin-bottom: 80px;">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_data.php',
                dataType: 'json',
                success: function(data) {
                    var labels = data.map(function(item) {
                        return item.item;
                    });
                    var quantities = data.map(function(item) {
                        return item.Quantity;
                    });

                    var ctxBar = document.getElementById('barChart').getContext('2d');
                    new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Quantity',
                                data: quantities,
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

                    var redundantCount = data.length;
                    var totalCount = 0;
                    quantities.forEach(function(quantity) {
                        totalCount += parseInt(quantity);
                    });
                    var realCount = totalCount - redundantCount;
                    var redundantPercentage = (redundantCount / totalCount) * 100;
                    var realPercentage = (realCount / totalCount) * 100;

                    var ctxPie = document.getElementById('pieChart').getContext('2d');
                    new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: ['Redundant Data', 'Real Data'],
                            datasets: [{
                                data: [redundantPercentage, realPercentage],
                                backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)'],
                                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true
                        }
                    });
                }
            });
        });
        </script>
    </body>
</html>

    
