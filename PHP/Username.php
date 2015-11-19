<div class = "user">
	<?php
		session_start();
		if (!empty($_SESSION['username']))
		{
			echo "Hello " . $_SESSION['username'] . "! ";
			echo '<form action = "Logout.php" style = "display: inline; float: right; margin-right: 30px;">';
				echo '<button> Logout </button>';
			echo '</form>';
		}
	?>
</div>