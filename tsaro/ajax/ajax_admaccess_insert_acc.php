<?php
	require_once ("../../inc/initialize.php");
	
	$database = new MySQLDatabase();
	if(isset($_POST)){
		$AdmAccess = new AccAdmAccess();
		$AdmAccess->db_fields=array('jamb_rem_no', 'pin', 'amount', 'payment_date', 'ip_addr', 'payment_code', 'branch_code', 'bank_code', 'reg_num', 'full_name', 'status');
		
		$AdmAccess->jamb_rem_no = $_POST['applicant_number'];
		$AdmAccess->pin = $_POST['access_code'];
		$AdmAccess->amount = ($_POST['amount'] * 100).".00";
		$AdmAccess->payment_date = $_POST['transaction_date'];
		$AdmAccess->ip_addr = $_POST['ip_address'];
		$AdmAccess->branch_code = $_POST['branch_code'];
		$AdmAccess->reg_num = $_POST['applicant_number'];
		$AdmAccess->full_name = $_POST['full_name'];
		$AdmAccess->status = $_POST['student_status'];
		
		/*print_r($AdmAccess);
		die();*/
		if($AdmAccess->save()){
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo "<p>You have successfully added a new record into acceptance fee adm log for applicant with application number: ".$AdmAccess->jamb_rem_no.".</p>";
			echo '<hr>';
		}else{
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Failed to insert into adm log.";
			echo '<hr>';
		}
	}
?>