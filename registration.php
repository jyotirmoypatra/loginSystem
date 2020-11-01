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
        
        <div class="Registration">
            <h1>Registration</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <input type="text" class="form-control" name="name" id="exampleInputPassword1" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <i class="fa fa-envelope icon"></i>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email" required>
                    
                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder=" Enter Password" required>
                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1" placeholder=" Confirm Password" required>
                </div>

                <button type="submit" name="submit" class="btn ">Create account</button> <br>
               
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

if(isset($_POST['submit'])){
  
 
  
    $name =mysqli_real_escape_string($con, $_POST['name']);
    $email =mysqli_real_escape_string( $con,$_POST['email']);
   $password =md5(mysqli_real_escape_string( $con,$_POST['password']));
   $cpassword =md5(mysqli_real_escape_string( $con,$_POST['cpassword']));
   $token = bin2hex(random_bytes(15)) ;  

    $duplicate="select * from email_verify where  Email='$email' ";
    $duplicatequery=mysqli_query($con,$duplicate);
    if(mysqli_num_rows($duplicatequery)>0)
    {
      // header("Location: index.php?message=User name or Email id already exists.");
      ?>
      <script>
      alert("Same email exist in database!!!")
      </script>
      <?php
    } else {

    if($password === $cpassword) {

    
    $insertquery = "insert into email_verify (Name,Email,Password,Cpassword,Token,Status) 
                values('$name','$email','$password','$cpassword','$token','inactive')";
  
  
    $query=mysqli_query($con,$insertquery);
  
    if($query){
       
    //email verify code
       
        $subject = "Account Accivation";
        $body = "Hi,$name. Click here to active your account
        http://localhost/emailverify/activate.php?Token=$token";
        $sender_email = "From: jyotirmoypatra1@gmail.com";
        
        if (mail($email, $subject, $body, $sender_email)) {
          $_SESSION['msg']="check your mail to activate your account  $email";
          header('location:login.php');
        } else {
            echo "Email sending failed...";
        }
     
        
      } else {
          ?>
          <script>
              alert("Not inserted")
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