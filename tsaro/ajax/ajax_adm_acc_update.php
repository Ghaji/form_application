<?php
	require_once ("../../inc/initialize.php");
	
	$adm = new AccAdmAccess();
	
	$adm->id = $_POST['adm_id'];
	$adm->pin = $_POST['access_code'];
	$adm->amount = ($_POST['amount'] * 100).'.00';
	$adm->payment_date = $_POST['transaction_date'];
	$adm->ip_addr = $_POST['ip_address'];
	$adm->payment_code = $_POST['payment_code'];
	$adm->branch_code = $_POST['branch_code'];
	$adm->full_name = $_POST['full_name'];
	$adm->status = $_POST['student_status'];
	
	$adm->db_fields = array('pin', 'amount', 'payment_date', 'ip_addr', 'payment_code', 'branch_code', 'bank_code', 'full_name', 'status');
	
	if($adm->save()){
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "You have successfully edited the acceptance fee payment record for applicant with application number: ".$_POST['applicant_number'];
		echo '<hr>';
	}else{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Your updates were not saved";
	}
?>