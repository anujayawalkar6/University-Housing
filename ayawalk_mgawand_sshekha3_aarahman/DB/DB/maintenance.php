<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Maintenance</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
	$(this).on('click','span',function(){
	var attr = $(this).attr('id');
	//alert(attr);
	var div = "#" + $(this).attr('id') + "-div";
	if($(div).css('display') == 'none'){ 
	   $(div).show('fast'); 	   
	} else { 
	   $(div).hide('fast'); 
	}	
	});
});
	
</script>	
</head>
<body>
<?php
	error_reporting(E_ALL);
	include "header.php";
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1) && !empty($_GET['peopleType']))
	{
		$nl = "<br />";
		include "database.php";

		$username = $_SESSION['username'];
		$peopleType = $_GET['peopleType'];
		$peopleID = $_SESSION['peopleID'];
?>
<section>
	
<?php
		if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
		{
			// display set to student;
?>
<div id="maintenance-options">
	<div class ="parking-container">
	<span class="text-link" id="raise-ticket">Raise new Ticket</span><br/>
		<div id="raise-ticket-div" style="display:none;"><br/>
		<form action="new-ticket.php" method=POST>
		<table style="border: 0px; text-align: left;">
		<tr style="border: 0px; text-align: left;"> 
			<td style="border: 0px; text-align: left;"><b>Select Type:</b></td>
			<td style="border: 0px; text-align: left;"><select name="ticket_type" id="ticket_type" required>
					<option value="" disabled selected>Select your option</option>
					<option value="Water">Water</option>
					<option value="Electricity">Electricity</option>
					<option value="Appliances">Appliances</option>
					<option value="Internet">Internet</option>
					<option value="Cleaning">Cleaning</option>
					<option value="Miscellaneous">Miscellaneous</option>
				</select></td>
		</tr>
		
		<tr>
			<td style="border: 0px; text-align: left;"><b>Description:&nbsp&nbsp</b></td>
			<td style="border: 0px; text-align: left;"><input name="description" type="text" maxlength="50" size="50" required/></td>
		</tr>
		</table><br/>
		<input value="Submit!" type="submit" style="width:21.25%; height:25px" />&nbsp&nbsp
		<button value="Back" type="button" onclick="location.href='/DB/index.php'" style="width:21.25%; height:25px">Back</button>
		</form>
		</div>
	</div>
	<br/>
	<div class ="parking-container">
	<span class="text-link" id="view-ticket">View Ticket Status</span><br/>
		<div id="view-ticket-div" style="display:none;"><br/>
		<table>
			<tr>
				<th> Ticket No </th>
				<th> Status </th>
				<th> Type </th>
				<th> Severity </th>
				<th> House Name </th>
				<th> Staff Name </th>
				<th> Date of Ticket </th>
				<th> Comments </th>
			</tr>
<?php
		$mysqli = connect_db();
		$sql_query = "CALL ViewMaintenanceTicketUser($peopleID);";
	
		$result = $mysqli->query($sql_query);
		if ($result == FALSE) {
			echo "Query failed: ".$mysqli->error.$nl;
		}
		else {
			while($row = $result->fetch_assoc())
			{
				$ticketNo = $row['TICKET NO'];
				$status = $row['STATUS'];
				$type = $row['Type'];
				$severity = $row['SEVERITY'];
				$housingname = $row['House Name'];
				$staffname = $row['Staff Name'];
				$dateTicket = $row['Date of Ticket'];
				$comments = $row['Comments'];
				//echo $course_number;
?>			
			<tr>
				<td><?php echo $ticketNo ?></td>
				<td><?php echo $status ?></td>
				<td><?php echo $type ?></td>
				<td><?php echo $severity ?></td>
				<td><?php echo $housingname ?></td>
				<td><?php echo $staffname ?></td>
				<td><?php echo $dateTicket ?></td>
				<td><?php echo $comments ?></td>
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
			// display set to something else;
		}
		
	}
?>
	
</section>
</body>
</html>