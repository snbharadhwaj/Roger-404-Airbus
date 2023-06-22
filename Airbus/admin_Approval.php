<!DOCTYPE html>
<html>
<head>
    <title>Admin - Approve Assembly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <script>
        function approveData(machineId) {
            $.ajax({
                url: 'update_supply_chain_data.php',
                method: 'POST',
                data: { machineId: machineId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred during the AJAX request.');
                }
            });
        }
    </script>
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
    <br><br>

    <main role="main" class="container cont" style="background-color:darkslategrey;">
        <h2 style="color: white;" class="d-flex justify-content-center m-3 p-2">Assembly Dashboard</h2>
        <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Assembly" id="searchInput" onkeyup="searchItems()">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
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
                    session_start();
                    include_once('connect/config.php');
                    //$sql = "SELECT DISTINCT a.process, a.Machine_ID ,a.Start_Date ,a.END_Date FROM assembly a LEFT JOIN supply_chain_data s ON a.Machine_ID = s.Machine_ID AND a.Approval=0 ";
                    $sql = "SELECT process,Machine_ID,Start_Date,END_Date FROM assembly WHERE Approval=0";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . ucwords($row['process']) . "</td>";
                            echo "<td>" . $row['Machine_ID'] . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["Start_Date"])) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["END_Date"])) . "</td>";
                            echo "<td><button class='btn btn-primary btn-sm' onclick='approveData(\"" . $row['Machine_ID'] . "\")'>Approve</button></td>";
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
    </main>
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
