<?php
	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if( (!empty($_POST['ticket_type'])) && (!empty($_POST['description'])) )
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];

			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				$ticket_type = $_POST['ticket_type'];
				$description = $_POST['description'];
				$mysqli = connect_db();
				$todayDate = date("Y-m-d");
				$sql_query = "CALL RaiseMaintenanceTicket($peopleID, '$ticket_type' ,'$description', '$todayDate' );";
	
				$result = $mysqli->query($sql_query);
				$mysqli->close();
				//$mysqli->next_result();
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					echo "RAISED TICKET";
					//$row = mysqli_fetch($sql_query);
					// DO SOMETHING WITH RETRIEVED QUERY
				}
			}
			else
			{
				// DISPLAY SET TO SOMETHING OTHER THAN STUDENT IF NEEDED;
			}
		}
		else
		{
			// SOME VALUE NOT PRESENT
		}
		header( 'Refresh: 2; url=/DB/maintenance.php?peopleType='.$peopleType ); //NEEDS TO BE CHECKED IF WORKS
	}
	else
	{
		// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
