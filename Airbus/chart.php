<!DOCTYPE html>
<html>
<head>
    <title>Admin - Charts</title>
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
    table {
        background-color: white;
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
                    <a class="nav-link" href="../chart.php">Charts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container" style="max-width: 800px; margin-top: 50px; margin-bottom: 80px;">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center">Redundant Data (Fabrication)</h2>
                <canvas id="pieChart_1" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 800px; margin-top: 50px; margin-bottom: 80px;">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center">Redundant Data (Sub-Assembly)</h2>
                <canvas id="pieChart_2" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <div class="container" style="max-width: 800px; margin-top: 50px; margin-bottom: 80px;">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center">Redundant Data (Assembly)</h2>
                <canvas id="pieChart_3" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fabrication_data_counts.php',
                dataType: 'json',
                success: function(data) {
                    var TotalData = data.totalCount;
                    var DuplicateData = data.duplicateCount;
                    var UniqueData = TotalData - DuplicateData;
                    
                    var realPercentage = (UniqueData / TotalData) * 100;
                    var redundantPercentage = (DuplicateData / TotalData) * 100;

                    var ctxPie = document.getElementById('pieChart_1').getContext('2d');
                    new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: ['Redundant Data', 'Real Data'],
                            datasets: [{
                                data: [redundantPercentage,realPercentage],
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
            $.ajax({
                url: 'subassembly_data_counts.php',
                dataType: 'json',
                success: function(data) {
                    var TotalData = data.totalCount;
                    var DuplicateData = data.duplicateCount;
                    var UniqueData = TotalData - DuplicateData;
                    
                    var realPercentage = (UniqueData / TotalData) * 100;
                    var redundantPercentage = (DuplicateData / TotalData) * 100;

                    var ctxPie = document.getElementById('pieChart_2').getContext('2d');
                    new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: ['Redundant Data', 'Real Data'],
                            datasets: [{
                                data: [redundantPercentage,realPercentage],
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
            $.ajax({
                url: 'assembly_data_counts.php',
                dataType: 'json',
                success: function(data) {
                    var TotalData = data.totalCount;
                    var DuplicateData = data.duplicateCount;
                    var UniqueData = TotalData - DuplicateData;
                    
                    var realPercentage = (UniqueData / TotalData) * 100;
                    var redundantPercentage = (DuplicateData / TotalData) * 100;

                    var ctxPie = document.getElementById('pieChart_3').getContext('2d');
                    new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: ['Redundant Data', 'Real Data'],
                            datasets: [{
                                data: [redundantPercentage,realPercentage],
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
