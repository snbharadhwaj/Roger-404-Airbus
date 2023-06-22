<!DOCTYPE html>
<html>
<head>
    <title>Item Dashboard</title>
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
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="Fabricator_dashboard.php">FABRICATION DEPARTMENT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Fabricator_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Fabricator_Insert.php">Insert Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    include_once('../connect/config.php');
                    $dept_id = $_SESSION['ID'];
                    $sql = "SELECT * FROM fabrication WHERE Dept_No = ? AND item_id NOT LIKE 'WM%'";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $dept_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . ucwords(htmlspecialchars($row["item"])) . "</td>";
                            echo "<td>" . ucwords(htmlspecialchars($row["raw_material"])) . "</td>";                            
                            echo "<td>" . htmlspecialchars($row["Quantity"]) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime(htmlspecialchars($row["in_date"]))) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime(htmlspecialchars($row["out_date"]))) . "</td>";
                            if ($row["Approval"] == 1) {
                                echo "<td>" . "Approved" . "</td>";
                            } else {
                                echo "<td>";
                                echo "<a href='update_page_fab.php?item_id=" . htmlspecialchars($row["item_id"]) . "' class='btn btn-primary btn-sm'>Update</a>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    }
                    mysqli_stmt_close($stmt);
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
