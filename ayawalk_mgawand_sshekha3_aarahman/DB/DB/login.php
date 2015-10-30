<?php
	session_start();
	if (!empty($_POST['Username']) && !empty($_POST['Password']))
	{
		include "database.php";

		$ID = $_POST['Username'];
		$password = $_POST['Password'];
		
		// TODO: Check for MySQL Injection?
		
		// Authenticate
		$mysqli = connect_db();
		$login = 'Login';
		$password = md5($password);
		echo $ID;
		$sql_query = "SELECT * FROM $login WHERE `ID` = '$ID'";
		$result = $mysqli->query($sql_query);
		if ($result == FALSE) {
			echo "Query failed: ".$mysqli->error.$nl;
		}
		else if ($result->num_rows == 1) {
			// We got a row, now check if the password is OK
			$row = $result->fetch_assoc();

			if ($row['password'] == $password)
			{
				echo $row['author'];
				$_SESSION['loggedin'] = 1;
				$author = $_SESSION['author'] = $row['author'];
				$_SESSION['fullname'] = $row['firstName']." ".$row['lastName'];
				$_SESSION['peopleID'] = $row['ID'];
				$_SESSION['ID'] = $row['ID'];
				if ( !strcmp($author,'Student'))
					$_SESSION['peopleType'] = 'student';
				else if( !strcmp($author,'Staff'))
					$_SESSION['peopleType'] = 'staff';
				else
					$_SESSION['peopleType'] = 'guest';

				header('Location: index.php');
			}
			// Wrong Password
			header('Location: index.php');
		}
		else
		{
			// Username doesn't exist (or multiple usernames?)
			// TODO: Remove this
			header('Location: index.php');
		}
	}
	
	header('Location: index.php');
?>