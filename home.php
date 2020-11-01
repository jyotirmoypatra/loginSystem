<?php
session_start();

//check cookie for auto login
if(!isset($_SESSION['username'])){
  
  include_once 'autologin.php';
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container text-center">
    <h1 class="text-success ">Welcome  <?php echo $_SESSION['username']; ?> </h1>
    <a href="logout.php" class="">Logout</a>
    </div>
</body>
</html>