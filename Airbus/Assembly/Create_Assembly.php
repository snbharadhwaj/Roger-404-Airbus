<?php
session_start();
include_once('../connect/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assemblyName = $_POST['assembly_name'];
    $sub_assID_1 = $_POST['sub_assID_1'];
    $sub_assID_2= $_POST['sub_assID_2'];
    $startDate = $_POST['new_date'];
    $endDate = $_POST['end_date'];

    if (strtotime($endDate) <= strtotime($startDate)) {
        echo "<script type='text/javascript'>alert('End date must be greater than start date.');
        window.location='Subassembly_Build.php';</script>";
        die;
    }

    $sql = "SELECT Machine_ID FROM assembly ORDER BY Machine_ID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastMachineId = $row['Machine_ID'];
        // Extract the last 7 digits
        $lastDigits = substr($lastMachineId, -7);    
        // Increment the last digits by 1
        $newDigits = intval($lastDigits) + 1;
        // Create the new machine ID with the incremented digits
        $newMachineId = substr($lastMachineId, 0, -7) . str_pad($newDigits, 7, '0', STR_PAD_LEFT);
    } else {
        $newMachineId = "MAII0000001";
    } 
    
    $sql = "SELECT Machine_ID FROM sub_assembly WHERE Assembly_ID = '$sub_assID_2'";
    $result = mysqli_query($conn,$sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $MachineID = $row['Machine_ID'];
    } else {
        $MachineID = "FA_WM999";
    } 
    $Process_ID = $sub_assID_1 . '_' . $MachineID;

    $sql = "INSERT INTO assembly (process, Process_ID, Machine_ID, Start_Date, END_Date)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssss", $assemblyName, $Process_ID, $newMachineId, $startDate,$endDate);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo "<script type='text/javascript'>alert('Assembly created successfully');
    window.location='Create_Assembly.php';</script>";
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Build Assembly</title>
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

    <div class="container d-flex flex-column align-items-center cont">
        <div class="card">
            <div class="card-body d-flex flex-column align-items-center">
                <h2 class="card-title">Build Assembly</h2>
                <form method="POST" id="myForm" class="w-75">
                    <div class="form-group">
                        <label for="assembly_name">Assembly Name:</label>
                        <input type="text" class="form-control" id="assembly_name" name="assembly_name" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_assembly">Select a Sub-Assembly:</label>
                        <select class="form-control" id="sub_assembly" name="sub_assembly" required>
                            <?php
                                $sql = "SELECT DISTINCT Assembly_ID,process,start_date,end_date FROM sub_assembly WHERE Approval = 0 and end_date < NOW()";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $sub_assID = $row['Assembly_ID'];
                                        $process = ucwords($row['process']);
                                        $in_date = date('d-m-Y', strtotime($row["start_date"]));
                                        $out_date = date('d-m-Y', strtotime($row["end_date"]));
                                        echo "<option value='" . $process . "' sub_in_date='" . $in_date . "' sub_out_date='" . $out_date . "' assembly_id='" . $sub_assID . "' machine_id='" . $machine_ID . "'>" . $process . " (Start_Date: " . $in_date . ", End_Date: " . $out_date . ")</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_assembly_other">Select a Sub-Assembly:</label>
                        <select class="form-control" id="sub_assembly_other" name="sub_assembly_other" disabled>
                            <?php
                                $sql = "SELECT DISTINCT Assembly_ID,process,start_date,end_date FROM sub_assembly WHERE Approval = 0 and end_date < NOW()";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $sub_assID = $row['Assembly_ID'];
                                        $process = $row['process'];
                                        $in_date = date('Y-m-d', strtotime($row["start_date"]));
                                        $out_date = date('Y-m-d', strtotime($row["end_date"]));
                                        echo "<option value='" . $process . "' sub_in_date='" . $in_date . "' sub_out_date='" . $out_date . "' assembly_id='" . $sub_assID . "' machine_id='" . $machine_ID . "'>" . $process . " (Start_Date: " . $in_date . ", End_Date: " . $out_date . ")</option>";
                                    }
                                }
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

                    <input type="hidden" id="sub_assID_1" name="sub_assID_1">
                    <input type="hidden" id="sub_assID_2" name="sub_assID_2">

                    <button type="submit" class="btn btn-primary px-3 m-1">Create</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("sub_assembly").addEventListener("change", function() {
            var selectedOption1 = this.options[this.selectedIndex];
            var subAssemblyOtherDropdown = document.getElementById("sub_assembly_other");
            subAssemblyOtherDropdown.disabled = false;
            var selectedOptionValue = selectedOption1.value;
            Array.from(subAssemblyOtherDropdown.options).forEach(function(option) {
                if (option.value === selectedOptionValue) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });
            document.getElementById("sub_assID_1").value = selectedOption1.getAttribute("assembly_id");
        });
        document.getElementById("sub_assembly_other").addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            document.getElementById("sub_assID_2").value = selectedOption.getAttribute("assembly_id");
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
                var sub_assembly = $('#sub_assembly').val();
                var sub_assembly_other = $('#sub_assembly_other').val();
                var new_date = $('#new_date').val();
                var end_date = $('#end_date').val();
                var sub_assID_1 = $('#sub_assID_1').val();
                var sub_assID_2 = $('#sub_assID_2').val();

                $.ajax({
                    url: 'check_assembly.php',
                    type: 'POST',
                    data: { assembly_name: assembly_name, sub_assembly: sub_assembly, sub_assembly_other:sub_assembly_other, 
                            new_date: new_date,end_date: end_date, sub_assID_1: sub_assID_1, sub_assID_2: sub_assID_2 },
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

