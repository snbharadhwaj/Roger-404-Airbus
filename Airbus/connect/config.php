<?php

//     $host = 'airbus555.mysql.database.azure.com'; 
//     $username = 'admin555 ';
//     $password = 'Airbus@555';
//     $db_name = 'airbus';

//     $conn = mysqli_init();

//     mysqli_ssl_set($conn,NULL,NULL,'./DigiCertGlobalRootCA.crt.pem',NULL,NULL);

//     mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306,MYSQLI_CLIENT_SSL);
//     if (mysqli_connect_errno()) {
//     die('Failed to connect to MySQL: '.mysqli_connect_error());
// }

$servername = "localhost:3306";
$username = "root";
$password = "";
$database ="airbus";


$conn = mysqli_connect($servername, $username, $password, $database);

if($conn == false){
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}


?>
