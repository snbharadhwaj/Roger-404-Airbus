<!DOCTYPE html>
<html>
<head>
    <title>Admin - Fabrication Items</title>
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
        background-color: #000;   
        margin-bottom: 10px;
        animation: fade-in 1s ease-in-out;
    }
    @keyframes fade-in {
        0% {opacity: 0;}
        100% {opacity: 1;}
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
                    <a class="nav-link" href="../admin_dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin_Approval.php">Approval</a>
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
                    <a class="nav-link" href="../chart.php">Charts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="max-width: 800px; margin-top: 70px; margin-bottom: 80px;">
        <div class="card shadow">
            <div class="card-body">
                <h2 class="card-title text-center">Data Analytics (Items)</h2>
                <canvas id="barChart" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>

    <main role="main" class="container cont" style="background-color:darkslategrey;">
    <h2 style="color: white;" class="d-flex justify-content-center m-3 p-2">Item Dashboard</h2>
        <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Item" id="searchInput" onkeyup="searchItems()">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Raw Material</th>
                        <th>Quantity</th>
                        <th>In Date</th>
                        <th>Out Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    include_once('../connect/config.php');
                    $dept_id = $_SESSION['ID'];
                    $sql = "SELECT * FROM fabrication";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . ucwords($row["item"]) . "</td>";
                            echo "<td>" . ucwords($row["raw_material"]) . "</td>";                            
                            echo "<td>" . $row["Quantity"] . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["in_date"])) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["out_date"])) . "</td>";
                            if ($row["Approval"] == 1) {
                                echo "<td>" . "Approved" . "</td>";
                            } else {
                                echo "<td>" . "" . "</td>";
                            }
                            echo "</tr>";
                        }
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
                url: 'fetch_fab_data.php',
                dataType: 'json',
                success: function(data) {
                    var labels = data.map(function(item) {
                        return item.item;
                    });
                    var quantities = data.map(function(item) {
                        return item.count;
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
                }
            });
        });
        </script>
        <script>
            function searchItems() {
                var searchValue = document.getElementById("searchInput").value.trim().toLowerCase();
                var tableRows = document.querySelectorAll("tbody tr");

                for (var i = 0; i < tableRows.length; i++) {
                    var itemCell = tableRows[i].getElementsByTagName("td")[0];
                    if (itemCell) {
                        var itemText = itemCell.textContent || itemCell.innerText;
                        if (itemText.toLowerCase().includes(searchValue)) {
                            tableRows[i].style.display = "";
                        } else {
                            tableRows[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
    </body>
</html>

    
