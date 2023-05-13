<?php
$servername = "localhost:3306";
$username = "root";
$password = "jackson";
$database ="airbus";


$conn = mysqli_connect($servername, $username, $password, $database);

if($conn == false){
    dir('Error: Cannot connect');
}
?>
