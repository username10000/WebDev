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
			session_start();
			if (empty($_SESSION['username'])) : ?>
				<div id="registerForm">
					<h2>Register</h2>
					<form action="../PHP/RegisterVerify.php" method="POST">
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
			<?php else : ?>
				<div class = "success">
					Hello <?php echo $_SESSION['username'] ?> !
					<form action = "Logout.php">
						<button> Logout </button>
					</form>
				</div>
			<?php endif; ?>
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>

</body>

</html>