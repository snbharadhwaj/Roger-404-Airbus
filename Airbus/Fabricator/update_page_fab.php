<?php
    session_start();
    include_once('../connect/config.php');
    if (isset($_GET['item_id'])) {
        $item_id = $_GET['item_id'];
    } else {
        header("Location: Fabricator_dashboard.php");
        exit();
    }
    $dept_id  = $_SESSION['ID'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update date - Fabrication</title>
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
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault(); 
                var formData = $(this).serialize(); 
                var item_id = '<?php echo $item_id; ?>';
                formData += '&item_id=' + item_id;
                
                $.ajax({
                    type: 'POST',
                    url: 'updates_date_value.php',
                    data: formData,
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
            });
        });
    </script>
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

    <div class="container">
        <main role="main" class="container cont" style="background-color:darkslategrey;">
            <h2 style="color: white;" class="d-flex justify-content-center m-3 p-2">Dashboard</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Item Name</th>
                            <th>Raw Material</th>
                            <th>Quantity</th>
                            <th>In Date</th>
                            <th>Out Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Ensure that the item_id is properly sanitized
                        $item_id = mysqli_real_escape_string($conn, $_GET['item_id']);

                        // Prepare the SQL query using prepared statements
                        $sql = "SELECT * FROM fabrication WHERE item_id=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, 's', $item_id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        // Check if any rows were returned
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $item = htmlentities(ucwords($row["item"]));
                                $raw_material = htmlentities(ucwords($row["raw_material"]));
                                $quantity = htmlentities($row["Quantity"]);
                                $in_date = htmlentities(date('d-m-Y', strtotime($row["in_date"])));
                                $min_date = date('Y-m-d', strtotime($row["in_date"] . ' + 1 day'));
                                $out_date = htmlentities(date('d-m-Y', strtotime($row["out_date"])));
                                echo "<tr>";
                                echo "<td>" . $item . "</td>";
                                echo "<td>" . $raw_material . "</td>";
                                echo "<td>" . $quantity . "</td>";
                                echo "<td>" . $in_date . "</td>";
                                echo "<td>" . $out_date . "</td>";
                                echo "</tr>";
                            }
                        }

                        // Close the database connection and the prepared statement
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="d-flex justify-content-center m-4" >
            <div class="card" style="width: 300px; background-color:darkslategrey;" >
                <div class="card-body">
                    <h5 class="card-title" style="color: white;">Update Out Date</h5>
                    <form method="post">
                        <div class="form-group">
                            <input type="date" class="form-control" id="end_date" name="end_date" min="<?php echo $min_date; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
