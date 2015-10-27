<?php
		require_once("inc/initialize.php");	
			
		if(isset($_POST['faculty_id'])){
					
		  $sql_dept ="SELECT * FROM department WHERE faculty_id='" . $_POST['faculty_id'] . "' and `status`= 1 ORDER BY department_name ASC";
		  $result_set = $database->query($sql_dept);
		  
		  while($row = $database->fetch_array($result_set))
		  {
			  echo '<option value="'. $row['department_id'] .'">'.$row['department_name'].'</option>'; 
		  }
		
		}
	

?>