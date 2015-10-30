<?php

function connect_db()
{
	$sql_host = "localhost";
	$sql_username = "root";
	$sql_password = "";
	$sql_database = "dummy3";

	// Connect to the service
	// TODO: If there's a problem, look at this: http://php.net/manual/en/mysqli.quickstart.connections.php
	$mysqli = new mysqli($sql_host, $sql_username, $sql_password, $sql_database);
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	
	//echo "Connected";
	
	return $mysqli;
}
	
?>