<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>View Vacancies</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
	$("#view_req_container").click(function(){
	if($("#view_req").css('display') == 'none'){ 
	   $('#view_req').show('slow'); 	   
	} else { 
	   $('#view_req').hide('slow'); 
	}	
	});
});
	
</script>
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
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		$nl = "<br />";
		include "database.php";
		
		$username = $_SESSION['username'];
		$peopleType = $_SESSION['peopleType'];
		$peopleID = $_SESSION['peopleID'];
?>
<section>
	
<?php
		if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
		{
			// display set to student;
			
?>
		
		<section>
			
			<div id="view_req_container"><span style="cursor:pointer">View Vacancies</span></div><br>
				<div id="view_req" style="display:none;">
				<table>
				<tr>
					<th> place ID </th>
					<th> housing ID </th>
					<th> Housing Name </th>
					<th> Rent </th>
				</tr>	
					
<?php
				$mysqli = connect_db();
				$sql_query = "CALL ViewVacancies();";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					while($row = $result->fetch_assoc())
					{
						$pid = $row['placeID'];
						$hid = $row['housingID'];
						$hname = $row['housingname'];
						$rent = $row['monthlyRent'];
						//echo $course_number;
?>
				<tr>
					<td><?php echo $pid ?></td>
					<td><?php echo $hid ?></td>
					<td><?php echo $hname ?></td>
					<td><?php echo $rent ?></td>	
				</tr>
<?php
					}
				}
?>
				</table><br/>
				<button value="Back" align="middle" type="button" onclick="location.href='/DB/housing.php?peopleType=student'" style="width:21.25%; height:35px">Back</button>
				
				</div>
		</section>
<br/>
<br/>
<br/>
<br/>

<?php			
		}
		else
		{
			// DISPLAY SET TO SOMETHING OTHER THAN STUDENT IF NEEDED;
		}
		
	}
	else
	{
		// NOT LOGGED IN - SHOULD REDIRECT TO LOGIN;
	}
?>
	

</body>
</html>