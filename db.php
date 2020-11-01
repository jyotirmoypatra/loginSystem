<?php 

$server = "localhost";
$username = "root";
$password = "";
$db = "user_registration";

$con = mysqli_connect($server,$username ,$password,$db);

if ($con->connect_error) {  
    die("Connection failed: " . $db->connect_error);  
} 

?>