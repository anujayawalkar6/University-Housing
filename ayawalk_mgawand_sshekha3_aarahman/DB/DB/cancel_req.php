<?php
	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if(!empty($_POST['req_no']))
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];
			
			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				$req_no = $_POST['req_no'];
				$type = $_POST['type'];
				$mysqli = connect_db();
				if ( !strcmp($type,'Parking'))
				{
					$sql_query = "DELETE FROM parking_requests WHERE requestID = $req_no";

					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {
							echo "DONE ";// DO SOMETHING WITH RETRIEVED QUERY
					}
				}
				else if( !strcmp($type,'Terminate'))
				{
					$sql_query = "DELETE FROM terminate_request WHERE RequestID = $req_no";

					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {
							echo "DONE ";
					}
				}
				else if( !strcmp($type,'Lease'))
				{
					$sql_query = "DELETE FROM lease_request WHERE LeaseRequestID = $req_no";

					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {
							echo "DONE ";
					}
				}
				else{
					echo "WRONG!!";
				}
				
			}
			else
			{
				// DISPLAY SET TO SOMETHING OTHER THAN STUDENT IF NEEDED;
			}
			header( 'Refresh: 2; url=/DB/view_cancel_req.php' );
		}
		else
		{
			// SOME VALUE NOT PRESENT
		}
		header( 'Refresh: 2; url=/DB/view_cancel_req.php' ); //NEEDS TO BE CHECKED IF WORKS
	}
	else
	{
		// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
