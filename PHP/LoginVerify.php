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
				// Reset the session
				session_start();
				if (isset($_SESSION))
				{
					$_SESSION['username'] = "";
					$_SESSION['password'] = "";
				}
			
				// Get the inputed username and password
				$username = $_POST["username"];
				$password = $_POST["password"];
				
				// Verify if the fields are empty
				if (empty($username) || empty($password))
				{
					//echo "<div style = \"width: 100%; text-align: center; padding-top: 200px; color: red;\">";
					echo '<div class = "error">';
					
					echo "Please enter a Username and a Password.";
				}
				else
				{
					// Connect to the database
					require_once("db.php");
					$result = mysql_query("SELECT Username, Password FROM Users");
					
					while ($row = mysql_fetch_row($result))
					{
						$success = true;
						if (($row[0] == $username) && ($row[1] == $password))
						{
							echo '<div class = "success">';
							
							$_SESSION['username'] = $username;
							echo "Hello " . $_SESSION['username'] . "!";
							break;
						}
						else
							$success = false;
					}
					
					// Verify if the username and password exist
					if (!$success)
					{
						echo '<div class = "error">';
						
						echo "Invalid Username or Password";
					}
					
					mysql_close($db);
				}
				
				echo "</div>";
			?>
		</div>
	
		<?php include "../HTML/Footer.html"; ?>
	</div>

</body>

</html>