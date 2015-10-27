<?php
	require_once('../../inc/initialize.php');
	
	$programme = $_POST['programme'];
	$amount = $_POST['amount'];
	$pay_item_id = $_POST['pay_item_id'];
	$description = $_POST['description'];
	$amount_id = $_POST['amount_id'];
	
	$database = new MYSQLDatabase();
	
	$update_query = "UPDATE form_amount SET student_status='".$programme."', amount = ".$amount.", pay_item_id=".$pay_item_id.", description='".$description."' WHERE amount_id=".$amount_id."";
	
	$update = $database->query($update_query);
	
	if($update){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "You have successfully updated the amount details";
		echo '<hr>';
	}else{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Your updates were not saved";
	}
?>