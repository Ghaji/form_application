<?php
	require_once ("../../inc/initialize.php");
	
	
	$notification = new NotificationLog();
	
	$notification->db_fields = array('notification_id', 'user_id', 'title', 'content', 'recipient', 'notification_date', 'notification_time', 'status');
	$notification->user_id = $_SESSION['applicant_id'];
	$notification->title = $_POST['title'];
	$notification->content = $_POST['message'];
	$notification->recipient = $_POST['recipient'];
	$notification->notification_date = date('Y-m-d');
	$notification->notification_time = date('H:i:s');
	$notification->status = 1;
	//print_r($notification);
	
	if(!$notification->save())
	{
		echo '<h4 class="alert alert-danger">Error</h4>';
		echo '<hr>';
		echo "Your email was not sent.";
		echo '<hr>';
	}
	else
	{
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "You mail has been sent.";
		echo '<hr>';
	}

?>