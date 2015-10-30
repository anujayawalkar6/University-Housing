<?php
	session_start();
    $peopleType=$_SESSION['peopleType'];
    if($peopleType == NULL)
    {
        die('You have no reason being here !');
    }
    else 
    {
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
<div id='LeaseRquests'>
<strong> Lease Requests</strong>  <br />  
<?php 
    
include "database.php";
$peopleID = $_SESSION['peopleID'];
//echo "staff id is ".$staffID;
$mysqli = connect_db();
$nl ="<br /><br />";	
$querySuccessString="Query executed succesfully ! ";

/***Get ID of Staff ***/
$sql_query_lease_req = "SELECT * FROM Lease_Request";

$result_lease_req = $mysqli->query($sql_query_lease_req);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_lease_req == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result_lease_req)) {
                $count++; 
                //echo "PeopleID: ".$row['PeopleID'];   
                $leaseReqID= $row['LeaseRequestID'];
                $count = (String)$count ; 
                $leasreqTxt = "Lease Request # ".$count ;
                echo"<b><A HREF='./lease_req_details.php?leaseReqID=$leaseReqID'>$leasreqTxt</A><p></b>";									
            }

            
}


?>

</div>    
    
    
<div id='TerminatedLeaseRquests'>
<br />
<strong>Terminated Lease Requests</strong>    
<br />
    
<?php    
    
$sql_query_term_lease_req = "SELECT * FROM Terminate_Request";

$result_term_lease_req = $mysqli->query($sql_query_term_lease_req);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_term_lease_req == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result_term_lease_req)) {
                $count++; 
                //echo "PeopleID: ".$row['PeopleID'];   
                $leaseReqID= $row['RequestID'];
                $count = (String)$count ; 
                $leasreqTxt = "Terminate Request # ".$count ;
                echo"<b><A HREF='./terminate_req_details.php?leaseReqID=$leaseReqID'>$leasreqTxt</A><p></b>";									
            }

            
}


?>
</div>    
    

<br />
<strong>Maintenance Tickets</strong>    
<br />
<div id='criticalTickets'>    
<i>Critical Tickets</i>
<br />
<?php    
    
$sql_query_ticket = " SELECT * FROM Maintenance_Ticket WHERE ticketSeverity=3 AND  staffID=".$peopleID;

$result_ticket = $mysqli->query($sql_query_ticket);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_ticket == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result_ticket)) {
                $count++; 
                //echo "PeopleID: ".$row['PeopleID'];   
                $ticketID= $row['ticketNo'];
                $count = (String)$count ; 
                $ticketTxt = "Critical Ticket # ".$count ;
                echo"<b><A HREF='./ticket_details.php?ticketID=$ticketID'>$ticketTxt</A><p></b>";									
            }

            
}


?>    
</div>
    
<div id='normalTickets'>    
<i>Medium Tickets</i>
<br />
<?php    
    
$sql_query_ticket = " SELECT * FROM Maintenance_Ticket WHERE ticketSeverity=2 AND  staffID=".$peopleID;

$result_ticket = $mysqli->query($sql_query_ticket);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_ticket == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result_ticket)) {
                $count++; 
                //echo "PeopleID: ".$row['PeopleID'];   
                $ticketID= $row['ticketNo'];
                $count = (String)$count ; 
                $ticketTxt = "Normal Ticket # ".$count ;
                echo"<b><A HREF='./ticket_details.php?ticketID=$ticketID'>$ticketTxt</A><p></b>";									
            }

            
}


?>    
</div>
    
<p>
<div id='lowTickets'>    
<i>Low Tickets</i>
<br />
<?php    
    
$sql_query_ticket = " SELECT * FROM Maintenance_Ticket WHERE ticketSeverity=1 AND  staffID=".$peopleID;

$result_ticket = $mysqli->query($sql_query_ticket);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_ticket == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result_ticket)) {
                $count++; 
                //echo "PeopleID: ".$row['PeopleID'];   
                $ticketID= $row['ticketNo'];
                $count = (String)$count ; 
                $ticketTxt = "Low Ticket # ".$count ;
                echo"<b><A HREF='./ticket_details.php?ticketID=$ticketID'>$ticketTxt</A><p></b>";									
            }

            
}


?>    
</div>
    
</p>    
<br />    
<div id='ParkingPermit'>
<strong>Parking Permit Requests</strong>
<br />
<?php    
    
$sql_query_parking = " SELECT * FROM Parking_Requests";

$result_parking = $mysqli->query($sql_query_parking);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_parking == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            
            //$row = mysqli_fetch_assoc($result);
            while($row = mysqli_fetch_assoc($result_parking)) {
                $count++; 
                //echo "PeopleID: ".$row['PeopleID'];   
                $requestID= $row['requestID'];
                $count = (String)$count ; 
                $reqTxt = "Request ID # ".$count ;
                echo"<b><A HREF='./parking_request_details.php?requestID=$requestID'>$reqTxt</A><p></b>";									
            }

            
}


?>        
</div>   
    
<p>
<div id='ParkingSpot'>
<strong>Parking Spots</strong>
<br />
<?php    
    
$sql_query_parking = " SELECT * FROM Parking_Spot";

$result_parking = $mysqli->query($sql_query_parking);
//$result = mysql_query($sql_query);
$count = 0 ;

if ($result_parking == FALSE)
{
		echo "Query failed: ".$mysqli->error.$nl;
}    
else
{
    		echo $querySuccessString.$nl;
            echo"<br />";
            echo"<table style='width:50%'>";
            echo"<tr><th>Spot ID</th><th>Lot ID</th><th>Classification</th><th>Availability</th><th>Category</th></tr>";
            echo"<br />";
            while($row = mysqli_fetch_assoc($result_parking)) {
                $count++; 
                echo"<tr>";
                echo "<td>".$row['spotID'];   
                echo "</td>";
                echo "<td>".$row['lotID'];                   
                echo "</td>";
                echo "<td>".$row['classification'];   
                echo "</td>";
                echo "<td>".$row['availability']."</td>";            
                echo "<td>".$row['category']."</td>";   
                echo"</tr>";
            }
        echo"</table>";
}


?>        
</div>   
</p>
<?php    
    }
?>
</section>
</body>
</html> 