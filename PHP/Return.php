<?php
	$ISBN = $_GET['ISBN'];
	$page = $_GET['page'];
	
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
	
	header("Location: ../PHP/Reservations.php?page=".$page);
?>