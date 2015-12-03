<!DOCTYPE html>
<html>

<head>
	<title>Library - Search</title>
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
	<script src="../JS/script.js"></script>
</head>

<body>
	<div id="container">

		<?php include "../HTML/Header.html"; ?>
		
		<?php include "../PHP/Username.php"; ?>
		
		<div id="content">
			<?php // Check if the user is logged in
			if ( empty($_SESSION['username']) ) 
			{ 
				include "../HTML/AccessDenied.html";
			} 
			else 
			{ ?>
				<form method = "GET">
					<input type = "hidden" name = "page" value = "0">
					<input type = "text" id = "bookTitle" name = "bookTitle" placeholder = "Title" autofocus>
					<input type = "text" id = "bookAuthor" name = "bookAuthor" placeholder = "Author">
					<select name = "category">
						<option value="">Category</option>
						<?php
							// Open the database
							require_once("db.php");
							$result = mysql_query("SELECT * FROM Categories");
							
							// Create the drop down category list
							while($row = mysql_fetch_row($result))
							{
								echo "<option value=$row[0]";
								
								// Select the category
								if ((isset($_GET['category']) && ($row[0] == $_GET['category'])))
								{
									echo " selected ";
								}
								
								echo ">$row[1]</option>";
							}
						?>
					</select>
					<input type = "submit" id = "searchSubmit">
				</form>
				<br>
			<?php } ?>
			
			<?php
				if ( isset($_GET['bookTitle']) || isset($_GET['bookAuthor']) || isset($_GET['category']) )
				{	
					// External PHP
					require_once("Functions.php");
					
					// Get the current page number
					$pageNo = getPageNumber();
			
					// Set the title variable
					if (!empty($_GET['bookTitle']))
					{
						$bookTitle = strtoupper(mysql_real_escape_string($_GET['bookTitle']));
						echo "Title: ".$_GET['bookTitle'];
					}
					else
					{
						$bookTitle = "";
					}
					
					// Set the author variable
					if (!empty($_GET['bookAuthor']))
					{
						$bookAuthor = strtoupper(mysql_real_escape_string($_GET['bookAuthor']));
						if (!empty($_GET['bookTitle']))
							echo " | ";
						echo "Author: ".$_GET['bookAuthor'];
					}
					else
					{
						$bookAuthor = "";
					}
					
					if (isset($_GET['category']))
					{
						$category = $_GET['category'];
					}
					else
					{
						$category = "";
					}
					
					// SQL to get all the books that contain the searched title and/or author
					$sql = "SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, c.CategoryDescription, b.Reserved 
							FROM Books b JOIN Categories c ON(b.Category = c.CategoryID)
							WHERE b.bookTitle LIKE '%$bookTitle%' AND b.Author LIKE '%$bookAuthor%' AND c.categoryID LIKE '%$category%'";
					
					// Read the data into the variable books
					readData($sql, $books);
					
					// Print the books array
					printBooks($pageNo, $books, "Reserve");
					
					// Create a form with two buttons that has the value of the next or previous page
					echo '<form type = "GET">';
						echo '<input type = "hidden" name = "bookTitle" value = "'.$bookTitle.'">';
						echo '<input type = "hidden" name = "bookAuthor" value = "'.$bookAuthor.'">';
						echo '<input type = "hidden" name = "category" value = "'.$category.'">';
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