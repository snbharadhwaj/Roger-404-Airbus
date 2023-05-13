<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $material = $_POST['material'];
    $quantity = $_POST['quantity'];
    $inDate = $_POST['in_date'];
    $outDate = $_POST['out_date'];
    
    include_once('config.php'); 
    $lastItemId = '';
    
    // Retrieve the last item_id with the prefix 'T104'
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
    
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Fabricator details added successfully');
        window.location='Fabricator_Insert.php';</script>";
        die;
    } else {
        echo "<script type='text/javascript'>alert('Error in inserting details');
        window.location='Fabricator_Insert.php';</script>";
        die;
    }
    
    mysqli_close($conn); 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Item</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
		<h5 class="my-0 mr-md-auto font-weight-normal">Washing Machine Management</h5>
		<nav class="my-2 my-md-0 mr-md-3">
			<a class="p-2 text-dark" href="Fabricator_dashboard.php">Dashboard</a>
			<a class="p-2 text-dark" href="Fabricator_Insert.php">Insert Item</a>
			<a class="p-2 text-dark" href="logout.php">Logout</a>
		</nav>
	</div>
	<div class="container">
		<h2>Insert Item</h2>
		<form method="POST">
			<div class="form-group">
				<label for="item">Item:</label>
				<select class="form-control" id="item" name="item" onchange="dropdownMaterials(this.options[this.selectedIndex].value)">                    
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
				<input type="text" class="form-control" id="quantity" name="quantity" readonly>
			</div>
			<div class="form-group">
				<label for="in_date">Start Date:</label>
				<input type="date" class="form-control" id="in_date" name="in_date" required>
			</div>
            <div class="form-group">
				<label for="out_date">End Date:</label>
				<input type="date" class="form-control" id="out_date" name="out_date" required>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<script>
var fabrication=[
        {
            "item": "tub",
            "item id": "T101",
            "raw_material": "sheet steel",
            "Quantity": "10 sqft",
            "in date": "14/02/2020",
            "out date": "21/02/2020"
        },
        {
            "item": "pump",
            "item id": "T102",
            "raw_material": "plastics",
            "Quantity": "10 kg",
            "in date": "16/02/2020",
            "out date": "20/02/2020"
        },
        {
            "item": "spin tub",
            "item id": "T103",
            "raw_material": "stainless steel",
            "Quantity": "5 kg/m3",
            "in date": "27/02/2020",
            "out date": "5/3/2020"
        },
        {
            "item": "wash tub",
            "item id": "T104",
            "raw_material": "(enameling iron) Porcelain coating",
            "Quantity": "24 gauge",
            "in date": "27/02/2020",
            "out date": "3/2/2020"
        },
        {
            "item": "balance ring",
            "item id": "T105",
            "raw_material": "plastics",
            "Quantity": "3 kg ",
            "in date": "16/03/2020",
            "out date": "21/03/2020"
        },
        {
            "item": "transmission gears",
            "item id": "T107",
            "raw_material": "cast aluminum",
            "Quantity": "ingots—20",
            "in date": "26/03/2020",
            "out date": "9/4/2020"
        },
        {
            "item": "plastic brackets",
            "item id": "T108",
            "raw_material": "plastics",
            "Quantity": "2 kg",
            "in date": "8/4/2020",
            "out date": "12/4/2020"
        },
        {
            "item": "tub",
            "item id": "T109",
            "raw_material": "sheet steel",
            "Quantity": "10 sqft",
            "in date": "14/02/2020",
            "out date": "21/02/2020"
        },
        {
            "item": "pump",
            "item id": "T110",
            "raw_material": "plastics",
            "Quantity": "10 kg",
            "in date": "16/02/2020",
            "out date": "20/02/2020"
        },
        {
            "item": "spin tub",
            "item id": "T111",
            "raw_material": "steel (enameling iron) Porcelain coating",
            "Quantity": "5 kg/m3",
            "in date": "27/02/2020",
            "out date": "5/3/2020"
        },
        {
            "item": "wash tub",
            "item id": "T112",
            "raw_material": "(enameling iron) Porcelain coating",
            "Quantity": "24 gauge",
            "in date": "27/02/2020",
            "out date": "3/2/2020"
        },
        {
            "item": "balance ring",
            "item id": "T113",
            "raw_material": "stainless steel",
            "Quantity": "2 kg/m3 ",
            "in date": "16/03/2020",
            "out date": "21/03/2020"
        },
        {
            "item": "transmission gears",
            "item id": "T115",
            "raw_material": "cast aluminum",
            "Quantity": "ingots—20",
            "in date": "26/03/2020",
            "out date": "9/4/2020"
        },
        {
            "item": "plastic brackets",
            "item id": "T116",
            "raw_material": " plastic",
            "Quantity": " 2 kg",
            "in date": "8/4/2020",
            "out date": "12/4/2020"
        },
        {
            "item": "tub",
            "item id": "T124",
            "raw_material": "sheet steel",
            "Quantity": "10 sqft",
            "in date": "14/02/2020",
            "out date": "21/02/2020"
        },
        {
            "item": "pump",
            "item id": "T117",
            "raw_material": "plastics",
            "Quantity": "10 kg",
            "in date": "16/02/2020",
            "out date": "20/02/2020"
        },
        {
            "item": "spin tub",
            "item id": "T118",
            "raw_material": "stainless steel",
            "Quantity": "5 kg/m3",
            "in date": "27/02/2020",
            "out date": "5/3/2020"
        },
        {
            "item": "wash tub",
            "item id": "T119",
            "raw_material": "(enameling iron) Porcelain coating",
            "Quantity": "24 gauge",
            "in date": "27/02/2020",
            "out date": "3/2/2020"
        },
        {
            "item": "balance ring",
            "item id": "T120",
            "raw_material": "porcelain enamel",
            "Quantity": "8 gauge",
            "in date": "16/03/2020",
            "out date": "21/03/2020"
        },
        {
            "item": "transmission gears",
            "item id": "T122",
            "raw_material": "cast aluminum",
            "Quantity": "ingots—20",
            "in date": "26/03/2020",
            "out date": "9/4/2020"
        },
        {
            "item": "plastic brackets",
            "item id": "T123",
            "raw_material": "plastics",
            "Quantity": "3 kg",
            "in date": "8/4/2020",
            "out date": "12/4/2020"
        },
        {
            "item": "tub",
            "item id": "T124",
            "raw_material": "sheet steel",
            "Quantity": "10 sqft",
            "in date": "14/02/2020",
            "out date": "12/3/2020"
        },
        {
            "item": "spin tub",
            "item id": "T125",
            "raw_material": "stainless steel",
            "Quantity": "5 kg/m3",
            "in date": "27/02/2020",
            "out date": "5/3/2020"
        },
        {
            "item": "wash tub",
            "item id": "T126",
            "raw_material": "(enameling iron) Porcelain coating",
            "Quantity": "24 gauge",
            "in date": "27/02/2020",
            "out date": "3/2/2020"
        },
        {
            "item": "balance ring",
            "item id": "T127",
            "raw_material": "porcelain enamel",
            "Quantity": "8 gauge",
            "in date": "16/03/2020",
            "out date": "21/03/2020"
        },
        {
            "item": "transmission gears",
            "item id": "T128",
            "raw_material": "cast aluminum",
            "Quantity": "ingots—20",
            "in date": "26/03/2020",
            "out date": "9/4/2020"
        },
        {
            "item": "plastic brackets",
            "item id": "T129",
            "raw_material": "plastics",
            "Quantity": "3 kg",
            "in date": "8/4/2020",
            "out date": "12/4/2020"
        },
        {
            "item": "tub",
            "item id": "T130",
            "raw_material": "sheet steel",
            "Quantity": "10 sqft",
            "in date": "14/02/2020",
            "out date": "12/3/2020"
        }
    ]

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
</body>
</html>