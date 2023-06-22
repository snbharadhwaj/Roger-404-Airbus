<?php
    session_start();
    include_once('../connect/config.php');
    if (isset($_GET['Machine_ID'])) {
        $mach_id = $_GET['Machine_ID'];
    } else {
        header("Location: Assembly_dashboard.php");
        exit();
    }
    $dept_id  = $_SESSION['ID'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Date - Assembly</title>
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
                var mach_id = '<?php echo $mach_id; ?>';
                formData += '&mach_id=' + mach_id;
                
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
            <a class="navbar-brand" href="Assembly_dashboard.php">ASSEMBLY DEPARTMENT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Assembly_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Create_Assembly.php">Build Assembly</a>
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
                            <th>Machine ID</th>
                            <th>Process</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $dept_id  = $_SESSION['ID'];
                        $sql = "SELECT * FROM assembly WHERE Machine_ID='$mach_id'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $min_date = date('Y-m-d', strtotime($row["Start_Date"] . ' + 1 day'));
                                echo "<tr>";
                                echo "<td>" . $row["Machine_ID"] . "</td>";
                                echo "<td>" . ucwords($row["process"]) . "</td>";
                                echo "<td>" . date('d-m-Y', strtotime($row["Start_Date"])) . "</td>";
                                echo "<td>" . date('d-m-Y', strtotime($row["END_Date"])) . "</td>";
                                echo "</tr>";
                            }
                        }
                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="d-flex justify-content-center m-4">
            <div class="card" style="width: 300px;background-color:darkslategrey;">
                <div class="card-body">
                    <h5 class="card-title" style="color:white">Update Out Date</h5>
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
