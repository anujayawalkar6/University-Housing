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
    
include "database.php";


$mysqli = connect_db();
$nl ="<br /><br />";	
$querySuccessString="Query executed succesfully ! ";
$reqID="" ;



$reqID=$_GET['requestID'];
// Getting values from Table Lease_Request 
$sql_query = "SELECT * FROM Parking_Requests WHERE requestID='".$reqID."'";


//echo "Displaying results for Parking Requests : ".$reqID.$nl;



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
                $reqID= $row['requestID'] ;
                
?>   
    
            Request ID          :                <?php echo $reqID ; ?><br/>    
			Student ID          :                <?php echo $row['peopleID']; ?><br/>    
			Lot No              :                <?php echo $row['lotID']; ?><br/>    
            Spot No             :                <?php echo $row['spotID']; ?><br/>    
            Status              :                <?php echo $row['status']; ?><br/>     
            Housing ID          :                <?php echo $row['housingID']; ?><br/>    
            Classification      :                <?php echo $row['classification']; ?><br/>        
    
    
<?php                
                
            }

            
}

?>
<br />
<div id='processForm'>
<strong> Want to Process ?</strong> <br />
<form action='parking_request_details.php?requestID=<?php echo $reqID; ?>' method='POST' name='req_process' >
Enter Parking Request ID: <input type='text' name='IDTextBox' id='IDTextBox'></input>

<br />    
<input type='submit' value='Hit Process !'>
</form>
<br />    
</div>  

<?php 

    $ID = null ;

    if(isset($_POST['IDTextBox']))
    {
        $ID = $_POST['IDTextBox'];    
    }


    
    if($ID != null )
    {
        

        
        $sql_update_query = " CALL ProcessParkingRequest(".$ID.");" ;
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
    

?>
<p>
<br />
<div id='parkingSpotForm'>
<strong> Want to Return Parking Spot ?</strong> <br />
<form action='parking_request_details.php?requestID=<?php echo $reqID; ?>' method='POST' name='spot_return' >
Enter Parking Spot ID: <input type='text' name='spotIDTextBox' id='spotIDTextBox'></input>

<br />    
<input type='submit' value='Hit Return !'>
</form>
<br />    
</div>  

<?php 

    $spotID = null ;

    if(isset($_POST['spotIDTextBox']))
    {
        $spotID = $_POST['spotIDTextBox'];    
    }
    if($spotID != null )
    {
        $sql_update_query = "  CALL ReturnParkingSpot(".$spotID.");" ;
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
    

?>
    
</p>    
<p>    
<br />
<div id='cancelForm'>
<strong> Want to Cancel ?</strong> <br />
<form action='parking_request_details.php?requestID=<?php echo $reqID; ?>' method='POST' name='req_canacel' >
Enter Parking Request ID: <input type='text' name='IDTextBox1' id='IDTextBox1'></input>

<br />    
<input type='submit' value='Hit Cancel !'>
</form>
<br />    
</div>  
<br />
    
<?php 

    $ID1 = null ;

    if(isset($_POST['IDTextBox1']))
    {
        $ID1 = $_POST['IDTextBox1'];    
    }


    
    if($ID1 != null )
    {
        

        
        $sql_update_query1 = " CALL CancelParkingRequest(".$ID1.");" ;
        $sql_update_result1 = $mysqli->query($sql_update_query1);
        if ($sql_update_result1 == FALSE)
        {
                echo "Query failed: ".$mysqli->error.$nl;
        }    
        else
        {
                    echo "Updated succesfully ! ".$nl;
        }            
        
    
    }
    

?>    
</p>    
    
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