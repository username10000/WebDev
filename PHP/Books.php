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
		
		<div id="content">
			<!--
			<div class = "record">
				<div class = "left"> 
					<span class = "title"> Business Strategy </span> <span class = "author"> by Joe Peppard </span>
					<br>
					Sci-Fi | 1998 | 3rd Edition
				</div>
				
				<div class = "right">
					<button> Reserve </button>
				</div>
			</div>			
			<br>-->
			<?php
			require_once("db.php");
			session_start();
			
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
			if ( empty($_SESSION['username']) || empty($_SESSION['password']) )
			{
				echo '<div class = "error">';
				echo "Please Login!";
				echo '</div>';
			}
			else
			{
				// Display all the books available
				$username = $_SESSION['username'];
				$password = $_SESSION['password'];
				
				$result = mysql_query("SELECT ISBN, BookTitle, Author, Edition, Year, Category, Reserved FROM Books");
			
				// Put the books into a 2D array
				while ($row = mysql_fetch_row($result))
				{
					for ($i = 0 ; $i < 7 ; $i++)
					{
						$temp[$i] = htmlentities($row[$i]);
					}
					$books[] = $temp;
				}
				
				// Print the array (5 per page)
				//echo '<table class = "tableStyle">'."\n";
				
				for ($i = $pageNo * 5 ; ($i < $pageNo * 5 + 5) && !empty($books[$i]) ; $i++)
				{
					// *** Change to divs
					//echo '<tr>';
					echo '<div class = "record">';
					echo '<div class = "left">';
						echo '<br>';
						echo '<span class = "title">'; 
						echo $books[$i][1];
						echo '</span>'; 
						echo '<span class = "author">'; 
						echo ' by '.$books[$i][2]; 
						echo '</span>';
						echo '<br>';
						echo $books[$i][5]." | ".$books[$i][4]." | ";
						switch($books[$i][3])
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
								echo $books[$i][3].'th';
							}
						}
						echo ' Edition';
					echo '</div>';
					echo '<div class = "right">';
						if ($books[$i][6] == 'Y')
							echo '<button class = "reserve"> Reserve </button>';
						else
							echo '<button class = "notAvailable" disabled> Not Available </button>';
					echo '</div>';
					/*
					for ($j = 0 ; $j < count($books[0]) ; $j++)
					{
						//echo '<td>';
						echo $books[$i][$j];
						//echo '</td>';
					}
					*/
					//echo '</tr>';
					echo '</div>';
				}
				
				//echo '</table>';
				
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
			}

			mysql_close($db);
			?>
			
				
			
		</div>
		
		<?php include "../HTML/Footer.html"; ?>
	
	</div>
</body>

</html>