<?php
	require_once ("../../inc/initialize.php");
	$database = new MySQLDatabase();
	if(isset($_POST)){
		$amount = $_POST['amount'];
		$transaction_amount = $_POST['transaction_amount'];
		$pay_item_id = $_POST['pay_item_id'];
		$student_status = $_POST['student_status'];
		$description = $_POST['description'];
		
		$sql_insert_amount = "INSERT INTO `form_amount` (`amount_id`, `amount`, `transaction_amount`, `student_status`, `pay_item_id`, `description`, `status`) VALUES (NULL, '".$amount."', '".$transaction_amount."', '".$student_status."', '".$pay_item_id."', '".$description."', '1');";
		
		if($database->query($sql_insert_amount)){
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo "<p>You have successfully added a new record into form amount table</p>";
			echo '<hr>';
		}else{
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Failed to insert into form amount table.";
			echo '<hr>';
		}
	}
?>