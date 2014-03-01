<?php
	require 'database.php';
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$home_page = './home_page.php';
	$login_page = '../html/login.html';
  
	
	$email = mysql_real_escape_string($_POST['email']);



	if(!empty($_POST['email']) && !empty($_POST['password']))
	{	
	
		$Blowfish_Pre = '$2a$05$';
		$Blowfish_End = '$';
		$stmt = $mysqli->prepare("SELECT COUNT(*), user_id, password, salt FROM users WHERE email=?");
 
		// Bind the parameter
		$stmt->bind_param('s', $email);
		$user_email = htmlspecialchars($_POST['email']);
		$stmt->execute();
		 
		// Bind the results
		$stmt->bind_result($cnt, $user_id, $tablePassword, $tableSalt);
		$stmt->fetch();
		$stmt->close();
		 
		$bcrypt_salt = $Blowfish_Pre . $tableSalt . $Blowfish_End;
		$pwd_guess = $_POST['password'];
		// Compare the submitted password to the actual password hash, using the bcrypt hash retrieved from the users table where the username equals the username put into the login form
		if( $cnt == 1 && crypt($pwd_guess, $bcrypt_salt) == $tablePassword){
			// Login succeeded!
			session_start();
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_email'] = $user_email;
			
			echo "Login succeeded";
			header("Location: http://$host$uri/$home_page");
		}else{
			// Login failed; redirect back to the login screen
		header("Location: http://$host$uri/$login_page");
		echo "Login has failed. Email and password don't match up";
		}
	} else {
		header("Location: http://$host$uri/$login_page");
		echo "One or more of the input fields is empty. Please try again";
	}
?>
