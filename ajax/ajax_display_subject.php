<?php
	require_once('../inc/initialize.php');
	$db_academic = new MySQLDatabase();
	
	$sql_subject = "SELECT * FROM exam_subject where visible = 1";
	$result_subject = $db_academic->query($sql_subject);
							
	while($record = $db_academic->fetch_array($result_subject))
	{	
		echo '<option value="'. $record['subject_id'] .'">'.$record['subject_name'].'</option>'; 
	}

?>