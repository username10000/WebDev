<!DOCTYPE html>
<html>
<head>
	<title>Library - Login</title>
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
</head>

<body>

	<div id="container">

		<?php include "../HTML/Header.html"; ?>
		
		<div id="content">
			<?php 
			if (isset($_POST['username']) && isset($_POST['password']))
			{
				// Start the session
				session_start();
			
				// Get the inputed username and password
				$username = mysql_real_escape_string($_POST["username"]);
				$password = mysql_real_escape_string($_POST["password"]);
				
				// Verify if the fields are empty
				if (empty($username) || empty($password))
				{
					echo '<div class = "error">';
					echo "Please enter a Username and a Password.";
					echo "</div>";
				}
				else
				{
					// Connect to the database
					require_once("db.php");
					
					// SQL to get all the informations on the users
					$result = mysql_query("SELECT Username, Password 
										   FROM Users
										   WHERE Username = '$username' AND Password = '$password'");
					
					// Check if the row exists
					$row = mysql_fetch_row($result);
					if (!empty($row))
					{
						// Set the username session
						$_SESSION['username'] = $username;
						
						// Close the database
						mysql_close($db);
						
						// Refresh the page
						header("Location: Login.php");
					}
					else
					{
						$success = false;
					}
					
					// Print an error message if the username and password aren't in the database
					if (!$success)
					{
						echo '<div class = "error">';
						echo "Invalid Username or Password";
						echo "</div>";
					}
					
					// Close the database
					mysql_close($db);
				}
				
				
			}
			else 
			{
				// Display the login page
				session_start();
				if (empty($_SESSION['username'])) { ?>
					<div id="login">
						<h2>Login</h2>
						<form method = "POST">
							<p>
								<input type="text" name="username" placeholder="Username" autofocus>
							</p>
							
							<p>
								<input type="password" name="password" placeholder="Password">
							</p>

							<p> <input type="Submit"> </p>
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