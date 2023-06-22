<?php
    session_start();
    include_once('../connect/config.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $item = $_POST['item'];
        $material = $_POST['material'];
        $quantity = $_POST['quantity'];
        $inDate = $_POST['in_date'];
        $outDate = $_POST['out_date'];

        if (strtotime($outDate) <= strtotime($inDate)) {
            echo "<script type='text/javascript'>alert('End date must be greater than start date.');
            window.location='Fabricator_Insert.php';</script>";
            die;
        }

        $lastItemId = '';
        $lastItemQuery = "SELECT item_id FROM fabrication WHERE item_id LIKE 'T%' ORDER BY item_id DESC LIMIT 1";
        $lastItemResult = mysqli_query($conn, $lastItemQuery);
        
        if ($lastItemResult && mysqli_num_rows($lastItemResult) > 0) {
            $lastItemRow = mysqli_fetch_assoc($lastItemResult);
            $lastItemId = $lastItemRow['item_id'];
        }
        
        $newItemId = '';
        if (!empty($lastItemId)) {
            $lastValue = substr($lastItemId, 1); 
            $newItemValue = intval($lastValue) + 1; 
            $newItemId = 'T' . $newItemValue; 
        } else {
            $newItemId = 'T1'; // If no previous item_id found, set the initial value
        }
        
        $sql = "INSERT INTO fabrication (item, item_id, raw_material, Quantity, in_date, out_date) VALUES ('$item', '$newItemId', '$material', '$quantity', '$inDate', '$outDate')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script type='text/javascript'>alert('Fabrication Item is created.');
            window.location='Fabricator_Insert.php';</script>";
            die;
        }
        else{
            echo "<script type='text/javascript'>alert('Error in creating Fabrication item.');
            window.location='Fabricator_Insert.php';</script>";
            die;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Build Item - Fabrication</title>
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

    <div class="container d-flex flex-column align-items-center cont">
        <div class="card" >
            <div class="card-body d-flex flex-column align-items-center">
                <h2 class="card-title" >Insert Item</h2>
                <form method="POST" id="myForm" class="w-75">
                    <div class="form-group">
                        <label for="item">Item:</label>
                        <select class="form-control" id="item" name="item" onchange="dropdownMaterials(this.options[this.selectedIndex].value)">
                            <!-- Options here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="material">Material:</label>
                        <select class="form-control" id="material" name="material" onchange="updateQuantity()">
                            <option>Choose material</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="text" class="form-control form-control-sm" id="quantity" name="quantity" readonly>
                    </div>
                    <div class="form-group">
                        <label for="in_date">Start Date:</label>
                        <input type="date" class="form-control form-control-sm" id="in_date" style="width: 200px;" name="in_date" required>
                    </div>
                    <div class="form-group">
                        <label for="out_date">End Date:</label>
                        <input type="date" class="form-control form-control-sm" id="out_date" style="width: 200px;" name="out_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary px-3 m-1">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/items.js"></script>
    <script>
    function getOptions(list){
    let string ="";
    let index = 0;
    list.forEach(element => {
        string += `<option value="${element}">${element}</option>`;
    });
    return string;
    }
    function dropdownItems()
    {
        var all_items=[];
        fabrication.map(function(params)
        {  
            all_items.push(params.item);
        })
        all_items = all_items.filter((item,index) => all_items.indexOf(item) === index);
        document.getElementById("item").innerHTML = getOptions(all_items);

        dropdownMaterials(all_items[0]);
    }

    function dropdownMaterials(item){
        let Materials = getMaterials(item);
        document.getElementById("material").innerHTML = getOptions(Materials);
        updateQuantity();
    }

    function getMaterials(itemName)
    {
        var array=[];
        fabrication.map(function(params){
        if(params.item == itemName)
        {

            array.push(params.raw_material);
        }
        })
        return array.filter((item,index) => array.indexOf(item) === index);
    }

    function updateQuantity()
    {
        var theQuantity;
        let itemName = document.getElementById("item").value;
        let materialName = document.getElementById("material").value;
        let quantity = document.getElementById("quantity");
        console.log(materialName);
        quantity.value="hhh";
        fabrication.map(function(params){
        if(params.item == itemName && params.raw_material== materialName)
        {
            theQuantity=params.Quantity;
        }
        })
        quantity.value=theQuantity;
    }

    dropdownItems();
    </script>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("in_date").setAttribute('min', today);
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault(); // prevent form submission
                var form = this;
                console.log('Form submitted');
                var item = $('#item').val();
                var material = $('#material').val();
                var quantity = $('#quantity').val();
                var in_date = $('#in_date').val();
                var out_date = $('#out_date').val();
                console.log(item);
                console.log(item);

                $.ajax({
                    url: 'check_item.php',
                    type: 'POST',
                    data: { item: item, material: material, quantity: quantity, in_date: in_date, out_date: out_date },
                    success: function(response) {
                        console.log(response);
                        console.log(response.message);
                        console.log(response.charAt(11));

                        if (response.charAt(11) == "t") {
                            console.log("Okkkay");
                            var confirmMsg = confirm("Item already exists. Do you want to continue?");
                            if (confirmMsg) {
                                console.log("Okay");
                                form.submit();
                            }
                        } else {
                            console.log("Nope");
                            form.submit();
                        }
                    }
                });
            });
        });
    </script>
 </body>
</html>