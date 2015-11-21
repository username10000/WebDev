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
			if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password']) && 
				isset($_POST['passwordConfirm']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['telephone']) && 
				isset($_POST['mobile']))
			{
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
					echo "</div>";
				}
				else
				{
					// Verify if the password and mobile phone number are the correct length and if the mobile is numeric
					if ( (strlen($password) != 6) || (strlen($mobile) != 10) || (!is_numeric($mobile)) )
					{
						echo '<div class = "error">';
						echo 'The password and/or mobile number are of incorrect length.<br>';
						echo 'The password must have 6 characters and the mobile number must have 10 numbers.';
						echo "</div>";
					}
					else
					{
						// Verify if both password fields are identical
						if ($password != $passwordConfirm)
						{
							echo '<div class = "error">';
							echo 'The password confirmation field is incorrect.';
							echo "</div>";
						}
						else
						{
							// Connect to the database
							require_once("db.php");
							
							// SQL to get all the information about the users from the database
							$result = mysql_query("SELECT Username 
												   FROM Users
												   WHERE Username = '$username'");
							
							// Check if the row exists
							$success = false;
							$row = mysql_fetch_row($result);
							if (empty($row))
							{
								$success = true;
							}
							
							// Verify if the username is unique
							if (!$success)
							{
								echo '<div class = "error">';
								echo "The username is already taken.";
								echo "</div>";
							}
							else
							{
								// Insert the user's information in the database
								$sql = "INSERT INTO Users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile)
										VALUES ('$username', '$password', '$first', '$last', '$address', '$address2', '$city', '$telephone', '$mobile')";
								
								// Insert the data and check if it works
								if (mysql_query($sql))
								{
									echo '<div class = "success">';
									echo "You have registered successfully!";
									echo "</div>";
								}
								else
								{
									// Display error message if the insert didn't work
									echo '<div class = "error">';
									echo "Cannot insert the data into the database";
									echo "</div>";
								}
								
								// Close the database
								mysql_close($db);
							}
						}
					}				
				}
			}
			else
			{
				// Start the session
				session_start();
				
				if (empty($_SESSION['username'])) { ?>
					<div id="registerForm">
						<h2>Register</h2>
						<form method="POST">
							<p>
								<input type="text" name="firstName" placeholder="First name" autofocus>
								<input type="text" name="lastName" placeholder="Last name">
							</p>
							<p>
								<input type="text" name="username" placeholder="Username" class="longField">
							</p>
							<p>
								<input type="password" name="password" placeholder="Password" class="longField">
							</p>
							<p>
								<input type="password" name="passwordConfirm" placeholder="Confirm Password" class="longField">
							</p>					
							<p>
								<input type="text" name="address" placeholder="Address Line 1" class="longField">
							</p>
							<p>
								<input type="text" name="address2" placeholder="Address Line 2" class="longField">
							</p>
							<p>
								<input type="text" name="city" placeholder="City" class="longField">
							</p>
							<p>
								<input type="text" name="telephone" placeholder="Telephone number" class="longField">
							</p>
							<p>
								<input type="text" name="mobile" placeholder="Mobile number" class="longField">
							</p>
							<p>
								<input type="submit" class="longField">
							</p>
						</form>
					</div>
				<?php } else { ?>
					<div class = "success">
						Hello <?php echo $_SESSION['username'] ?>!
						<form action = "Logout.php">
							<button> Logout </button>
						</form>
					</div>
				<?php } 
			} ?>
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>

</body>

</html>