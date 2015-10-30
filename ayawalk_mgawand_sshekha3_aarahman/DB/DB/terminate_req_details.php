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
$sql_query = "SELECT * FROM Terminate_Request WHERE RequestID='".$leaseReqID."'";


echo "Displaying results for Terminate Lease Request ID: ".$leaseReqID.$nl;



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
                $leaseReqID= $row['RequestID'] ;
                
?>   
    
            Request ID          :                <?php echo $leaseReqID ; ?><br/>    
			Student ID          :                <?php echo $row['peopleID']; ?><br/>    
			Place ID            :                <?php echo $row['placeID']; ?><br/>    
            Terminate Date      :                <?php echo $row['terminateDate']; ?><br/>    
			Status              :                <?php echo $row['status']; ?><br/>    
            Inspection Date     :                <?php echo $row['inspectionDate']; ?><br/>    
    
    
<?php                
                
            }

            
}

?>
<br />
<div id='updateForm'>
<strong> Want to update status?</strong> <br />
<form action='terminate_req_details.php?leaseReqID=<?php echo $leaseReqID; ?>' method='POST' name='terminate_lease_update' >
Enter Terminate Request ID: <input type='text' name='IDTextBox' id='IDTextBox'></input> <br />
Check If Paid or Not: 
    <input type="radio" name="paidVar" value="1">Yes</input>     
    <input type="radio" name="paidVar" value="0">No </input> 
<br />
Enter Cut Off Days: <input type='text' name='daysTextBox' id='daysTextBox'></input>    
<br />    
<input type='submit' value='Update !'>
</form>
<br />    
</div>  

<?php 

    $termReqID = null ;
    $days = null ;
    $paidFlag = null ;

    if(isset($_POST['IDTextBox']))
    {
        $termReqID = $_POST['IDTextBox'];
        //$status = $_GET['statusTextBox'];    
    }

    if(isset($_POST['daysTextBox']))
    {
        $days = $_POST['daysTextBox'];
        //$status = $_GET['statusTextBox'];    
    }

    if(isset($_POST['paidVar']))
    {
        $paidVar=$_POST['paidVar'];
        //echo "paid VAr is ".$paidVar;
        if($paidVar=='1')
        {
            $paidFlag=1;
        }
        else
        {
            $paidFlag = 0 ;
        }
    }
    //echo "paid Flag is ".$paidFlag. "    ID: ".$termReqID;    
    if($termReqID != null && $paidFlag != null)
    {
        $sql_update_query = "CALL  new_terminate_request(".$termReqID.", ".$paidFlag.", ".$days.");" ;
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
</section>
</body>
</html>