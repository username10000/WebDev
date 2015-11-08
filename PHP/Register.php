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
			<div id="registerForm">
				<h2>Register</h2>
				<form action="../PHP/RegisterVerify.php" method="POST">
					<p>
						<input type="text" name="firstName" placeholder="First name">
						<input type="text" name="lastName" placeholder="Last name">
					</p>
					<p>
						<input type="text" name="username" placeholder="Username" class="longField">
					</p>
					<p>
						<input type="password" name="password" placeholder="Password" class="longField">
					</p>
					<p>
						<input type="text" name="address" placeholder="Address" class="longField">
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
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>

</body>

</html>