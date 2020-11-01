<?php 
 session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">
        
        <div class="create_pass">
            <h1>Create Password</h1>
            <form action="" method="POST">
                
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder=" Enter Password" required>
                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1" placeholder=" Confirm Password" required>
                </div>

                <button type="submit" name="submit" class="btn ">Update Password</button> <br>
               
                <div class="link">
            
                 <a id="btn2" class="user font-weight-bold" href="login.php">Existing User? Login </a>
              </div>
            </form>
        </div>
        

    </div>

    <script src="main.js"></script>
</body>

</html>

<?php

include "db.php";

if(isset($_POST['submit']))
{
    if(isset($_GET['Token'])){
        $token =$_GET['Token'];
 
   $newpassword =md5(mysqli_real_escape_string( $con,$_POST['password']));
   $cpassword =md5(mysqli_real_escape_string( $con,$_POST['cpassword']));
  
    if($newpassword === $cpassword) {

      $updatequery= "update email_verify set Password='$newpassword' where Token='$token' ";
       $query=mysqli_query($con,$updatequery);
  
     if($query){
       
        $_SESSION['msg']="Password Reset Successfully";
        header('location:login.php');
        
      } else {
        ?>
        <script>
            alert("password Reset Failed!")
            
        </script>
        
        <?php
      }
    } else {
        ?>
          <script>
              alert("password not match")
              
          </script>
          
          <?php
    }
    
 }
}
  

?>