<?php
	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if( (!empty($_POST['startperiod'])) && (!empty($_POST['endperiod'])) && (!empty($_POST['housing-pref-1'])) && (!empty($_POST['housing-pref-2'])) && (!empty($_POST['housing-pref-3'])) && (!empty($_POST['payment'])) )
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];

			if(isset($_POST['parkNeeded']) && $_POST['parkNeeded'] == 'Yes') 
				$parkingNeeded = 1;
			else
				$parkingNeeded = 0; 
 
 
			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				$startperiod = $_POST['startperiod'];
				$endperiod = $_POST['endperiod'];
				$housing_pref_1 = $_POST['housing-pref-1'];
				$housing_pref_2 = $_POST['housing-pref-2'];
				$housing_pref_3 = $_POST['housing-pref-3'];
				$date = $_POST['date'];
				$payment = $_POST['payment'];
				$mysqli = connect_db();
				if (!(strcmp($startperiod, 'Spring')))
					$startdate = '2015-01-01';
				else if (!(strcmp($startperiod, 'Fall')))
					$startdate = '2015-08-01';
				else
					$startdate = '2015-06-01';
				if($endperiod == '1')
				{
					if($startdate == '2015-01-01')
					{
						$rentalPeriod = 5;
						$enddate = '2015-05-31';
					}
					else if($startdate == '2015-08-01')
					{
						$rentalPeriod = 5;
						$enddate = '2015-12-31';
					}
					else if($startdate == '2015-06-01')
					{
						$rentalPeriod = 2;
						$enddate = '2015-07-31';
					}
				}
				if($endperiod == '2')
				{
					if($startdate == '2015-01-01')
					{
						$rentalPeriod = 7;
						$enddate = '2015-07-31';
					}
					else if($startdate == '2015-08-01')
					{
						$rentalPeriod = 10;
						$enddate = '2016-05-31';
					}
					else if($startdate == '2015-06-01')
					{
						$rentalPeriod = 7;
						$enddate = '2015-12-31';
					}
				}
				if($endperiod == '3')
				{
					$rentalPeriod = 12;
					if($startdate == '2015-01-01')
					{
						$enddate = '2015-12-31';
					}	
					else if($startdate == '2015-08-01')
					{
						$enddate = '2016-07-31';
					}
					else if($startdate == '2015-06-01')
					{
						
						$enddate = '2016-05-31';
					}
				}
				$sql_query = "SELECT count(leaseID) AS count from people WHERE peopleID = $peopleID";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					$row = mysqli_fetch_assoc($result);
					//
					$leaseID = $row['count'];
					//echo $leaseID;
					if ($leaseID != 0)
						echo "CAN'T RAISE NEW LEASE REQUEST WHEN ALREADY HAVE ONE";
					else
					{
						$sql_query = "CALL proc_Lease_Request_Insert( $peopleID, '$startdate', '$enddate', $rentalPeriod , $housing_pref_1 , $housing_pref_2 , $housing_pref_3 , '$payment', $parkingNeeded );";
			
						$result = $mysqli->query($sql_query);
						if ($result == FALSE) {
							echo "Query failed: ".$mysqli->error.$nl;
						}
						else {
								echo "DONE !";
						}
					}
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
		header( 'Refresh: 2; url=/DB/housing.php?peopleType='.$peopleType ); //NEEDS TO BE CHECKED IF WORKS
	}
	else
	{
		// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
