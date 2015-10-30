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
$leaseReqID="" ;



$leaseReqID=$_GET['leaseReqID'];
// Getting values from Table Lease_Request 
$sql_query = "SELECT * FROM Lease_Request WHERE LeaseRequestID='".$leaseReqID."'";


echo "Displaying results for Lease Request ID: ".$leaseReqID.$nl;



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
                $leaseReqID= $row['LeaseRequestID'] ;
                
?>   
    
			Lease Request ID  :                <?php echo $leaseReqID ; ?><br/>    
			PeopleID          :                <?php echo $row['peopleID']; ?><br/>    
			Place ID          :                <?php echo $row['PlaceID']; ?><br/>    
			Status            :                <?php echo $row['status']; ?><br/>    
			Start Date        :                <?php echo $row['startDate']; ?><br/>    
			Rental Period     :                <?php echo $row['rentalPeriod']; ?><br/>    
			First Preference  :                <?php echo $row['preference1']; ?><br/>        
			Second Preference :                <?php echo $row['preference2']; ?><br/>        
            Third Preference  :                <?php echo $row['preference3']; ?><br/>        
			Payment Mode      :                <?php echo $row['paymentMode']; ?><br/>            
    
<?php                
                
            }

            
}

?>
<br />
<div id='updateForm'>
<strong> Want to update status?</strong> <br />
<form action='lease_req_details.php?leaseReqID=<?php echo $leaseReqID; ?>' method='POST' name='lease_req_update' >
Enter LeaseID: <input type='text' name='idTextBox' id='idTextBox'></input>
<br />    
<input type='submit' value='Update'>
</form>
<br />    
</div>  

<?php 

    $leaseReqID = null ;
    if(isset($_POST['idTextBox']))
    {
        $leaseReqID = $_POST['idTextBox'];
    }

    if($leaseReqID != null)
    {
        // Getting values from Table Lease_Request 

        $sql_update_query = "CALL new_lease_request(".$leaseReqID.")" ;
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
<div id='goBack'>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</div>   
</div>    
</section>
</body>
</html>