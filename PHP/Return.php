<?php
	// Get the ISBN and the page number
	session_start();
	$ISBN = $_GET['ISBN'];
	$page = $_GET['page'];
	
	// Connect to the database
	require_once("db.php");
	
	// Delete the entry from the Reservations Table
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
	
	header("Location: ../PHP/Reservations.php?page=".$page);
?>