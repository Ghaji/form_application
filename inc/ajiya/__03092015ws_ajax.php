<?php
require_once ("../initialize.php");

$amount = $_POST['Amount'];

$ResponseCode = $_POST['ResponseCode'];
$CardNumber = $_POST['CardNumber'];
$RefNumb = $_POST['RefNumb'];
$RetRefNumb = $_POST['RetRefNumb'];
$TranxDate = $_POST['TranxDate'];
$ResponseDescription = $_POST['ResponseDescription'];
$PaymentReference = $_POST['PaymentReference'];

$form_no = substr($RefNumb, 2, (sizeof($RefNumb) - 3));

$sql_fullname = "SELECT applicant_id, surname, first_name, middle_name, student_status FROM `personal_details` WHERE `form_id` = '".$form_no."'";
$Applicant_details = User::find_by_sql($sql_fullname);
$Applicant_detail = array_shift($Applicant_details);
		
	if( isset($_POST['action']) && $_POST['action'] == 'updateit' ){
		$acceptance = new AcceptanceLog();
			
		$acceptance->db_fields = array('student_id', 'ResponseCode', 'ResponseDescription', 'Amount', 'returned_amount', 'MerchantReference', 'PaymentReference', 'Initiating_date', 'Interswitch_date', 'status');
	
		$sql_acc_id = "SELECT id FROM `acceptance_log` WHERE student_id='".$form_no."'";
		$acc_id = $acceptance->find_by_sql($sql_acc_id);
		$acc_id_final = array_shift($acc_id);
						
		$acceptance->student_id = $form_no;
		$acceptance->ResponseCode = $ResponseCode;
		$acceptance->ResponseDescription = $ResponseDescription;
		$acceptance->Amount = $amount/100;
		$acceptance->returned_amount = $amount.'.00';
		$acceptance->MerchantReference = $PaymentReference;
		$acceptance->PaymentReference = $RefNumb;
		$acceptance->Interswitch_date = $TranxDate;
		$acceptance->status = $Applicant_detail->student_status;
		
		if(!empty($acc_id_final)){
			$acceptance->id = $acc_id_final->id;
		} else {
			$acceptance->Initiating_date = date('Y-m-d H:i:s');
		}
		
		// Save Record into Table acceptance_log or update as the need be
		$acceptance->save();
		
		echo "done";

	}elseif( isset($_POST['action']) && $_POST['action'] == 'insertaccesscode' ){
		
		$adm = new AdmAccess();
		
		$adm->jamb_rem_no = $form_no;
		$adm->pin = $RefNumb;
		$adm->amount = $amount.'.00';
		$adm->payment_date = $TranxDate;
		$adm->payment_code = $RetRefNumb;
		$adm->reg_num = $form_no;
		$adm->full_name = $Applicant_detail->surname." ".$Applicant_detail->first_name." ".$Applicant_detail->middle_name;
		$adm->status = $Applicant_detail->student_status;
		
		// Save Record into Table adm_access_code
		$adm->save();

		echo 'done';
	}

?>