<!DOCTYPE html>
<html>

<head>
	<title>Library - Books</title>
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
	<script src="../JS/script.js"></script>
</head>

<body>
	<div id="container">

		<?php include "../HTML/Header.html"; ?>
		
		<?php include "../PHP/Username.php"; ?>
		
		<div id="content">
			<?php
			// External PHP
			require_once("Functions.php");
			
			// Get the current page number
			$pageNo = getPageNumber();
			
			// Check if the user is logged in
			if ( empty($_SESSION['username']) ) 
			{ 
				include "../HTML/AccessDenied.html";
			}
			else
			{
				// Open the database
				require_once("db.php");
				
				// SQL to get all the books
				$sql = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, c.CategoryDescription, b.Reserved 
						FROM Books b JOIN Categories c ON(b.Category = c.CategoryID)";
				
				// Read the data into the variable books
				readData($sql, $books);
				
				// Print the books array
				printBooks($pageNo, $books, "Reserve");
				
				// Create a form with two buttons that has the value of the next or previous page
				echo '<form type = "GET">';
					if ( $pageNo != 0 )
					{
						echo '<button name = "page" value = '.($pageNo - 1).' class = "leftArrow"> < </button>';
					}
					if ( (($pageNo+1) * 5) < count($books) )
					{
						echo '<button name = "page" value = '.($pageNo + 1).' class = "rightArrow"> > </button>';
					}
				echo '</form>';
				
				// Close the database
				mysql_close($db);
			}
			?>
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>
</body>

</html>