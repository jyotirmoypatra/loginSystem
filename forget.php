<?php 
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container ">
        <div class="reset">
            
            <h2 class="text-primary pb-3">Reset Password</h2>
            
            <form action="" method="POST">
                <div class="form-group">
                    <i class="fa fa-user icon bg-primary"></i>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email"
                         required>
                        
                </div>
                
                
                <button type="submit" class="btn bg-primary " name="reset">Submit</button> <br>
                <div class="link">
            
            <a id="btn2" class="user text-primary font-weight-bold" href="login.php">Existing User? Login </a>
         </div>

            </form>
        </div>
     

    </div>
</body>
</html>

<?php

include "db.php";

if(isset($_POST['reset'])){
  
  
    $email =$_POST['email'];

  $check="select * from email_verify where  Email='$email'  && Status='active' ";
    $checkquery=mysqli_query($con,$check);
     $email_count=mysqli_num_rows($checkquery);
     if($email_count)
    {
      $email_pass= mysqli_fetch_assoc($checkquery);
      $token=$email_pass['Token'];
      $name = $email_pass['Name'];


      $subject = "Reset Password";
        $body = "Hi,$name. Click here to Reset your account Password
        http://localhost/emailverify/reset.php?Token=$token";
        $sender_email = "From: jyotirmoypatra1@gmail.com";
        
        if (mail($email, $subject, $body, $sender_email)) {
          $_SESSION['msg']=" Reset Password link send to $email";
          header('location:login.php');
          
        } else {
            echo "Email sending failed...";
        }

    }  else{
        
            ?>
            <script>
            alert("Email not found!");
            </script>
            <?php
    }
}

?>