<?php

session_start();
unset($_SESSION["username"]);
setcookie ("email","");  
setcookie ("password","");  
session_destroy();
header("Location: login.php");

?>