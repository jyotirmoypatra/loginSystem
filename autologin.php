<?php
    include "db.php";
	// Check if the cookie exists
if(isSet($_COOKIE["email"]) && isSet($_COOKIE["password"]) )
	{

		$user=$_COOKIE["email"];
		$pass=md5($_COOKIE["password"]);
        
        $cookielogin="select * from email_verify where  Email='$user'  && Password='$pass' ";
       
        $cookie_login_query=mysqli_query($con,$cookielogin);
       
        $email_pass= mysqli_fetch_assoc($cookie_login_query);
        
        if(mysqli_num_rows($cookie_login_query)==1)
		{
        $_SESSION['username']=$email_pass['Name'];
		} else{
			header("Location: login.php");
		}

	} else{
		header("Location: login.php");
	}

?>