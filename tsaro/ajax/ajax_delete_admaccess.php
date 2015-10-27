<?php
	require_once ("../../inc/initialize.php");

	$id = $_POST['adm_id'];
	
	$adm = new AdmAccess();
	
	$adm->id = $id;
	
	if($adm->delete()){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "Payment record successfully deleted";
		echo '<hr>';
		echo '<a href="search_adm.php">Continue</a<>';
	}else{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Payment record not deleted";
	}
?>