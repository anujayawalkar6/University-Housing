<?php

	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if( (!empty($_POST['invoiceNo'])))
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];
	
			$invoiceNo = $_POST['invoiceNo'];
			$mop = $_POST['mop'];
			$mysqli = connect_db();

			$sql_query = "CALL PayInvoice($peopleID, $invoiceNo, '$mop');";
		
			$result = $mysqli->query($sql_query);
			if ($result == FALSE) {
				echo "Query failed: ".$mysqli->error.$nl;
			}
			else {
					echo "DONE SUCCESSFULLY";					
				// DO SOMETHING WITH RETRIEVED QUERY
			}
			header( 'Refresh: 2; url=/DB/invoice.php');
		}
		
	}
	else
	{
		header( 'Refresh: 2; url=/DB/invoice.php' );// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
