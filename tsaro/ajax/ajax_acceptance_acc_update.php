<?php
	require_once ("../../inc/initialize.php");

	$database = new MySQLDatabase();
	
	$id = $_POST['acceptance_id'];
	$application_number = $_POST['applicant_number'];
	$responsecode = $_POST['approval_status'];
	$amount = $_POST['amount'];
	$returned_amount = ($amount*100).'.00';
	$payment_reference = $_POST['payment_ref'];
	
	$responseDescription = $database->fetch_array($database->query("SELECT * FROM interswitch_error_code WHERE response_code = '".$responsecode."'"));
	
	$responseDescription = $responseDescription['response_description'];
	
	$status = $_POST['student_status'];
	
	$updatesql = "UPDATE acceptance_acceptance_log SET PaymentReference='$payment_reference', Amount='$amount', returned_amount='$returned_amount', ResponseCode='$responsecode', ResponseDescription='$responseDescription', status='$status' WHERE id='$id'";
	
	$result = $database->query($updatesql);
	
	if($result){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "You have successfully edited the acceptance fee payment record for applicant with application number: ".$application_number;
		echo '<hr>';
	}else{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Your updates were not saved";
	}
?>