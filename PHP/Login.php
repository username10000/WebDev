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
			<div id="login">
				<h2>Login</h2>
				<form action = "../PHP/LoginVerify.php" method = "POST">
					<p>
						Username
						<br>
						<input type="text" name="username" autofocus>
					</p>
					
					<p>
						Password
						<br>
						<input type="password" name="password">
					</p>

					<p> <input type="Submit"> </p>
				</form>
			</div>
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>

</body>

</html>