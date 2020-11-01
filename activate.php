<?php

session_start();

include "db.php";

if(isset($_GET['Token'])){
    $token =$_GET['Token'];
    $updatequery="update email_verify set Status='active' where Token='$token'";

    $query= mysqli_query($con,$updatequery);

    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg']="Account activated Successfully";
            header('location:login.php');
        }else{
            $_SESSION['msg']="You are logged out";
            header('location:login.php');
        }
    }else{
        $_SESSION['msg']="Account not activated";
        header('location:registration.php');
    }
}

?>