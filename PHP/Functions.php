<?php

function printBooks($pageNo, $books, $state)
{
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
				if ( ($books[$i]['Reserved'] == 'N') && ($state == "Reserve") )
				{
					echo '<button name = "ISBN" value="'.$books[$i]['ISBN'].'" class = "reserve" onclick = "confirmReservation(this.value, '.$pageNo.')"> Reserve </button>';
				}
				else 
					if ($state == "Reserve")
						echo '<button class = "notAvailable" disabled> Not Available </button>';
					else
						echo '<button name = "ISBN" value="'.$books[$i]['ISBN'].'" class = "reserve" onclick="confirmReturn(this.value, '.$pageNo.')"> Return </button>';
			echo '</div>';
		echo '</div>';
	}
}

function readData($sql, &$books)
{
	// SQL to return all the book records
	$result = mysql_query($sql);

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
}

function getPageNumber()
{
	// Get the page number if it exists
	if (isset($_GET['page']))
	{
		return $_GET['page'];
	}
	else
	{
		return 0;
	}
}
?>