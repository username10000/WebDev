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
			session_start();
			if (empty($_SESSION['username'])) : ?>
				<div id="login">
					<h2>Login</h2>
					<form action = "../PHP/LoginVerify.php" method = "POST">
						<p>
							<input type="text" name="username" placeholder="Username" autofocus>
						</p>
						
						<p>
							<input type="password" name="password" placeholder="Password">
						</p>

						<p> <input type="Submit"> </p>
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