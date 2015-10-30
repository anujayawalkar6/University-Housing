<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>New Request</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#pref-1").focus(function(){
		var prevValue = $(this).val();
		$("#pref-1").change(function(){
			var value = $(this).val();
			$("#pref-2 option[value="+prevValue+"]").prop('disabled',false);
			$("#pref-3 option[value="+prevValue+"]").prop('disabled',false);
			
			$("#pref-2 option[value="+value+"]").prop('disabled',true);
			$("#pref-3 option[value="+value+"]").prop('disabled',true);
			});
	});
});
$(document).ready(function(){
	$("#pref-2").focus(function(){
		var prevValue = $(this).val();
		$("#pref-2").change(function(){
			var value = $(this).val();
			$("#pref-1 option[value="+prevValue+"]").prop('disabled',false);
			$("#pref-3 option[value="+prevValue+"]").prop('disabled',false);
			
			$("#pref-1 option[value="+value+"]").prop('disabled',true);
			$("#pref-3 option[value="+value+"]").prop('disabled',true);
			});
	});
});	
$(document).ready(function(){
	$("#pref-3").focus(function(){
		var prevValue = $(this).val();
		$("#pref-3").change(function(){
			var value = $(this).val();
			$("#pref-1 option[value="+prevValue+"]").prop('disabled',false);
			$("#pref-2 option[value="+prevValue+"]").prop('disabled',false);
			
			$("#pref-1 option[value="+value+"]").prop('disabled',true);
			$("#pref-2 option[value="+value+"]").prop('disabled',true);
			});
	});
});
$(document).ready(function(){
	$("#new_lease_req_container").click(function(){
	if($("#new_lease_req").css('display') == 'none'){ 
	   $('#new_lease_req').show('slow');
		$('#terminate_req').hide('slow'); 	   
	} else { 
	   $('#new_lease_req').hide('slow'); 
	}	
	});
});
$(document).ready(function(){
	$("#terminate_req_container").click(function(){
	if($("#terminate_req").css('display') == 'none'){ 
	   $('#terminate_req').show('slow'); 
	   $('#new_lease_req').hide('slow');
	} else { 
	   $('#terminate_req').hide('slow'); 
	}	
	});
});
$(document).ready(function(){
	$("#find-like").click(function(){
	if($("#find-like-div").css('display') == 'none'){ 
	   $('#find-like-div').show('fast'); 
	} else { 
	   $('#find-like-div').hide('fast'); 
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
			
			<div id="new_lease_req_container"><span style="cursor:pointer">New Lease Request</span></div><br>
				<div id="new_lease_req" style="display:none;">
				
					<form action="new_lease_req.php" method=POST>
						<div id="period-leave"><span class="form-label"><label for="period"><strong>Starting Period:</strong></label></span>

							<select name="startperiod" id="startperiod" style="width: 200px; position:absolute; left:300px; margin-left:5em" required >
							   <option value="" disabled selected>Select your option</option>
							  <option value="Fall">Semester 1 - Fall</option>
							  <option value="Spring">Semester 2 - Spring</option>
							  <option value="Summer">Summer</option>
							</select><br/><br/>
							<span class="form-label"><label for="period"><strong>End Period:</strong></label></span>

							<select name="endperiod" id="endperiod" style="width: 200px; position:absolute; left:300px; margin-left:5em" required >
							   <option value="" disabled selected>Select your option</option>
							  <option value="1">1 Semester</option>
							  <option value="2">2 Semesters</option>
							  <option value="3">Entire Year</option>
							</select><br/>
						</div>
						<br />
						<div id="period-leave"><span class="form-label"><label for="housing-pref"><strong>Housing Preferences:</strong></label></span><br/><br/>
						<label for="period">Preference 1</label>
							<select name="housing-pref-1" id="pref-1" style="width: 200px; position:absolute; left:300px; margin-left:5em " required>
							  <option value="" disabled selected>Select your option</option>
							  
<?php
									$mysqli = connect_db();
									$sql_query = "SELECT housingID, housingname, type FROM housing;";
								
									$result = $mysqli->query($sql_query);
									if ($result == FALSE) {
										echo "Query failed: ".$mysqli->error.$nl;
									}
									else {
										while($row = $result->fetch_assoc())
										{
											$housingID = $row['housingID'];
											$housingname = $row['housingname'];
											$type = $row['type'];
?>
											<option value="<?php echo $housingID?>"><?php echo $housingID." - ".$housingname?></option>
<?php											
										}
									}
?>
									</select><br/><br/>	  
						<label for="period">Preference 2</label>
							<select name="housing-pref-2" id="pref-2" style="width: 200px; position:absolute; left:300px; margin-left:5em" required>
							  <option value="" disabled selected>Select your option</option>
<?php
									$mysqli = connect_db();
									$sql_query = "SELECT housingID, housingname, type FROM housing;";
								
									$result = $mysqli->query($sql_query);
									if ($result == FALSE) {
										echo "Query failed: ".$mysqli->error.$nl;
									}
									else {
										while($row = $result->fetch_assoc())
										{
											$housingID = $row['housingID'];
											$housingname = $row['housingname'];
											$type = $row['type'];
?>
											<option value="<?php echo $housingID?>"><?php echo $housingID." - ".$housingname?></option>
<?php											
										}
									}
?>
							</select><br/><br/>
						<label for="period">Preference 3</label>
							<select name="housing-pref-3" id="pref-3" style="width: 200px; position:absolute; left:300px; margin-left:5em" required>
							  <option value="" disabled selected>Select your option</option>
<?php
									$mysqli = connect_db();
									$sql_query = "SELECT housingID, housingname, type FROM housing;";
								
									$result = $mysqli->query($sql_query);
									if ($result == FALSE) {
										echo "Query failed: ".$mysqli->error.$nl;
									}
									else {
										while($row = $result->fetch_assoc())
										{
											$housingID = $row['housingID'];
											$housingname = $row['housingname'];
											$type = $row['type'];
?>
											<option value="<?php echo $housingID?>"><?php echo $housingID." - ".$housingname?></option>
<?php											
										}
									}
?>
							</select><br/><br/>
						</div>	<br />
						<div id="period-leave"><strong>Date:</strong><input name="date" id="date" type="date" style="width: 200px; position:absolute; left:300px; margin-left:5em" /><br /><br/></div>	<br />
						<div id="period-leave"><span class="payment"><label for="payment"><strong>Payment Method</strong></label></span>
							<select name="payment" id="payment" style="width: 200px; position:absolute; left:300px; margin-left:5em" required>
							  <option value="" disabled selected>Select your option</option>
							  <option value="Monthly">Monthly</option>
							  <option value="Semester">Once a sem</option>
							</select><br/>
						</div><br />
						<div id="period-leave"><strong>Parking Needed:</strong><input name="parkNeeded" id="parkNeeded" type="checkbox" value="Yes" style="width: 200px; position:absolute; left:300px; margin-left:5em" /><br /><br/></div>	<br />
						<input value="Submit!" type="submit" align="middle" style="width:21.25%; height:35px" />&nbsp&nbsp
						<button value="Back" align="middle" type="button" onclick="location.href='/DB/housing.php?peopleType=student'" style="width:21.25%; height:35px">Back</button>
					</form><br/><br/>
				</div>
			<div id="terminate_req_container"><span style="cursor:pointer">Terminate Lease Request</span></div><br>
				<div id="terminate_req" style="display:none;">
					<form action="terminate_req.php" method=POST>
					<div id="term-leave"><strong>Date:</strong><input name="date" id="date" type="date" style="width: 200px; position:absolute; left:300px; margin-left:5em" required/><br /></div><br />
					<div id="term-leave-reason"><strong>Reason for leaving:</strong><input name="reason" id="reason" type="text" maxlength="30" placeholder="Type message here." style="width: 200px;height: 100px; position:absolute; left:300px; margin-left:5em"/><br /><br/></div><br />
					<input value="Submit!" type="submit" align="middle" style="width:21.25%; height:35px" />&nbsp&nbsp
					<button value="Back" align="middle" type="button" onclick="location.href='/DB/housing.php?peopleType=student'" style="width:21.25%; height:35px">Back</button>
					</form><br/><br/>
				</div>
				
			<div id="find-like"><span style="cursor:pointer" class="text-link">Find Roommate with best matches !</span></div><br>
				<div id="find-like-div" style="display:none;">
<?php
				$mysqli = connect_db();
				$sql_query = "CALL roommatematching($peopleID);";

				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
						$row = mysqli_fetch_assoc($result);
						$likeness = $row['likeness'];
						$matepeopleID = $row['peopleID'];
				}
				

?>
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT CONCAT(firstName,' ',lastName) AS name, housingID FROM people WHERE peopleID = $matepeopleID";

				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
						$row = mysqli_fetch_assoc($result);
						$matename = $row['name'];
						$matehouseID = $row['housingID'];
						//echo $row['name'];
				}
?>
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT housingname FROM housing WHERE housingID = $matehouseID";

				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
						$row = mysqli_fetch_assoc($result);
						$matehousename = $row['housingname'];
						//echo $row['name'];
				}
?>
	
				<strong>Name: <?php echo $matename ?></strong><br/>
				<strong>ID: <?php echo $matepeopleID ?></strong><br/>
				<strong>Housing ID: <?php echo $matehouseID ?></strong><br/>
				<strong>Housing Name: <?php echo $matehousename ?></strong><br/>
				<strong>Likeness Rating: <?php echo $likeness ?></strong><br/>
				<br/><br/>
<?php
				$mysqli = connect_db();
				$sql_query = "UPDATE likeness SET likeness = 0";

				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {

				}
?>				
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