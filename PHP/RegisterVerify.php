<!DOCTYPE html>
<html>
<head>
	<title>Library - Register</title>
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
</head>

<body>
	<div id="container">

		<?php include "../HTML/Header.html"; ?>
		
		<div id="content">
			
			<?php
				// Get the register information
				$first = mysql_real_escape_string($_POST['firstName']);
				$last = mysql_real_escape_string($_POST['lastName']);
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);
				$passwordConfirm = mysql_real_escape_string($_POST['passwordConfirm']);
				$address = mysql_real_escape_string($_POST['address']);
				$address2 = mysql_real_escape_string($_POST['address2']);
				$city = mysql_real_escape_string($_POST['city']);
				$telephone = mysql_real_escape_string($_POST['telephone']);
				$mobile = mysql_real_escape_string($_POST['mobile']);
				
				// Verify if the fields are empty
				if (empty($first) || empty($last) || empty($username) || empty($password) || empty($passwordConfirm) || empty($address) || empty($city) || empty($telephone) || empty($mobile))
				{
					echo '<div class = "error">';
					echo 'Please fill in all the fields.';
				}
				else
				{
					// Verify if the password and mobile phone number are the correct length
					if ( (strlen($password) != 6) || (strlen($mobile) != 10) )
					{
						echo '<div class = "error">';
						echo 'The password and/or mobile number are of incorrect length.<br>';
						echo 'The password must have 6 characters and the mobile number must have 10 numbers.';
					}
					else
					{
						// Verify if both password fields are identical
						if ($password != $passwordConfirm)
						{
							echo '<div class = "error">';
							echo 'The password confirmation field is incorrect.';
						}
						else
						{
							// Connect to the database
							require_once("db.php");
							$result = mysql_query("SELECT Username FROM Users");
							
							$success = true;
							
							while ($row = mysql_fetch_row($result))
							{
								if ($row[0] == $username)
								{
									$success = false;
								}
							}
							
							// Verify if the username is unique
							if (!$success)
							{
								echo '<div class = "error">';
								echo "The username is already taken.";
							}
							else
							{
								// Insert the user's information in the database
								$sql = "INSERT INTO Users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile)
										VALUES ('$username', '$password', '$first', '$last', '$address', '$address2', '$city', '$telephone', '$mobile')";
								
								if (mysql_query($sql))
								{
									echo '<div class = "success">';
									echo "You have registered successfully!";
								}
								else
								{
									echo '<div class = "error">';
									echo "Error";
								}
								
								mysql_close($db);
							}
						}
					}				
				}
				
				echo "</div>";
			?>
		
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>
	
</body>

</html>