<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>View Cancel Request</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
	$("#view_req_container").click(function(){
	if($("#view_req").css('display') == 'none'){ 
	   $('#view_req').show('fast'); 	   
	} else { 
	   $('#view_req').hide('fast'); 
	}	
	});
});
$(document).ready(function(){
	$("#view_term_container").click(function(){
	if($("#view_term").css('display') == 'none'){ 
	   $('#view_term').show('fast'); 	   
	} else { 
	   $('#view_term').hide('fast'); 
	}	
	});
});
$(document).ready(function(){
	$("#cancel_req_container").click(function(){
	if($("#cancel_req").css('display') == 'none'){ 
	   $('#cancel_req').show('fast'); 
	} else { 
	   $('#cancel_req').hide('fast'); 
	}	
	});
});
$(document).ready(function(){
	$("#view-park").click(function(){
	if($("#view-park-div").css('display') == 'none'){ 
	   $('#view-park-div').show('fast'); 
	} else { 
	   $('#view-park-div').hide('fast'); 
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
		<span class="text-link" id="view-park">View Parking Requests</span><br/>
		<div id="view-park-div" style="display:none;"><br/>
		<table>
			<tr>
				<th> Request No. </th>
				<th> Lot ID </th>
				<th> Spot ID </th>
				<th> Student ID </th>
				<th> Status </th>
				<th> Type </th>
			</tr>
<?php
		$mysqli = connect_db();
		$sql_query = "CALL ViewParkingRequests($peopleID);";
	
		$result = $mysqli->query($sql_query);
		if ($result == FALSE) {
			echo "Query failed: ".$mysqli->error.$nl;
		}
		else {
			while($row = $result->fetch_assoc())
			{
				$request_no = $row['requestID'];
				$status = $row['status'];
				$lotID = $row['lotID'];
				$spotID = $row['spotID'];
				$type = $row['classification'];
				//echo $course_number;
?>			
			<tr>
				<td><?php echo $request_no ?></td>
				<td><?php echo $lotID ?></td>
				<td><?php echo $spotID ?></td>
				<td><?php echo $peopleID ?></td>
				<td><?php echo $status ?></td>
				<td><?php echo $type ?></td>
			</tr>
<?php
			}
		}
?>
		</table>
		</div>
			<div id="view_req_container"><span style="cursor:pointer">View Lease Requests</span></div><br>
				<div id="view_req" style="display:none;">
				<table>
				<tr>
					<th> LeaseRequestID </th>
					<th> PlaceID </th>
					<th> status </th>
					<th> startDate </th>
					<th> endDate </th>
					<th> rentalPeriod </th>
					<th> preference1 </th>
					<th> preference2 </th>
					<th> preference3 </th>
					<th> paymentMode </th>
					<th> parkingNeeded </th>
				</tr>	
					
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT * FROM `dummy3`.`lease_request` WHERE peopleID = $peopleID AND status = 'Pending';";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					while($row = $result->fetch_assoc())
					{
						$LeaseRequestID = $row['LeaseRequestID'];
						$PlaceID = $row['PlaceID'];
						$status = $row['status'];
						$startDate = $row['startDate'];
						$endDate = $row['endDate'];
						$rentalPeriod = $row['rentalPeriod'];
						$preference1 = $row['preference1'];
						$preference2 = $row['preference2'];
						$preference3 = $row['preference3'];
						$paymentMode = $row['paymentMode'];
						$parkingNeeded = $row['parkingNeeded'];
						//echo $course_number;
?>
				<tr>
					<td><?php echo $LeaseRequestID ?></td>
					<td><?php echo $PlaceID ?></td>
					<td><?php echo $status ?></td>
					<td><?php echo $startDate ?></td>
					<td><?php echo $endDate ?></td>
					<td><?php echo $rentalPeriod ?></td>
					<td><?php echo $preference1 ?></td>
					<td><?php echo $preference2 ?></td>
					<td><?php echo $preference3 ?></td>
					<td><?php echo $paymentMode ?></td>
					<td><?php echo $parkingNeeded ?></td>
				</tr>
<?php
					}
				}
?>
				</table><br/>
				<button value="Back" align="middle" type="button" onclick="location.href='/DB/housing.php?peopleType=student'" style="width:21.25%; height:35px">Back</button>
				
				</div>
			<div id="view_term_container"><span style="cursor:pointer" class="text-link">View Terminate Requests</span></div><br>
				<div id="view_term" style="display:none;">
				<table>
				<tr>
					<th> RequestID </th>
					<th> placeID </th>
					<th> status </th>
					<th> terminateDate </th>
					<th> inspectionDate </th>
					<th> leaseID </th>
					<th> comments </th>
				</tr>	
					
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT * FROM `dummy3`.`terminate_request` WHERE peopleID = $peopleID AND status = 'pending';";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					while($row = $result->fetch_assoc())
					{
						$RequestID = $row['RequestID'];
						$placeID = $row['placeID'];
						$status = $row['status'];
						$terminateDate = $row['terminateDate'];
						$inspectionDate = $row['inspectionDate'];
						$leaseID = $row['leaseID'];
						$comments = $row['comments'];
						//echo $course_number;
?>
				<tr>
					<td><?php echo $RequestID ?></td>
					<td><?php echo $placeID ?></td>
					<td><?php echo $status ?></td>
					<td><?php echo $terminateDate ?></td>
					<td><?php echo $inspectionDate ?></td>
					<td><?php echo $leaseID ?></td>
					<td><?php echo $comments ?></td>
				</tr>
<?php
					}
				}
?>
				</table><br/>
				<button value="Back" align="middle" type="button" onclick="location.href='/DB/housing.php?peopleType=student'" style="width:21.25%; height:35px">Back</button>
				
				</div>	
			<div id="cancel_req_container"><br/><span style="cursor:pointer">Cancel Request</span></div><br>
				<div id="cancel_req" style="display:none;">
					<form action="cancel_req.php" method=POST>
					<div id="cancel-req-box"><strong>Enter request number:</strong><input name="req_no" id="req_no" type="text" placeholder="Enter number here." style="width: 200px;position:absolute; left:300px; margin-left:5em" required/><br /><br/></div><br /><br />
					<div id="cancel-req-box"><strong>Enter Type:</strong>
					<select name="type" id="type" style="width: 200px; position:absolute; left:300px; margin-left:5em" required >
							  <option value="" disabled selected>Select your option</option>
							  <option value="Parking">Parking</option>
							  <option value="Lease">Lease</option>
							  <option value="Terminate">Terminate</option>
							</select><br/>
					<input value="Submit!" type="submit" align="middle" style="width:21.25%; height:35px" />&nbsp&nbsp
					<button value="Back" align="middle" type="button" onclick="location.href='/DB/housing.php?peopleType=student'" style="width:21.25%; height:35px">Back</button>
					</form><br/><br/>
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