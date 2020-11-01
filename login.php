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
        <div class="Login">
            
            <h1 class="">Login</h1>
             
            <?php 
            if(isset($_SESSION['msg'])){
                ?>
                <p class="bg-success text-white p-2 "> <?php echo $_SESSION['msg']; ?> </p> <?php
            }
            ?> 
            <form action="login.php" method="POST"> 
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email"
                         required>
                        
                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    
                     <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" 
                       required>
                </div>
                <div class="form-check">
                   <input class="form-check-input" type="checkbox" name="remember" id="gridCheck" >
                   <label class="form-check-label text-warning" for="gridCheck">  Remember me </label>
                </div>

                <button type="submit" class="btn " name="login">Login</button> <br>

                <div class="link">
                <a  class="user font-weight-bold" href="forget.php">forget password?</a> <br>
                <a id="btn1" class="user font-weight-bold" href="registration.php">New User? Create a account </a>
            
             </div>

            </form>
        </div>
     

    </div>

    <script src="main.js"></script>
</body>

</html>

<?php

include "db.php";

if(isset($_SESSION["username"]))
{
 header("location:home.php");
}
if(isset($_POST['login'])){
  
  
    $email =$_POST['email'];
   $password =$_POST['password'];

    
     

    //account activation check
    $login="select * from email_verify where  Email='$email'  && Status='active' ";
    $loginquery=mysqli_query($con,$login);
     $email_count=mysqli_num_rows($loginquery);
    if($email_count)
    {
      $email_pass= mysqli_fetch_assoc($loginquery);
      $db_pass=$email_pass['Password'];
      $_SESSION['username']=$email_pass['Name'];
     // $pass_decode = password_verify($password,$db_pass);


      if($db_pass === md5($password) )
      {
        if(isset($_POST["remember"]))   
        {  
         setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
         setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
         $_SESSION["username"] = $email_pass['Name'];
         
        }else  
        {  
         if(isset($_COOKIE["email"]))   
         {  
          setcookie ("email","");  
         }  
         if(isset($_COOKIE["password"]))   
         {  
          setcookie ("password","");  
         }  
        }
        $_SESSION["username"] = $email_pass['Name'];
        header("Location: home.php");


      }else{
          ?>
          <script>
          alert("Wrong  Password !!");
          </script>
          <?php
      }
    }else{
        ?>
          <script>
          alert("Please verify your Email");
          </script>
        <?php
    } 

 

}   

?>
