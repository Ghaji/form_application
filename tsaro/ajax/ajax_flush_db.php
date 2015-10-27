<?php
	require_once("../../inc/initialize.php");

	$programme = htmlspecialchars($_POST['faculty_id'], ENT_QUOTES);
	$twoweeksago = time() - 1257258;
	if($programme != 'all'){
		$faculty_details = $database->query("SELECT * FROM faculty WHERE faculty_id = '".$programme."'");
		$faculty_details = $database->fetch_array($faculty_details);
		$status = $faculty_details['faculty_code'];
		$sql = $database->query("DELETE FROM personal_details WHERE student_status='".$status."' AND mail_validation = 0 AND date_of_registration < '".$twoweeksago."'");
		echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
		echo '<hr>';
		echo "Redundant Data has been successfully flushed";
		echo "<br>";
		echo '<hr>';
	}else{
		$sql = $database->query("DELETE FROM personal_details WHERE mail_validation = 0 AND date_of_registration < ".$twoweeksago);
		echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
		echo '<hr>';
		echo "Redundant Data has been successfully flushed";
		echo "<br>";
		echo '<hr>';
	}
	
?>