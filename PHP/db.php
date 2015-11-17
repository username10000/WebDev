<?php
	$db = mysql_connect('localhost', 'root', '');
	if ( $db === FALSE ) die('Failed to connect to the database');
	if ( mysql_select_db("assignment") === FALSE ) die ('Failed to connect to the database');
?>