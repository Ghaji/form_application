<?php
	require_once('../../inc/initialize.php');
	
	$admission_status = $_POST["admission_status"];

	foreach($_POST as $key => $value){
	
		if($key != "admission_status") {
			$applicant_id = customDecrypt($value);
			$admissions = new Admission();
			
			$admissions->db_fields = array('status');
			$admissions->applicant_id = $applicant_id;
			$admissions->status = $admission_status;
			
			$sql_adm = "select admission_id from admission_status where applicant_id='".$admissions->applicant_id."'";
			$res_adm = Admission::find_by_sql($sql_adm);
			$res_adm=array_shift($res_adm);
			$admissions->admission_id = $res_adm->admission_id;
			
			$admissions->save();
		}
	}
	echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
	echo '<hr>';
	echo 'Admission status  successfully set.';
?>