<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Parking</title>
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
<div id="parking-options">
	<div class ="parking-container">
	<span class="text-link" id="request-new-park">Request new parking spot</span><br/>
		<div id="request-new-park-div" style="display:none;"><br/>
		<form action="new-parking.php" method=POST>
		<table style="border: 0px; text-align: left;">
		<tr style="border: 0px; text-align: left;"> 
			<td style="border: 0px; text-align: left;"><b>Vehicle Type:</b></td>
			<td style="border: 0px; text-align: left;"><select name="vehicle-type" id="vehicle-type" required>
					<option value="" disabled selected>Select your option</option>
					<option value="Bike">Bike</option>
					<option value="Small Car">Compact Car</option>
					<option value="Small Car">Standard Car</option>
					<option value="Large Car">Large Car</option>
				</select></td>
		</tr>
		<tr style="border: 0px; text-align: left;">
			<td style="border: 0px; text-align: left;"><b>Handicapped ?:</b></td>
			<td style="border: 0px; text-align: left;"><select name="handicap" id="handicap" required>
					<option value="" disabled selected>Select your option</option>
					<option value="yeshc">Yes</option>
					<option value="nohc">No</option>
				</select></td>
		</tr>
		<tr>
			<td style="border: 0px; text-align: left;"><b>Nearby Parking Spot ?:</b></td>
			<td style="border: 0px; text-align: left;"><select name="nearby" id="nearby" required>
					<option value="" disabled selected>Select your option</option>
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select></td>
		</tr>
		</table><br/>
		<input value="Submit!" type="submit" style="width:21.25%; height:35px" />&nbsp&nbsp
		<button value="Back" type="button" onclick="location.href='/DB/index.php'" style="width:21.25%; height:35px">Back</button>
		</form>
		</div>
	</div>
	
	<div class ="parking-container">
	<span class="text-link" id="view-park">View Request Status</span><br/>
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
	</div>
	
	<div class ="parking-container">
	<span class="text-link" id="view-curr-park">View Current parking information</span><br/>
		<div id="view-curr-park-div" style="display:none;"><br/>
		<table>
			<tr>
				<th> Spot ID </th>
			</tr>
<?php
		$mysqli = connect_db();
		$sql_query = "SELECT spotID FROM `dummy3`.`people` WHERE peopleID = $peopleID;";

	
		$result = $mysqli->query($sql_query);
		if ($result == FALSE) {
			echo "Query failed: ".$mysqli->error.$nl;
		}
		else {
			while($row = $result->fetch_assoc())
			{
				$spotID = $row['spotID'];
				//echo $course_number;
?>			
			<tr>
				<td><?php echo $spotID ?></td>
			</tr>
<?php
			}
		}
?>
		</table>
		</div>		
	</div>
	
	<div class ="parking-container">
	<span class="text-link" id="renew-park">Renew Parking permit</span><br/>
		<div id="renew-park-div" style="display:none;"><br/>
			<form action="update_park.php" method=POST>
			<table style="border: 0px; text-align: left;">
			<tr style="border: 0px; text-align: left;">
				<td style="border: 0px; text-align: left;"><strong>Your Parking Spot ID:</strong></td>
				<td style="border: 0px; text-align: left;"><span><?php echo $spotID ?></span></td>
			</tr>
			</table><br/>
			<input value="renew" name="permit_action" type="text" style="display:none;"/>
			<input value="Submit!" type="submit" align="middle" style="width:21.25%; height:35px" />&nbsp&nbsp
			<button value="Back" align="middle" type="button" onclick="location.href='/DB/index.php'" style="width:21.25%; height:35px">Back</button>
			</form><br/><br/>
		</div>
	</div>
	
	<div class ="parking-container">
	<span class="text-link" id="return-park">Return Parking permit</span><br/>
		<div id="return-park-div" style="display:none;"><br/>
			<form action="update_park.php" method=POST>
			<table style="border: 0px; text-align: left;">
			<tr style="border: 0px; text-align: left;">
				<td style="border: 0px; text-align: left;"><strong>Your Parking Spot ID:</strong></td>
				<td style="border: 0px; text-align: left;"><span><?php echo $spotID ?></span></td>
			</tr>
			</table><br/>
			<input value="return" name="permit_action" type="text" style="display:none;"/>
			<input value="Submit!" type="submit" align="middle" style="width:21.25%; height:35px" />&nbsp&nbsp
			<button value="Back" align="middle" type="button" onclick="location.href='/DB/index.php'" style="width:21.25%; height:35px">Back</button>
			</form><br/><br/>
		</div>
	</div>
	
	<div class ="parking-container">
	<span class="text-link" id="view-park-status">View Parking Lot Information</span><br/>
		<div id="view-park-status-div" style="display:none;"><br/>
		<table>
		<tr>
			<th> Spot ID </th>
			<th> Available</th>
			<th> Lot Number</th>
			<th> Lot Name</th>
			<th> House ID</th>
			<th> House Name</th>
		</tr>
		
<?php
		$mysqli = connect_db();
		$sql_query = "CALL ViewParkingLotInfo();";

	
		$result = $mysqli->query($sql_query);
		if ($result == FALSE) {
			echo "Query failed: ".$mysqli->error.$nl;
		}
		else {
			while($row = $result->fetch_assoc())
			{
				$spotID = $row['SPOT ID'];
				$available = $row['AVAILABLE'];
				$lotNum = $row['LOT NUM'];
				$lotName = $row['LOT NAME'];
				$housingID = $row['HOUSE ID'];
				$housingName = $row['HOUSE NAME'];
				//echo $course_number;
?>			
			<tr>
				<td><?php echo $spotID ?></td>
				<td><?php echo $available ?></td>
				<td><?php echo $lotNum ?></td>
				<td><?php echo $lotName ?></td>
				<td><?php echo $housingID ?></td>
				<td><?php echo $housingName ?></td>
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