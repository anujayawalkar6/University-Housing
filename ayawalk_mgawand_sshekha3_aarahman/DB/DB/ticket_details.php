<?php
	session_start();
    $peopleType=$_SESSION['peopleType'];
    if($peopleType == NULL)
    {
        die('You have no reason being here !');
    }
    else 
    {
        $peopleID = $_SESSION['peopleID'];
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
    
include "database.php";


$mysqli = connect_db();
$nl ="<br /><br />";	
$querySuccessString="Query executed succesfully ! ";
$ticketID="" ;



$ticketID=$_GET['ticketID'];
// Getting values from Table Lease_Request 
$sql_query = "SELECT * FROM Maintenance_Ticket WHERE ticketNo='".$ticketID."'";


echo "Displaying results for Ticket ID: ".$ticketID.$nl;



$result = $mysqli->query($sql_query);
if ($result == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;

            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result)) {
                $ticketID= $row['ticketNo'] ;
                
?>   
    
			Ticket ID                :                <?php echo $ticketID ; ?><br/>    
			Approval Status          :                <?php echo $row['peopleID']; ?><br/>    
			Staff ID                 :                <?php echo $row['staffID']; ?><br/>    
			Ticket Status            :                <?php echo $row['ticketStatus']; ?><br/>    
			Ticket Severity          :                <?php echo $row['ticketSeverity']; ?><br/>    
			Student ID               :                <?php echo $row['peopleID']; ?><br/>        
            Comments                 :                <?php echo $row['comments']; ?><br/>        
            Ticket Date              :                <?php echo $row['ticketDate']; ?><br/>        
            Ticket Issue             :                <?php echo $row['ticketIssue']; ?><br/>        
            Student Name             :                <?php echo $row['peopleName']; ?><br/>            
			House ID                 :                <?php echo $row['housingID']; ?><br/>            
    
<?php                
                
            }

            
}

?>
<br />
<div id='updateForm'>
<strong> Want to Update Ticket?</strong> <br />
<form action='ticket_details.php?ticketID=<?php echo $ticketID; ?>' method='POST' name='ticket_update' >
Enter Ticket Status: <input type='text' name='statusTextBox' id='statusTextBox'></input>
<br />    
<input type='submit' value='Update'>
</form>
<br />    
</div>  

<?php 

    $status = null ;
    if(isset($_POST['statusTextBox']))
    {
        $status = $_POST['statusTextBox'];    
    }
    $ticketID=$_GET['ticketID'];    
    if($status != null)
    {
        //echo "blah" ;
        $sql_update_query = " CALL UpdateTicketStatus(".$ticketID.", ".$peopleID.", '".$status."');" ;
        $sql_update_result = $mysqli->query($sql_update_query);
        if ($sql_update_result == FALSE)
        {
                echo "Query failed: ".$mysqli->error.$nl;
        }    
        else
        {
                    echo "Updated succesfully ! ".$nl;
        }    
        
    }

    }

?>
<div id='goBack'>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</div>   
</section>
</body>
</html> 