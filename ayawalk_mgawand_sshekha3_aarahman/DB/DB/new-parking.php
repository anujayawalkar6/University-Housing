<?php

	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if( (!empty($_POST['vehicle-type'])) && (!empty($_POST['handicap'])) && (!empty($_POST['nearby'])) )
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];

			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				$vehicle_type = $_POST['vehicle-type'];
				$handicap = $_POST['handicap'];
				$nearby = $_POST['nearby'];
				$mysqli = connect_db();
				
				if($handicap == 'yeshc')
					$valueType = 'Handicapped';
				else
					$valueType = $vehicle_type;
				if($nearby == 'yes')
					$nearbyInt = 1;
				else
					$nearbyInt = 0;
				if(!strcmp($peopleType,'guest'))
					$nearbyInt = 0;
				$sql_query = "CALL CreateNewParkRequest($peopleID, '$valueType', $nearbyInt);";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					$row = mysqli_fetch_assoc($result);
					//
					if($row['Error'] == 2)
					{
						echo "DONE SUCCESSFULLY";
						//sleep(2);
						
					}
					else if($row['Error'] == 0)
					{
						echo "EITHER NO LEASE OR PARKING SPOT ALREADY AVAILABLE";
						//sleep(2);
						
					}
					else
					{
						echo "ALREADY MADE REQUEST";
						//sleep(5);
						
					}						
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
			
		}
		header( 'Refresh: 2; url=/DB/parking.php?peopleType='.$peopleType );
	}
	else
	{
		header( 'Refresh: 2; url=/DB/index.php' );// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
