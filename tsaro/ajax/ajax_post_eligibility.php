<?php
	require_once("../../inc/initialize.php");
	
	if(isset($_POST["aid"])) {
		$admission = new Admission();
		$admission->db_fields 		= array('applicant_id','status', 'reason');
		$admission->applicant_id 	= customDecrypt($_POST["aid"]);
		$admission->status 			= $_POST["eligibility_status"];
		$admission->reason 			= $_POST["reason"];
		
		$sql_adm = "select admission_id from admission_status where applicant_id='".$admission->applicant_id."'";
		$res_adm = Admission::find_by_sql($sql_adm);
		$res_adm=array_shift($res_adm);
		$admission->admission_id = $res_adm->admission_id;

		
		if($admission->save()){
			sleep(2);
			echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
			echo '<hr>';
			echo "Eligibility status for this user has been successfully saved.";
			echo "<br>";
			echo '<hr>';
		} else {
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "An error occured while saving eligibility status.";
			echo "<br>";
			echo '<hr>';
		}
	}
?>