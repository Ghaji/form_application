<?php
	require_once('../inc/initialize.php');
	$db_academic = new MySQLDatabase();
	
	$sql_exam = "SELECT * FROM exam_id";
	$result_exam = $db_academic->query($sql_exam);
							
	while($record = $db_academic->fetch_array($result_exam))
	{	
		echo '<option value="'. $record['exam_type_id'] .'">'.$record['exam_name'].'</option>';
	}

?>