<?php
	require_once ("../../inc/initialize.php");
	
	
	$reply_title = 'Re: '.$_POST['title'];
	$reply_message = 'In reply to the message you sent <br>&quot;'.$_POST['message'].'&quot;<br><br>'.$_POST['replymessage'];
	$recipient_id = customDecrypt($_POST['recipient_id']);
	$sender_id = 1;
	
	
	$database = new MYSQLDatabase();
	$sendsql = "INSERT INTO applicant_notifications (sender_id, title, content, recipient_id, notification_date, notification_time, status) VALUES(".$sender_id.", '".$reply_title."', '".$reply_message."', ".$recipient_id.", '".date('Y-m-d')."', '".date('H:i')."', 1)";
	$result = $database->query($sendsql);
	
	if($result){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "Your reply has been sent.";
		echo '<hr>';
	}else{
		echo '<h4 class="alert alert-danger">Error</h4>';
		echo '<hr>';
		echo "Your reply was not sent.";
		echo '<hr>';
	}
?>