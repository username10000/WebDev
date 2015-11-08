<!DOCTYPE html>
<html>
<head>
	<title>Library</title>
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
</head>

<body>

	<div id="container">
		<?php include "../HTML/Header.html"; ?>
		
		<div id="content">
			<?php
				$username = $_POST["username"];
				$password = $_POST["password"];
				
				if (empty($username) || empty($password))
				{
					echo "Please enter a Username and a Password.";
				}
				else
				{
					$db = mysql_connect('localhost', 'root', '') or die(mysql_error());
					mysql_select_db("Assignment") or die(mysql_error());
					$result = mysql_query("SELECT Username, Password FROM Users");
					while ($row = mysql_fetch_row($result))
					{
						if (($row[0] == $username) && ($row[1] == $password))
						{
							session_start();
							$_SESSION['username'] = $username;
							$_SESSION['password'] = $password;
							echo "Hello " . $_SESSION['username'] . "!";
							break;
						}
						else
							echo "NOT OK";
					}
				}
				
			?>
		</div>
	
		<?php include "../HTML/Footer.html"; ?>
	</div>

</body>

</html>