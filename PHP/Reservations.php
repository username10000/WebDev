<!DOCTYPE html>
<html>

<head>
	<title>Library - Reservations</title>
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans">
	<link rel="stylesheet" type="text/css" href="../CSS/mystyle.css">
</head>

<body>
	<div id="container">

		<?php include "../HTML/Header.html"; ?>
		
		<?php include "../PHP/Username.php"; ?>
		
		<div id="content">
			<?php
				// Get the page number if it exists
				if (isset($_GET['page']))
				{
					$pageNo = $_GET['page'];
				}
				else
				{
					$pageNo = 0;
				}
				
				$username = $_SESSION['username'];
				
				require_once("db.php");
				
				// SQL to return all the book records
				$result = mysql_query("SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, c.CategoryDescription, b.Reserved 
									   FROM Books b JOIN Categories c ON(b.Category = c.CategoryID)
													JOIN Reservations r ON(b.ISBN = r.ISBN)
									   WHERE r.Username = '$username'");
									   
				// Put the books into a 2D array
				while ($row = mysql_fetch_row($result))
				{
					$temp['ISBN'] = htmlentities($row[0]);
					$temp['Title'] = htmlentities($row[1]);
					$temp['Author'] = htmlentities($row[2]);
					$temp['Edition'] = htmlentities($row[3]);
					$temp['Year'] = htmlentities($row[4]);
					$temp['Category'] = htmlentities($row[5]);
					$temp['Reserved'] = htmlentities($row[6]);
					
					$books[] = $temp;
				}
				
				// Print the array (5 per page)
					for ($i = $pageNo * 5 ; ($i < $pageNo * 5 + 5) && !empty($books[$i]) ; $i++)
					{
						echo '<div class = "record">';
							echo '<div class = "left">';
								echo '<br>';
								echo '<span class = "title">'; 
								echo $books[$i]['Title'];
								echo '</span>'; 
								echo '<span class = "author">'; 
								echo ' by '.$books[$i]['Author']; 
								echo '</span>';
								echo '<br>';
								echo $books[$i]['Category']." | ".$books[$i]['Year']." | ";
								switch($books[$i]['Edition'])
								{
									case 1:
									{
										echo '1st';
										break;
									}
									case 2:
									{
										echo '2nd';
										break;
									}
									case 3:
									{
										echo '3rd';
										break;
									}
									default:
									{
										echo $books[$i]['Edition'].'th';
									}
								}
								echo ' Edition';
							echo '</div>';
							echo '<div class = "right">';
									//*** Doesn't work
									echo '<button name = "ISBN" value="'.$books[$i]['ISBN'].'" class = "reserve" onclick="window.location.href=Reservations.php?ISBN=this.value"> Return </button>';
							echo '</div>';
						echo '</div>';
					}
					
					// Create form with two buttons that has the value of the next or previous page
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
					mysql_close($db);
			?>
			
			<?php
				if (isset($_GET['ISBN']))
				{
					$ISBN = $_GET['ISBN'];
					
					require_once("db.php");
					
					$sql = "DELETE FROM Reservations
							WHERE ISBN = '$ISBN'";
								
					if (mysql_query($sql))
					{
						$sql = "UPDATE Books
								SET Reserved = 'N'
								WHERE ISBN = '$ISBN'";
								
						mysql_query($sql);
					}
					mysql_close($db);
					
					header("Location: ../PHP/Reservations.php");
					
					//***Script to add the parameter
				}
			?>
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>
</body>

</html>