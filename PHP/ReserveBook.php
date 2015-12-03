<?php
	// Start the session
	session_start();
	
	// Get the variables needed
	$username = $_SESSION['username'];
	$ISBN = $_GET['ISBN'];
	$page = $_GET['page'];
	$title = $_GET['bookTitle'];
	$author = $_GET['bookAuthor'];
	$category = $_GET['category'];
	
	// Assign the category variable a blank space if the category is not set
	if ((isset($_GET['category'])) && (empty($_GET['category'])))
	{
		$category = " ";
	}
	
	// Add a new reservation to the Reservations Table and set the reserved fields to Y
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
	
	// Return to the previous page
	if (!empty($title) || !empty($author) || !empty($category))
		header("Location: ../PHP/Search.php?bookTitle=".$title."&bookAuthor=".$author."&page=".$page."&category=".$category);
	else
		header("Location: ../PHP/Books.php?page=".$page);
?>