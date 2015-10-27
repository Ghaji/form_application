<?php
	require_once ("../../inc/initialize.php");

	$id = $_POST['adm_id'];
	
	$adm = new AccAdmAccess();
	
	$adm->id = $id;
	
	if($adm->delete()){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "Acceptance fee payment record successfully deleted";
		echo '<hr>';
		echo '<a href="search_adm_acceptance.php">Continue</a<>';
	}else{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Payment record not deleted";
	}
?>