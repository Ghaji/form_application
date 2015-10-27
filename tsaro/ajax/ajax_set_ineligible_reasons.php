<?php

require_once ("../../inc/initialize.php");

if (isset($_POST["btn"])) {
	switch ($_POST["btn"]) {
		case 'add_reason':
			$reason = new Reason();
			$reason->db_fields = array('reason','description', 'reason_status');
			$reason->reason = $_POST['reason'];
			$reason->description = $_POST['details'];
			$reason->reason_status = 1;
			
			if($reason->save()){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "<p>You have successfully added a new record into reason ineligiblity table</p>";
				echo '<hr>';
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Failed to insert into reason ineligiblity table.";
				echo '<hr>';
			}
			break;
		
		case 'del_reason':
			$database = new MySQLDatabase();
	
			$id = $_POST['reason'];
			
			$result = $database->query("DELETE FROM reasons_inelligibility WHERE reason_id='$id'");
			
			if($result){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "Ineligiblity reason record successfully deleted";
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Ineligiblity reason record not deleted";
			}
			break;
	}
}
?>