<?php
	require_once ("../../inc/initialize.php");
	$database = new MySQLDatabase();
	if(isset($_POST)){
		$acceptance_log = new AcceptanceLog();

		$acceptance_log->student_id = $_POST['applicant_number'];
		$acceptance_log->ResponseCode = $_POST['response_code'];
		$result = $database->query("SELECT * FROM `interswitch_error_code` WHERE `response_code` = '".$acceptance_log->ResponseCode."'");
		$result = $database->fetch_array($result);
		$acceptance_log->ResponseDescription = $result['response_description'];
		
		$acceptance_log->PaymentReference = $_POST['payment_reference'];
		$acceptance_log->Amount = $_POST['amount'];
		$acceptance_log->returned_amount = ($_POST['amount'] * 100).".00";
		$acceptance_log->status = $_POST['student_status'];
		
		if($acceptance_log->save()){
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo "<p>You have successfully added a new record into acceptance log for applicant with application number: ".$acceptance_log->student_id.".</p>";
			echo '<hr>';
		}else{
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Failed to insert into acceptance log.";
			echo '<hr>';
		}
	}
?>