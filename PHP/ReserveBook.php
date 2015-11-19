<?php
	session_start();
	$username = $_SESSION['username'];
	$ISBN = $_GET['ISBN'];
	$page = $_GET['page'];
	$title = $_GET['bookTitle'];
	$author = $_GET['bookAuthor'];
	
	require_once("db.php");
	$sql = "INSERT INTO Reservations (ISBN, Username, ReservedDate)
			VALUES ('$ISBN', '$username', '2015-08-15')";
				
	if (mysql_query($sql))
	{
		$sql = "UPDATE Books
				SET Reserved = 'Y'
				WHERE ISBN = '$ISBN'";
				
		mysql_query($sql);
	}
	
	mysql_close($db);
	
	if (!empty($title) && !empty($author))
		header("Location: ../PHP/Books.php?bookTitle=".$title."&bookAuthor=".$author."&page=".$page);
	else
		header("Location: ../PHP/Books.php?page=".$page);
?>