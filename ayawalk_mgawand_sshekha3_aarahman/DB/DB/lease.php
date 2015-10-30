<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Lease</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#current-lease").click(function(){
	if($("#disp-current-lease").css('display') == 'none'){ 
	   $('#disp-current-lease').show('slow');
		$('#disp-former-lease').hide('slow'); 	   
	} else { 
	   $('#disp-current-lease').hide('slow'); 
	}	
	});
});
$(document).ready(function(){
	$("#former-lease").click(function(){
	if($("#disp-former-lease").css('display') == 'none'){ 
	   $('#disp-former-lease').show('slow');
		$('#disp-current-lease').hide('slow'); 	   
	} else { 
	   $('#disp-former-lease').hide('slow'); 
	}	
	});
});
</script>
	
</head>
<body>
<?php
	error_reporting(E_ALL);
	include "header.php";
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		$nl = "<br />";
		include "database.php";

		$username = $_SESSION['username'];
		$peopleID = $_SESSION['peopleID'];
		$peopleType = $_SESSION['peopleType'];
?>
<section>
	
<?php
			if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
		{
			//echo "This is coming";
			// display set to student;
?>
			<div id="housing-options">
			<div><span id="current-lease" class="text-link">View Current Lease</span><br/>
				<div id="disp-current-lease" style="display:none;"><br/>
				<table >
					<tr>
						<th> People ID </th>
						<th> Place ID </th>
						<th> Housing ID </th>
						<th> Lease ID </th>
						<th> Entry Date </th>
						<th> Exit Date </th>
						<th> Security Deposit </th>
						<th> Penalty </th>
						<th> Cutoff Date </th>
						<th> Rent </th>
						<th> Payment Option </th>
					</tr>
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT * FROM `dummy3`.`lease` WHERE peopleID = $peopleID AND status = 'current';";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					while($row = $result->fetch_assoc())
					{
						$peopleID = $row['peopleID'];
						$placeID = $row['placeID'];
						$housingID = $row['housingID'];
						$leaseID = $row['leaseID'];
						$entryDate = $row['entrydate'];
						$exitDate = $row['exitDate'];
						$securityDeposit = $row['securityDeposit'];
						$penalty = $row['penalty'];
						$cutOffDate = $row['cutOffDate'];
						$rent = $row['rent'];
						$paymentOption = $row['paymentOption'];
						//echo $course_number;
?>				

						<tr>
							<td><?php echo "$peopleID"?></td>
							<td><?php echo "$placeID"?></td>
							<td><?php echo "$housingID"?></td>
							<td><?php echo "$leaseID"?></td>
							<td><?php echo "$entryDate"?></td>
							<td><?php echo "$exitDate"?></td>
							<td><?php echo "$securityDeposit"?></td>
							<td><?php echo "$penalty"?></td>
							<td><?php echo "$cutOffDate"?></td>
							<td><?php echo "$rent"?></td>
							<td><?php echo "$paymentOption"?></td>
						</tr>
<?php
					}
				}
?>
				</table>
				</div>
			</div>
			<div><span id="former-lease" class="text-link">View Former Leases</span><br/>
				<div id="disp-former-lease" style="display:none;"><br/>
				<table >
					<tr>
						<th> People ID </th>
						<th> Place ID </th>
						<th> Housing ID </th>
						<th> Lease ID </th>
						<th> Entry Date </th>
						<th> Exit Date </th>
						<th> Security Deposit </th>
						<th> Penalty </th>
						<th> Cutoff Date </th>
						<th> Rent </th>
						<th> Payment Option </th>
					</tr>
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT * FROM `dummy3`.`lease` WHERE peopleID = $peopleID AND status = 'Expired';";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					while($row = $result->fetch_assoc())
					{
						$peopleID = $row['peopleID'];
						$placeID = $row['placeID'];
						$housingID = $row['housingID'];
						$leaseID = $row['leaseID'];
						$entryDate = $row['entrydate'];
						$exitDate = $row['exitDate'];
						$securityDeposit = $row['securityDeposit'];
						$penalty = $row['penalty'];
						$cutOffDate = $row['cutOffDate'];
						$rent = $row['rent'];
						$paymentOption = $row['paymentOption'];
						//echo $course_number;
?>				

						<tr>
							<td><?php echo "$peopleID"?></td>
							<td><?php echo "$placeID"?></td>
							<td><?php echo "$housingID"?></td>
							<td><?php echo "$leaseID"?></td>
							<td><?php echo "$entryDate"?></td>
							<td><?php echo "$exitDate"?></td>
							<td><?php echo "$securityDeposit"?></td>
							<td><?php echo "$penalty"?></td>
							<td><?php echo "$cutOffDate"?></td>
							<td><?php echo "$rent"?></td>
							<td><?php echo "$paymentOption"?></td>
						</tr>
<?php
					}
				}
?>
				</table>
				</div>
			</div>
			</div>
			
<?php 
		}
		else
		{
			//echo "This is coming";
			//echo substr($peopleID,0,1);// display set to something else;
		}
		
	}
	else
	{
		//echo "Outside";
	}
?>
	
</section>
</body>
</html>