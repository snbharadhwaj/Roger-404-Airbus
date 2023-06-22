<?php
session_start();
include_once('../connect/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assemblyName = $_POST['assembly_name'];
    $itemId= $_POST['item_id'];
    $endDate = $_POST['end_date'];
    $startDate = $_POST['new_date'];

    if (strtotime($endDate) <= strtotime($startDate)) {
        echo "<script type='text/javascript'>alert('End date must be greater than start date.');
        window.location='Subassembly_Build.php';</script>";
        die;
    }

    $sql = "UPDATE fabrication SET Approval = 1 WHERE item_id = '$itemId'";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT Assembly_ID, Machine_ID FROM Sub_Assembly ORDER BY Assembly_ID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastAssemblyId = $row['Assembly_ID'];
        $lastMachineId = $row['Machine_ID'];
        $lastAssemblyNumber = intval(substr($lastAssemblyId, -4));
        $lastMachineNumber = intval(substr($lastMachineId, -3));
        $newAssemblyNumber = $lastAssemblyNumber + 1;
        $newMachineNumber = $lastMachineNumber + 1;
        $newAssemblyId = substr($lastAssemblyId, 0, -4) . str_pad($newAssemblyNumber, 4, '0', STR_PAD_LEFT);
        $newMachineId = substr($lastMachineId, 0, -3) . str_pad($newMachineNumber, 3, '0', STR_PAD_LEFT);
    } else {
        $newAssemblyId = "SAWM0001"; 
        $newMachineId = "FA_WM001"; 
    }

    $sql = "INSERT INTO Sub_Assembly (Assembly_ID, process, Item_ID, Machine_ID, start_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssssss", $newAssemblyId, $assemblyName, $itemId, $newMachineId, $startDate, $endDate);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo "<script type='text/javascript'>alert('Sub-Assembly created successfully');
    window.location='Subassembly_Build.php';</script>";
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Build Sub-Assembly</title>
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
    .card {
        width:800px;
        background-color:darkslategrey;
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 10px;
        margin-bottom: 10px;
    }
    .card h2 {
        padding: 0;
        color: #fff;
        text-align: center;
    }
    .form-group{
        color: #fff;
        font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .cont{
        animation: fade-in 1s ease-in-out;
    }
    @keyframes fade-in {
        0% {opacity: 0;}
        100% {opacity: 1;}
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="Sub_Assembly_dashboard.php">SUB-ASSEMBLY DEPARTMENT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Sub_Assembly_dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Subassembly_Build.php">Build Sub-Assembly</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container d-flex flex-column align-items-center cont">
        <div class="card">
            <div class="card-body d-flex flex-column align-items-center">
                <h2 class="card-title">Build Sub-Assembly</h2>
                <form method="POST" id="myForm" class="w-75">
                    <div class="form-group">
                        <label for="assembly_name">Sub-Assembly Name:</label>
                        <input type="text" class="form-control" id="assembly_name" name="assembly_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="item_name">Select an Item:</label>
                        <select class="form-control" id="item_name" name="item_name" required>
                            <?php
                            $sql = "SELECT DISTINCT item_id,item,raw_material,Quantity FROM fabrication WHERE Approval = 0 and out_date < NOW()";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $item_id = $row['item_id'];
                                    $itemName = $row['item'];
                                    $rawMaterial = $row['raw_material'];
                                    $quantity = $row['Quantity'];
                                    echo "<option value='" . $itemName . "' data_item_id='" . $item_id . "' data-quantity='" . $quantity . "'>" . ucwords($itemName) . " (Raw Material: " . ucwords($rawMaterial) . ", Quantity: " . ucwords($quantity) . ")</option>";
                                }
                            }
                            mysqli_close($conn);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="new_date">Start Date:</label>
                        <input type="date" class="form-control" id="new_date" style="width: 200px;" name="new_date" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" class="form-control" id="end_date" style="width: 200px;" name="end_date" required>
                    </div>
                    <input type="hidden" id="item_id" name="item_id">
                    <button type="submit" class="btn btn-primary px-3 m-1">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("item_name").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById("item_id").value = selectedOption.getAttribute("data_item_id");
        });
    </script>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("new_date").setAttribute('min', today);
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault(); // prevent form submission
                var form = this;
                var assembly_name = $('#assembly_name').val();
                var item_id = $('#item_id').val();
                var item_name = $('#item_name').val();
                var new_date = $('#new_date').val();
                var end_date = $('#end_date').val();

                $.ajax({
                    url: 'check_subassembly.php',
                    type: 'POST',
                    data: { assembly_name: assembly_name, item_name: item_name, item_id:item_id, new_date: new_date,end_date: end_date },
                    success: function(response) {
                        if (response.charAt(11) == "t") {
                            var confirmMsg = confirm("Sub-Assembly already exists. Do you want to continue?");
                            if (confirmMsg) {
                                form.submit();
                            }
                        } else {
                            form.submit();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
