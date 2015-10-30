<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>DB</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
	
</head>
<body>
	<script src="jquery.js"></script>
	<script>
	$(document).ready(function() {

	});
	</script>
<?php

	include "header.php";

?>
<section>
<?php 
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		$nl = "<br />";
		
		include "database.php";

		$ID = $_SESSION['ID'];
		$peopleType = $_SESSION['peopleType'];
		$peopleID = $_SESSION['peopleID'];
		//echo $peopleType;
		
		if(!strcmp($peopleType,'student'))
		{
?>			
			<div id="StudentSection"><h1>Student Section</h1></div>
			<div id="student-home">
				<a class="text-link" href="housing.php?<?php echo "peopleType=".$peopleType;?>">Housing</a><br/>
				<a class="text-link" href="parking.php?<?php echo "peopleType=".$peopleType;?>">Parking</a><br/>
				<a class="text-link" href="maintenance.php?<?php echo "peopleType=".$peopleType;?>">Maintenance</a><br/>
				<a class="text-link" href="profile.php?<?php echo "peopleType=".$peopleType;?>">Profile</a><br/><br/>
				<a class="text-link" href="index.php">Back</a><br/>
			</div>
<?php
		}
		else if(!strcmp($peopleType,'guest'))
		{
?>			
			<div id="StudentSection"><h1>Guest Section</h1></div>
			<div id="student-home">
				<a class="text-link" href="housing.php?<?php echo "peopleType=".$peopleType;?>">Housing</a><br/>
				<a class="text-link" href="parking.php?<?php echo "peopleType=".$peopleType;?>">Parking</a><br/>
				<a class="text-link" href="maintenance.php?<?php echo "peopleType=".$peopleType;?>">Maintenance</a><br/>
				<a class="text-link" href="profile.php?<?php echo "peopleType=".$peopleType;?>">Profile</a><br/><br/>
				<a class="text-link" href="index.php">Back</a><br/>
			</div>
<?php
		}
		else
		{
			{
            echo "<strong>Logged in as staff</strong> <br/>";
?>
    
			<div id="StaffSection"><h1>Staff Section</h1></div>
			<div id="staff-home">
                <strong><a class="text-link" href="admin_dashboard.php">Dashboard</a></strong><br/><br/>
				<a class="text-link" href="index.php">Back</a><br/>
			</div>        
<?php    
        }
		}

	}
	else 
	{

?>
<br /><br />
<div id="Title">Sign In</div>
	<div id="login-form">
		<div id="inner-login-form">
		<form action="login.php" method=POST >
			<span class="form-label"><label for="Username"><strong>Username</strong></label></span>
			<input name="Username" id="Username" type="text" class="text"/>
			<br /><br />
			<span class="form-label"><label for="Password"><strong>Password</strong></label><em> &nbsp&nbsp <a href="">Forgot your password?</a></em></span>
			<input name="Password" id="Password" type="password" class="text"/><br /><br />
			<input value="Log in!" type="submit" align="middle" style="width:22.5%; height:35px" />
		</form>
		</div>
	</div>
<?php
	}
?>
</section>
</body>
</html>