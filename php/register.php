<?php
	require 'database.php';

	//Sanitize the input
	$email = mysql_real_escape_string($_POST['email']);
	$user_name = mysql_real_escape_string($_POST['name']);
	$password= mysql_real_escape_string($_POST['password']);


    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$home_page = './home_page.php';
	$registration_page = '../html/register.html';

	if(!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['password'])) {

	
		//Check if that email is already associated with a user
		$stmt1 = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE email=?");
		if(!$stmt1){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}

		// Bind the parameter
		$stmt1->bind_param('s', $email);
		$user_email = htmlspecialchars($_POST['email']);
		$stmt1->execute();
		 
		// Bind the results
		$stmt1->bind_result($cnt);
		$stmt1->fetch();
		$stmt1->close();

		if( $cnt == 1){ //already a user with that email address

			//modal or something

			echo "There is already a user with that email address. Please try another.";


		}else{


			//inserting a new user into users table
			$stmt = $mysqli->prepare("insert into users (email, name, password, salt) values (?, ?, ?, ?)");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}

				//This string tells crypt to use blowfish crypt for 5 rounds.
				$Blowfish_Pre = '$2a$05$';
				$Blowfish_End = '$';

				// Blowfish accepts these characters for salts.
				$Allowed_Chars =
				'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
				$Chars_Len = 63;

				
				$Salt_Length = 21;

				$mysql_date = date( 'Y-m-d' );
				$salt = "";
				//for loop to create a random salt that is valid for blowfish crypt
				for($i=0; $i<$Salt_Length; $i++)
				{
					$salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
				}
				$bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
				echo $bcrypt_salt;
				
				//crypt with the blowfish salt and store that salt in the users table with the username so that each user has it's own password
				$stmt->bind_param('ssss', $email, $user_name, crypt($password, $bcrypt_salt), $salt);
			 
				$stmt->execute();

				$stmt->close();



				$stmt2 = $mysqli->prepare("SELECT user_id FROM users WHERE email=?");
				if(!$stmt1){
					printf("Query Prep Failed: %s\n", $mysqli->error);
					exit;
				}

				// Bind the parameter
				$stmt2->bind_param('s', $email);
				$user_email = htmlspecialchars($_POST['email']);
				$stmt2->execute();
				 
				// Bind the results
				$stmt2->bind_result($user_id);
				$stmt2->fetch();
			
				session_start();
				$_SESSION['user_id'] = $user_id;
				$_SESSION['user_email'] = $user_email;

				header("Location: http://$host$uri/$home_page");


				$stmt2->close();

			}
 
	} else {
	//redirect back to register with a message

		//header("Location: http://$host$uri/$registration_page");
		echo '1 or more input fields is empty. Please try again.';
	}


?>

