<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "cr11_petadoption_abdulla";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
/*} else {
    echo "Successfully Connected";*/
}