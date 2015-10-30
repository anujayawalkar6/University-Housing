<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Profile</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
	$("#view-profile").click(function(){
	if($("#right-menu-view").css('display') == 'none'){ 
		$('#right-menu-view').show('fast');
		$('#right-menu-update').hide('fast'); 	   
	} else {
		if($("#right-menu-update").css('display') == 'none'){
			$('#right-menu-view').show('fast');
		}
		else{
			$('#right-menu-view').hide('fast');	
		}
	}	
	});
});
$(document).ready(function(){
	$("#update-profile").click(function(){
	if($("#right-menu-update").css('display') == 'none'){ 
	   $('#right-menu-update').show('fast'); 
	   $('#right-menu-view').hide('fast');
	} else { 
		if($("#right-menu-view").css('display') == 'none'){
			$('#right-menu-update').show('fast');
		}
		else{
		$('#right-menu-update').hide('fast'); 
		}
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
			$mysqli = connect_db();

			$sql_query = "SELECT * FROM `dummy3`.`people` WHERE peopleID = '$peopleID';"; //HARDCODING PEOPLEID VALUE. TABLE ENTRIES NEED TO BE CORRECT
		
			$result = $mysqli->query($sql_query);
			if ($result == FALSE) {
				echo "Query failed: ".$mysqli->error.$nl;
				//echo "asdfasdfasdfas";
			}
			else {
				//echo "asdwerqqqqqqqqqqqqqq";
				$row = mysqli_fetch_assoc($result);
				//echo $row;
				$currentStatus = $row['currentStatus'];
				//echo $row['currentStatus'];
				$category = $row['category'];
				$available = $row['available'];
				$sex = $row['sex'];

				$specialNeeds = $row['specialNeeds'];
				$nationality = $row['nationality'];
				$courseName = $row['courseName'];
				$phone = $row['phone'];
				$alternatePhone = $row['alternatePhone'];
				$firstName = $row['firstName'];
				$lastName = $row['lastName'];
				$additional = $row['additionalComments'];
				$addressID = $row['addrID'];
				$housingID = $row['housingID'];
				$leaseID = $row['leaseID'];
				$permitID = $row['spotID'];
				$dob = $row['dateOfBirth'];
				
				//echo $dob."<br>";
			}
			$sql_query = "SELECT * FROM `dummy3`.`address` a WHERE a.addrID = '$addressID';";
		
			$result = $mysqli->query($sql_query);
			if ($result == FALSE) {
				echo "Query failed: ".$mysqli->error.$nl;
			}
			else {
				$row = mysqli_fetch_assoc($result);
				$street = $row['street'];
				$city = $row['city'];
				$zip = $row['zipcode'];
				$country = $row['country'];
			}
			
			// NEED SIMILAR QUERIES FOR LEASE ID AND PARKING PERMIT
?>
<div id="overall-container">
	<div id="top-button">
	<span id="view-profile" class="text-link">View Profile</span>
	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span id="update-profile" class="text-link">Update Profile</span><br/><br/>
	</div>
	<div id="profile-section">
		<div id="left-menu"><b>
			University ID:<br/><hr>
			First Name:<br/><hr>
			Last Name:<br/><hr>
			Street:<br/><hr>
			City:<br/><hr>
			Country:<br/><hr>
			Zip:<br/><hr>
			Permit:<br/><hr>
			Lease:<br/><hr>
			Status:<br/><hr>
			Category:<br/><hr>
			Date of Birth:<br/><hr>
			Sex:<br/><hr>
			Available:<br/><hr>
			Special Needs:<br/><hr>
			Nationality:<br/><hr>
			Course Name:<br/><hr>
			Phone:<br/><hr>
			Alt Phone:<br/><hr>
			Additional Comments:<br/><hr>
		</b>
		</div>
		<div id="right-menu">
			<div id="right-menu-view" style="display:block;">
				<?php echo $peopleID  ?><br/><hr>
				<?php echo $firstName  ?><br/><hr>
				<?php echo $lastName  ?><br/><hr>
				<?php echo $street ?><br/><hr>
				<?php echo $city ?><br/><hr>
				
				<?php echo $country ?><br/><hr>
				<?php echo $zip ?><br/><hr>
				<?php echo $permitID  ?><br/><hr>
				<?php echo $leaseID  ?><br/><hr>
				<?php echo $currentStatus  ?><br/><hr>
				<?php echo $category  ?><br/><hr>
				<?php echo $dob  ?><br/><hr>
				<?php echo $sex  ?><br/><hr>
				<?php echo $available  ?><br/><hr>
				<?php echo $specialNeeds  ?><br/><hr>
				<?php echo $nationality  ?><br/><hr>
				<?php echo $courseName  ?><br/><hr>
				<?php echo $phone  ?><br/><hr>
				<?php echo $alternatePhone  ?><br/><hr>
				<?php echo $additional  ?><br/><hr>
				<br/><br/><br/><br/><br/><br/>
			</form>
			</div>
			<div id="right-menu-update" style="display:none;">
			<form action="updateProfile.php" method=POST>
				<?php echo $peopleID  ?><br/><hr>
				<input type="text" style="height:11.5px;" name="firstName" value="<?php echo $firstName ?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="lastName" value="<?php echo $lastName ?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="street" value="<?php echo $street?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="city" value="<?php echo $city?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="zip" value="<?php echo $zip?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="country" value="<?php echo $country?>"/><br/><hr>
				<?php echo $permitID  ?><br/><hr>
				<?php echo $leaseID  ?><br/><hr>
				<?php echo $currentStatus ?><br/><hr>
				<?php echo $category ?><br/><hr>
				<?php echo $dob  ?><br/><hr>
				<?php echo $sex  ?><br/><hr>
				<input type="text" style="height:11.5px;" name="available" value="<?php echo $available ?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="specialNeeds" value="<?php echo $specialNeeds ?>"/><br/><hr>
				<?php echo $nationality  ?><br/><hr>
				<input type="text" style="height:11.5px;" name="courseName" value="<?php echo $courseName ?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="phone" value="<?php echo $phone ?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="alternatePhone" value="<?php echo $alternatePhone ?>"/><br/><hr>
				<input type="text" style="height:11.5px;" name="additional" value="<?php echo $additional ?>"/><br/><hr>
				<input value="Save changes!" type="submit" align="middle" style="width:15.25%; height:25px" />&nbsp&nbsp
				<button value="Back" align="middle" type="button" onclick="location.href='/DB/index.php'" style="width:15.25%; height:25px">Back</button>
				<br/><br/><br/><br/><br/><br/>
			</form>
			</div>
		</div>
	</div>
	<div id="bottom-button">
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