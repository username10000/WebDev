<?php
	session_start();
	$username = $_SESSION['username'];
	$ISBN = $_GET['ISBN'];
	$page = $_GET['page'];
	$title = $_GET['bookTitle'];
	$author = $_GET['bookAuthor'];
	$category = $_GET['category'];
	
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
	
	echo $title.$author;
	
	if (!empty($title) || !empty($author) || !empty($category))
		header("Location: ../PHP/Search.php?bookTitle=".$title."&bookAuthor=".$author."&page=".$page."&category=".$category);
	else
		header("Location: ../PHP/Books.php?page=".$page);
?>