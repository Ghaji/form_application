<?php
	require_once ("../../inc/initialize.php");

	$database = new MySQLDatabase();
	
	$id = $_POST['acceptance_id'];
	
	$result = $database->query("DELETE FROM acceptance_log WHERE id='$id'");
	
	if($result){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "Payment record successfully deleted";
		echo '<hr>';
		echo '<a href="search_acceptance.php">Continue</a<>';
	}else{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Payment record not deleted";
	}
?>