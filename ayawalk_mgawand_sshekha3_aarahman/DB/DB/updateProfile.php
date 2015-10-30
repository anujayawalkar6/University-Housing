<?php
	session_start();
	error_reporting(E_ALL);
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		if( (!empty($_POST['firstName'])) || (!empty($_POST['lastName'])) || (!empty($_POST['street'])) || (!empty($_POST['city']))
			||  (!empty($_POST['zip'])) || (!empty($_POST['available']))|| (!empty($_POST['courseName'])))
		{	
			$nl = "<br />";
			include "database.php";
			
			$username = $_SESSION['username'];
			$peopleType = $_SESSION['peopleType'];
			$peopleID = $_SESSION['peopleID'];

			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
			{
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				$street = $_POST['street'];
				$city = $_POST['city'];
				$zip = $_POST['zip'];
				$specialNeeds = $_POST['specialNeeds'];
				$phone = $_POST['phone'];
				$alternatePhone = $_POST['alternatePhone'];
				$additional = $_POST['additional'];
				$available = $_POST['available'];
				$courseName = $_POST['courseName'];
				$mysqli = connect_db();
				$sql_query = "SELECT addrID from people WHERE peopleID = $peopleID;";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					$sql_query_pre = "null";
					$row = mysqli_fetch_assoc($result);
					$addrID = $row['addrID'];
					// DO SOMETHING WITH RETRIEVED QUERY
				}
				// FOR CHANGE IN ADDRESS, NEED TO CONSIDER IF THE CURRENT ADDRESS ID IS CHANGED OR A NEW ADDRESS ID IS CREATED, OR ONE FROM EXISTING IS TAKEN
				if (!empty($firstName))
				{
					$sql_query = "UPDATE  people SET firstName = '$firstName' WHERE peopleID = $peopleID;";
					
					//echo $sql_query;
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
					$sql_query = "UPDATE  login SET firstName = '$firstName' WHERE ID = $peopleID;";
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($lastName))
				{
					$sql_query = "UPDATE  people SET lastName = '$lastName' WHERE peopleID = $peopleID;";
			//echo $sql_query;
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
					$sql_query = "UPDATE  login SET lastName = '$lastName' WHERE ID = $peopleID;";
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($street))
				{
					$sql_query = "UPDATE  address SET street = '$street' WHERE addrID = $addrID;";
			
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($city))
				{
					$sql_query = "UPDATE  address SET city = '$city' WHERE addrID = $addrID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($country))
				{
					$sql_query = "UPDATE  address SET country = '$country' WHERE addrID = $addrID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($zip))
				{
					$sql_query = "UPDATE  address SET zipcode = '$zip' WHERE addrID = $addrID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($phone))
				{
					$sql_query = "UPDATE  people SET phone = '$phone' WHERE peopleID = $peopleID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($alternatePhone))
				{
					$sql_query = "UPDATE  people SET alternatePhone = '$alternatePhone' WHERE peopleID = $peopleID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($additional))
				{
					$sql_query = "UPDATE  people SET additionalComments = '$additional' WHERE peopleID = $peopleID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				if (!empty($courseName))
				{
					$sql_query = "UPDATE  people SET courseName = '$courseName' WHERE peopleID = $peopleID;";
			
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {

					}
				}
				
				
			}
			else
			{
				// DISPLAY SET TO SOMETHING OTHER THAN STUDENT IF NEEDED;
			}
			header( 'location: /DB/profile.php?peopleType='.$peopleType );
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
