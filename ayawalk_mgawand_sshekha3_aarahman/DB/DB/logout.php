<?php
	session_start();
	unset($_SESSION['loggedin']);
	unset($_SESSION['ID']);
	unset($_SESSION['fullname']);
	unset($_SESSION['peopleID']);
	unset($_SESSION['peopleType']);
	// TODO: Other stuff for logging out?
	header('Location: index.php');
?>