<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Housing</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
	<script type="text/javascript" src="CollapsibleLists.js"></script>
	
</head>
<body>
<?php
		error_reporting(E_ALL);
?>
	<script>
	$(function() {

  });
	</script>
<?php

	include "header.php";
	
?>
<?php
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1) && !empty($_GET['peopleType']))
	{
		$nl = "<br />";
		include "database.php";

		$username = $_SESSION['username'];
		$peopleType = $_GET['peopleType'];
		$peopleID = $_SESSION['peopleID'];
?>
<section>
	
<?php
		if($peopleType != "staff")
		{
			// display set to student;
?>
			<div id="housing-options">
			<a href="invoice.php">Invoice</a><br/>
			<a href="lease.php">Leases</a><br/>
			<a href="new_request.php">New Request</a><br/>
			<a href="view_cancel_req.php">View/Cancel Requests</a><br/>
			<a href="vacancy.php">View vacancy</a><br/>
			</div>
<?php			
		}
		else
		{
			// display set to something else;
		}
		
	}
?>
	
</section>
</body>
</html>