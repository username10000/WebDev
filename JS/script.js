// Create a confirmation popup window
function confirmReservation(value, page)
{
	var answer = confirm("Are you sure you want to reserve it?");
	if (answer)
		window.location.href = "ReserveBook.php" + window.location.search + "&ISBN=" + value;
}

// Create a confirmation popup window
function confirmReturn(value, page)
{
	var answer = confirm("Are you sure you want to return it?");
	if (answer)
		window.location.href = "Return.php?ISBN=" + value + "&page=" + page;
}