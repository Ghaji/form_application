<?php
	require_once ("../inc/initialize.php");
	
	$message = $_POST['message'];
	$messagetitle= $_POST['title'];
	
	$database = new MYSQLDatabase();
	$sendsql = "INSERT INTO applicant_notifications (sender_id, title, content, recipient_id, notification_date, notification_time, status) VALUES(".$session->applicant_id.", '".$messagetitle."', '".$message."', '1', '".date('Y-m-d')."', '".date('H:i')."', 1)";
	$result = $database->query($sendsql);
	if($result){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "Your complaint has been sent.";
		echo '<hr>';
	}else{
		echo '<h4 class="alert alert-danger">Error</h4>';
		echo '<hr>';
		echo "Your complaint was not sent.";
		echo '<hr>';
	}
?>