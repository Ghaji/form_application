<?php
	require_once('../inc/initialize.php');
	$db_academic = new MySQLDatabase();
	
	$sql_grade = "SELECT * FROM exam_grade";
	$result_grade = $db_academic->query($sql_grade);
							
	while($record = $db_academic->fetch_array($result_grade))
	{	
		echo '<option value="'. $record['grade_id'] .'">'.$record['grade'].'</option>'; 
	}

?>