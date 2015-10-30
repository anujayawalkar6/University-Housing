<?php
	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if(!empty($_POST['permit_action']))
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];

			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				//ECHO $permit_action;
				$permit_action = $_POST['permit_action'];
				if( strcmp($permit_action, "renew") == 0)
				{
					// RENEW PARKING TICKET
					$mysqli = connect_db();

					$sql_query = "SELECT spotID FROM `dummy3`.`people` WHERE `peopleID` = $peopleID";
				
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {
						$row = mysqli_fetch_assoc($result);
						$spotID = $row['spotID'];
						if(empty($spotID))
							echo "NO PARKING SPOT TO RENEW";
						else
						{
						$row = mysqli_fetch_assoc($result);
						$spotID = $row['spotID'];
							ECHO "PARKING SPOT RENEWED";
						}
						// DO SOMETHING WITH RETRIEVED QUERY
				}
				}
				else
				{
					// RETURN PARKING TICKET
					$mysqli = connect_db();

					$sql_query = "SELECT spotID FROM `dummy3`.`people` WHERE `peopleID` = $peopleID";
				
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {
						$row = mysqli_fetch_assoc($result);
						$spotID = $row['spotID'];
						if(empty($spotID))
							echo "NO PARKING SPOT TO RETURN";
						else
						{
							$sql_query = "CALL ReturnParkingSpot($spotID);";
				
							$result = $mysqli->query($sql_query);
							if ($result == FALSE) {
								echo "Query failed: ".$mysqli->error.$nl;
							}
							else {
								echo "PARKING SPOT RETURNED";
							}
						}	
						// DO SOMETHING WITH RETRIEVED QUERY
					}
				}
				
			}
			else
			{
				// DISPLAY SET TO SOMETHING OTHER THAN STUDENT IF NEEDED;
			}
			header( 'Refresh: 2; url=/DB/parking.php?peopleType='.$peopleType );
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
