<?php
		require_once("../inc/initialize.php");	
			
		if(isset($_POST['country_id']) && $_POST['country_id'] == 156){
					
		  $sql_state ="SELECT * FROM state";
		  
		  $result_set = $database->query($sql_state);
		  
		  if(isset($_POST['lga_id']))
		  {
			  $sql_get_state_id = "SELECT state_id FROM lga WHERE lga_id='".$_POST['lga_id']."' LIMIT 1";
			  
			  $result_set_tate_id = $database->query($sql_get_state_id);
			  
			  $row_state_id = $database->fetch_array($result_set_tate_id);
			  
			  $state_id = $row_state_id['state_id'];
		  }
		  
		  while($row = $database->fetch_array($result_set))
		  {
			  if($state_id == $row['state_id'])
			  {
				  echo '<option selected="selected" value="'. $row['state_id'] .'">'.$row['state_name'].'</option>';
			  }
			  else
			  {
				  echo '<option value="'. $row['state_id'] .'">'.$row['state_name'].'</option>';
			  } 
		  }
		  
		}
		elseif(isset($_POST['state_id']) && $_POST['state_id'] != '')
		{
			$sql_lga ="SELECT * FROM lga WHERE `state_id`='".$_POST['state_id']."'";
			
		  	$result_set = $database->query($sql_lga);
		  
		  	while($row = $database->fetch_array($result_set))
		  	{
				echo '<option value="'. $row['lga_id'] .'">'.$row['lga_name'].'</option>'; 
		  	}
		}
		elseif(isset($_POST['lga_id']))
		{
			$sql_get_state_id = "SELECT state_id FROM lga WHERE lga_id='".$_POST['lga_id']."' LIMIT 1";
			  
			$result_set_tate_id = $database->query($sql_get_state_id);
			  
			$row_state_id = $database->fetch_array($result_set_tate_id);
			  
			$state_id = $row_state_id['state_id'];
			
			$sql_lga ="SELECT * FROM lga WHERE `state_id`='".$state_id."'";
			
		  	$result_set = $database->query($sql_lga);
		  
		  	while($row = $database->fetch_array($result_set))
		  	{
				if($row['lga_id'] == $_POST['lga_id'])
				{
					echo '<option selected="selected" value="'. $row['lga_id'] .'">'.$row['lga_name'].'</option>'; 
				}
				else
				{
					echo '<option value="'. $row['lga_id'] .'">'.$row['lga_name'].'</option>'; 
				}
		  	}
			
		}
	

?>