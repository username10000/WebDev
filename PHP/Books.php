<!DOCTYPE html>
<html>

<head>
	<title>Library - Books</title>
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
			
			// Check if the user is logged in
			if ( empty($_SESSION['username']) )
			{
				echo '<div class = "error" style = "margin-top: -120px">';
				echo "Access Denied!";
				echo "<br>";
				echo '<form action = "Login.php">';
					echo '<button> Login </button>';
				echo '</form>';
				echo '</div>';
			}
			else
			{
				require_once("db.php");
				
				// Display all the books available
				$username = $_SESSION['username'];
				
				// SQL to return all the book records
				$result = mysql_query("SELECT b.ISBN, b.BookTitle, b.Author, b.Edition, b.Year, c.CategoryDescription, b.Reserved 
									   FROM Books b JOIN Categories c ON(b.Category = c.CategoryID)");
			
				// Put the books into a 2D array
				while ($row = mysql_fetch_row($result))
				{
					/*
					for ($i = 0 ; $i < 7 ; $i++)
					{
						$temp[$i] = htmlentities($row[$i];
					}*/
					
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
							if ($books[$i]['Reserved'] == 'N')
							{
								echo '<button name = "ISBN" value="'.$books[$i]['ISBN'].'" class = "reserve" onclick = "confirmReservation(this.value, '.$pageNo.')"> Reserve </button>';
							}
							else
								echo '<button class = "notAvailable" disabled> Not Available </button>';
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
			}
			?>
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>
	
<script type = "text/javascript">
	// Create a confirmation popup window
	function confirmReservation(value, page)
	{
		var answer = confirm("Are you sure you want to reserve it?");
		if (answer)
			window.location.href = "ReserveBook.php?ISBN=" + value + "&page=" + page;
	}
</script>
	
</body>

</html>