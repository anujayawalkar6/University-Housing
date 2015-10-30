<?php
	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if( (!empty($_POST['date'])) && (!empty($_POST['reason'])) )
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];

				if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				$date = $_POST['date'];
				$reason = $_POST['reason'];
				$mysqli = connect_db();

				$sql_query = "SELECT placeID FROM `dummy3`.`lease` WHERE `peopleID` = $peopleID";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					$sql_query_pre = "null";
					$row = mysqli_fetch_assoc($result);
					$placeID = $row['placeID'];
					// DO SOMETHING WITH RETRIEVED QUERY
				}
				$sql_query = "CALL insert_terminate_request($placeID, $peopleID, '$date', '$reason');";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					echo "Terminate request placed successfully";
				}
				
			}
			else
			{
				// DISPLAY SET TO SOMETHING OTHER THAN STUDENT IF NEEDED;
			}
			header( 'Refresh: 2; url=/DB/housing.php?peopleType='.$peopleType );
		}
		else
		{
			// SOME VALUE NOT PRESENT
		}
		 //NEEDS TO BE CHECKED IF WORKS
	}
	else
	{
		// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
