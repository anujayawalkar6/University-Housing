<?php
	session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Invoice</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="all">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#current-invoice").click(function(){
	if($("#disp-current-invoice").css('display') == 'none'){ 
	   $('#disp-current-invoice').show('slow');
		$('#disp-former-invoice').hide('slow'); 	   
	} else { 
	   $('#disp-current-invoice').hide('slow'); 
	}	
	});
});
$(document).ready(function(){
	$("#former-invoice").click(function(){
	if($("#disp-former-invoice").css('display') == 'none'){ 
	   $('#disp-former-invoice').show('slow');
		$('#disp-current-invoice').hide('slow'); 	   
	} else { 
	   $('#disp-former-invoice').hide('slow'); 
	}	
	});
});
$(document).ready(function(){
	$("#pay-invoice").click(function(){
	if($("#disp-pay-invoice").css('display') == 'none'){ 
	   $('#disp-pay-invoice').show('slow');
	} else { 
	   $('#disp-pay-invoice').hide('slow'); 
	}	
	});
});
</script>
	
</head>
<body>
<?php
	error_reporting(E_ALL);
	include "header.php";
	if (!empty($_SESSION['loggedin']) && ($_SESSION['loggedin'] == 1))
	{
		$nl = "<br />";
		include "database.php";

		$username = $_SESSION['username'];
		$peopleID = $_SESSION['peopleID'];
		$peopleType = $_SESSION['peopleType'];
?>
<section>
	
<?php
		if((!strcmp($peopleType,'student')) || (!strcmp($peopleType,'guest')) )
		{
			//echo "This is coming";
			// display set to student;
?>
			<div id="housing-options">
			<div><span id="current-invoice" class="text-link">View Current Invoices</span><br/>
				<div id="disp-current-invoice" style="display:none;"><br/>
				<table >
					<tr>
						<th> Invoice No </th>
						<th> Student ID </th>
						<th> Total Rent </th>
						<th> Total Parking Rent </th>
						<th> Late Fees </th>
						<th> Other Charges </th>
						<th> Total Due </th>
						<th> Lease ID </th>
						<th> Billing Date </th>
						<th> Due Date </th>
						<th> Place ID </th>
						<th> room No </th>
						<th> House Name </th>
						<th> Payment Made On </th>
						<th> Method Payment </th>
						<th> Final Charge Deducted </th>
						<th> Refund </th>
						<th> Status </th>
						
					</tr>
<?php
				$mysqli = connect_db();
				$sql_query = "SELECT * FROM `dummy3`.`invoice` WHERE peopleID = $peopleID ORDER BY invoiceNo DESC LIMIT 1 ";
			
				$result = $mysqli->query($sql_query);
				if ($result == FALSE) {
					echo "Query failed: ".$mysqli->error.$nl;
				}
				else {
					while($row = $result->fetch_assoc())
					{
						$invoiceNo = $row['invoiceNo'];
						$peopleID  = $row['peopleID'];
						$rent  = $row['rent'];
						$parkingRent  = $row['parkingRent'];
						$lateFees  = $row['lateFees'];
						$otherCharges  = $row['otherCharges'];
						$totalDue  = $row['totalDue'];
						$leaseID  = $row['leaseID'];
						$billDate = $row['billDate'];
						$dueDate = $row['dueDate'];
						$placeID  = $row['placeID'];
						$roomNo  = $row['roomNo'];
						$housingID  = $row['housingID'];
						$housingname  = $row['housingname'];
						$paymentDate = $row['paymentDate'];
						$methodPayment  = $row['methodPayment'];
						$finalChargeDeducted  = $row['finalChargeDeducted'];
						$refund  = $row['refund'];
						$status  = $row['status'];

						//echo $course_number;
?>				

						<tr>
							<td><?php echo "$invoiceNo"?></td>
							<td><?php echo "$peopleID"?></td>
							<td><?php echo "$rent"?></td>
							<td><?php echo "$parkingRent"?></td>
							<td><?php echo "$lateFees"?></td>
							<td><?php echo "$otherCharges"?></td>
							<td><?php echo "$totalDue"?></td>
							<td><?php echo "$leaseID"?></td>
							<td><?php echo "$billDate"?></td>
							<td><?php echo "$dueDate"?></td>
							<td><?php echo "$placeID"?></td>
							<td><?php echo "$roomNo"?></td>
							<td><?php echo "$housingname"?></td>
							<td><?php echo "$paymentDate"?></td>
							<td><?php echo "$methodPayment"?></td>
							<td><?php echo "$finalChargeDeducted"?></td>
							<td><?php echo "$refund"?></td>
							<td><?php echo "$status"?></td>
						</tr>
<?php
					}
				}
?>
				</table>
				</div>
			</div>
			<div><span id="former-invoice" class="text-link">View Former Invoices</span><br/>
					<div id="disp-former-invoice" style="display:none;"><br/>
					<table >
					<tr>
						<th> Invoice No </th>
						<th> Student ID </th>
						<th> Total Rent </th>
						<th> Total Parking Rent </th>
						<th> Late Fees </th>
						<th> Other Charges </th>
						<th> Total Due </th>
						<th> Lease ID </th>
						<th> Billing Date </th>
						<th> Due Date </th>
						<th> Place ID </th>
						<th> room No </th>
						<th> House Name </th>
						<th> Payment Made On </th>
						<th> Method Payment </th>
						<th> Final Charge Deducted </th>
						<th> Refund </th>
						<th> Status </th>
						
					</tr>
<?php
					$mysqli = connect_db();
					$sql_query = "SELECT * FROM `dummy3`.`invoice` WHERE peopleID = $peopleID ORDER BY invoiceNo DESC ";
				
					$result = $mysqli->query($sql_query);
					if ($result == FALSE) {
						echo "Query failed: ".$mysqli->error.$nl;
					}
					else {
						while($row = $result->fetch_assoc())
						{
							$invoiceNo = $row['invoiceNo'];
							$peopleID  = $row['peopleID'];
							$rent  = $row['rent'];
							$parkingRent  = $row['parkingRent'];
							$lateFees  = $row['lateFees'];
							$otherCharges  = $row['otherCharges'];
							$totalDue  = $row['totalDue'];
							$leaseID  = $row['leaseID'];
							$billDate = $row['billDate'];
							$dueDate = $row['dueDate'];
							$placeID  = $row['placeID'];
							$roomNo  = $row['roomNo'];
							$housingID  = $row['housingID'];
							$housingname  = $row['housingname'];
							$paymentDate = $row['paymentDate'];
							$methodPayment  = $row['methodPayment'];
							$finalChargeDeducted  = $row['finalChargeDeducted'];
							$refund  = $row['refund'];
							$status  = $row['status'];
							//echo $course_number;
?>				

						<tr>
							<td><?php echo "$invoiceNo"?></td>
							<td><?php echo "$peopleID"?></td>
							<td><?php echo "$rent"?></td>
							<td><?php echo "$parkingRent"?></td>
							<td><?php echo "$lateFees"?></td>
							<td><?php echo "$otherCharges"?></td>
							<td><?php echo "$totalDue"?></td>
							<td><?php echo "$leaseID"?></td>
							<td><?php echo "$billDate"?></td>
							<td><?php echo "$dueDate"?></td>
							<td><?php echo "$placeID"?></td>
							<td><?php echo "$roomNo"?></td>
							<td><?php echo "$housingname"?></td>
							<td><?php echo "$paymentDate"?></td>
							<td><?php echo "$methodPayment"?></td>
							<td><?php echo "$finalChargeDeducted"?></td>
							<td><?php echo "$refund"?></td>
							<td><?php echo "$status"?></td>
						</tr>
<?php
						}
					}
?>
					</table>
					</div>
				</div>
			</div>
			<div><span id="pay-invoice" class="text-link">Pay Invoice</span><br/>
				<div id="disp-pay-invoice" style="display:none;"><br/>
					<form action="pay-invoice.php" method=POST>
						<strong> Enter your Invoice No: </strong>&nbsp&nbsp
						<input name="invoiceNo" id="invoiceNo" type="text" placeholder="Enter invoice here." required/><br/><br/>
						<strong> Select payment method: </strong>&nbsp&nbsp<select name="mop" id="mop" required>
							<option value="" disabled selected>Select Payment option</option>
							<option value="Cash">Cash</option>
							<option value="Credit">Credit Card</option>
							<option value="Cheque">Cheque</option>
						</select></td>
						<br/><br/>
						<input value="Submit!" type="submit" align="middle" style="width:21.25%; height:35px" />&nbsp&nbsp
						<button value="Back" align="middle" type="button" onclick="location.href='/DB/index.php'" style="width:21.25%; height:35px">Back</button>
					</form><br/><br/>
				</div>
			</div>
<?php 
		}
		else
		{
			//echo "This is coming";
			//echo substr($peopleID,0,1);// display set to something else;
		}
		
	}
	else
	{
		//echo "Outside";
	}
?>
	
</section>
</body>
</html>