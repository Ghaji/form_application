<?php
include('soaplib/nusoap.php');
//require_once ("../initialize.php");
function getStatus($refid){
	ini_set("soap.wsdl_cache_enabled", "0");
		
	//$mkey = '465A86C858B0293DD478D3D664E4B0CB18BC18C0332215CCF7D7C891CA25C3FAA4F5FC7CB187BFDA7233A720A747FB9FDEC866EB8D20D7C262287716F11C48A5';
	$mkey = 'CF82609ADB4A2352966649823625C1217BE486E1B23D4686621EFED077B0B42924B2098F0B36656BAC8B6008576BF05A254B244675B501DA3DF863311BF1BB75';
	$t_ref = $refid;
	//$t_ref = '12345678';
	
	//$p_id = '3996';
	$p_id = '3944';
	$hasval =  $p_id. $t_ref.$mkey;
	$myHASH = hash("sha512", $hasval);
	
	$wsdlfile = "https://webpay.interswitchng.com/paydirect/services/webpayservice.svc?wsdl";
	$msg='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.interswitchng.com/" xmlns:web="http://schemas.datacontract.org/2004/07/WebPAY.Core.ServiceFramework.Contract"> <soapenv:Header/> <soapenv:Body> <ser:GetTransactionData> <ser:transactionQueryRequest> <web:Hash>' . $myHASH . '</web:Hash> <web:ProductId>' . $p_id. '</web:ProductId> <web:TransactionReference>'. $t_ref . '</web:TransactionReference> </ser:transactionQueryRequest> </ser:GetTransactionData> </soapenv:Body> </soapenv:Envelope>';

   	//$s = new nusoap_client($wsdlfile);
	
	$s = new nusoap_client($wsdlfile,true);
			
	//$result = $s->call('GetTransactionData', $msg ,'http://services.interswitchng.com/','http://services.interswitchng.com/WebPayService/GetTransactionData');

	$do = $s->send($msg, 'http://services.interswitchng.com/WebPayService/GetTransactionData');		
	
	$result = $s->responseData;
	
	
	$err = $s->getError();
	if ($err) {
		// Display the error
		echo '<h2>Network Timeout! </h2><pre></pre><b>Ooopsy! Kindly hit the button below and hit <b>accept/send/yes</b>  on all prompt request.</b><br /><br /><input type="button" value="Please Click here" onClick="document.location.reload(true);">';
		
	} else {
		
	}
	return $result;
}
   
function checkTranxact($soap_result ){
	$xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?>' . $soap_result);
			
	$xml->registerXPathNamespace('a', 'http://schemas.datacontract.org/2004/07/WebPAY.Core.ServiceFramework.Contract');
	$xml->registerXPathNamespace('s', 'http://schemas.datacontract.org/2004/07/WebPAY.Core.ServiceFramework.Contract');
	
	$xml->registerXPathNamespace('s', 'http://schemas.xmlsoap.org/ws/2002/12/secext');
	$nodes[0] = $xml->xpath('//a:Amount');
	$nodes[1] = $xml->xpath('//a:CardNumber');
	$nodes[2] = $xml->xpath('//a:MerchantReference');
	$nodes[3] = $xml->xpath('//a:RetrievalReferenceNumber');
	$nodes[4] = $xml->xpath('//a:TransactionDate');
	$nodes[5] = $xml->xpath('//a:PaymentReference');
	$header = $xml->xpath('//s:Body');
	
	$ret = $header[0];
	
	$result['Amount'] = strval($nodes[0][0]);
	$result['CardNumber'] =strval($nodes[1][0]);
	$result['RefNumb'] = strval($nodes[2][0]);
	$result['RetRefNumb'] = strval($nodes[3][0]);
	$result['TranxDate'] = strval($nodes[4][0]);
	$result['PaymentReference'] = strval($nodes[5][0]);
	$result['ResponseCode'] = strval($ret->GetTransactionDataResponse->GetTransactionDataResult->ResponseCode);
	$result['ResponseDescription'] = strval($ret->GetTransactionDataResponse->GetTransactionDataResult->ResponseDescription[0]);
	
	return $result;
}
	
if( isset($_POST['retAction'] ) && !empty($_POST['retAction'])  ){
	$rea = checkTranxact(getStatus($_POST['retAction']));
	
	if (trim($rea['ResponseDescription']) == "")
		$rea['ResponseDescription'] = getDes($rea['ResponseCode']);
 
	$ResponseCode =  $rea['ResponseCode'];
	$tranx_id = $_POST['retAction'];
	$ResponseDescription = $rea['ResponseDescription'];
	$amount = $rea['Amount'];
	$CardNumber = $rea['CardNumber'];
	$PaymentReference = $rea['PaymentReference'];
	$RefNumb = $rea['RefNumb'];
	$RetRefNumb = $rea['RetRefNumb'];
	$TranxDate = $rea['TranxDate'];

	echo'
	<h4 class="alert alert-info">Interswitch says</h4>
	<table class="table table-hover">
		<tr ><td>Response Code:</td><td>'.$ResponseCode.'</td></tr>
		<tr ><td>Response Description:</td><td>'.$ResponseDescription.'</td></tr>
		<tr ><td>Amount:</td><td>'.$amount.'</td></tr>
		<tr ><td>Merchant Reference:</td><td>'.$PaymentReference.'</td></tr>
		<tr ><td>Payment Reference:</td><td>'.$RefNumb.'</td></tr>
		<tr ><td>Returned Ref Number:</td><td>'.$RetRefNumb.'</td></tr>
		<tr ><td>Transaction Date:</td><td>'.$TranxDate.'</td></tr>
		</table>';

	if($ResponseCode  == '00' ){
		//get fullname of applicant
		$adm = new AdmAccess();
		
		$sqlcheck = "SELECT id FROM `adm_access_code` WHERE `jamb_rem_no` = '".$_POST['number']."'";
		$check = $adm->find_by_sql($sqlcheck);

		// Check if the record does not exist in both acceptance_log and adm_access_code then insert and if they do update it
		if(empty($check)){
			$sql_fullname  = "SELECT applicant_id, surname, first_name, middle_name, student_status ";
			$sql_fullname .= "FROM `personal_details` WHERE `form_id` = '".$_POST['number']."'";
			
			$Applicant_details = User::find_by_sql($sql_fullname);
			$Applicant_detail = array_shift($Applicant_details);
			
			$acceptance = new AcceptanceLog();
			$acceptance->db_fields = array('ResponseCode', 'ResponseDescription', 'Amount', 'returned_amount', 'MerchantReference', 'PaymentReference', 'status');
			$sql_acc_id = "SELECT id FROM `acceptance_log` WHERE student_id='".$_POST['number']."'";
			$acc_id = $acceptance->find_by_sql($sql_acc_id);
			$acc_id_final = array_shift($acc_id);
			
			$acceptance->ResponseCode = $ResponseCode;
			$acceptance->ResponseDescription = $ResponseDescription;
			$acceptance->Amount = $amount/100;
			$acceptance->returned_amount = $amount.'.00';
			$acceptance->MerchantReference = $PaymentReference;
			$acceptance->PaymentReference = $RefNumb;
			$acceptance->status = $Applicant_detail->student_status;
			$acceptance->id = $acc_id_final->id;
			
			// Save Record into Table acceptance_log or update as the need be
			$acceptance->save();
			
			$fullname = $Applicant_detail->surname.' '.$Applicant_detail->first_name.' '.$Applicant_detail->middle_name;
		
			$adm->jamb_rem_no = $_POST['number'];
			$adm->pin = $RefNumb;
			$adm->amount = $amount.'.00';
			$adm->payment_date = $TranxDate;
			$adm->payment_code = $RetRefNumb;
			$adm->reg_num = $_POST['number'];;
			$adm->full_name = $fullname;
			$adm->status = $Applicant_detail->student_status;
			
			// Save Record into Table adm_access_code or update as the need be
			if($adm->save()){
				echo'<h4 class="alert alert-success">Information successfully inserted</h4>';
			}
		}else{
			// Let the Client know that the record is already stored in the Table adm_access_code
			echo'<h4 class="alert alert-info">Record already in the database</h4>';
		}
	
	}else{
		//$pay_typer = (int) substr( $_POST['retAction'],8,2);
		$pay_typer = (int) substr($tranx_id,-5,2);
		$out_total = ($amount/100)-300;
		$t_id = $_POST['retAction'];
		
		$sqz = "select session_id from fee_log where PaymentReference = '". $_POST['retAction'] . "'";
		$auz = $Con->GetRow($sqz);
		
		
		$pay_session_id = $auz[0];
		$jnum0 = $_POST['number'];
		
		//$findsql = "select jamb_rem_no, matriculation_no from student where student_id = '" . $jnum0  . "' ";
		//echo $findsql ;
		//$jnum = $Con->GetRow($findsql);
		//print_r($jnum);
		//die();
		
		
		//$stud_num = (trim($jnum[1]) == 'nil' || trim($jnum[1]) == '')? $jnum[0] : $jnum[1];
		
		$stud_num  = $jnum0 ;
		$thisisit = Commit_Student_Fees();
	}
}
	
function getDes($erCode){
	$msg ="";
	switch($erCode){
		case '00':	$msg .= "Approved Successful";
		break;

		case '01':  $msg .= "Refer to Financial Institution"; 
		break;
		
		case '02':  $msg .= "Refer to Financial Institution, Special Condition"; 
		break;
		
		case '03':  $msg .= "Invalid Merchant"; 
		break;
		
		case '04':  $msg .= "Pick-up card"; 
		break;
		
		case '05':  $msg .= "Do Not Honor"; 
		break;
		
		case '06':  $msg .= "Error "; 
		break;
		
		case '07':  $msg .= "Pick-Up Card, Special Condition"; 
		break;
		
		case '08':  $msg .= "Honor with Identification"; 
		break;
		
		case '09':  $msg .= "Request in Progress"; 
		break;
		
		case '10':  $msg .= "Approved by Financial Institution, Partial"; 
		break;
		
		case '11':  $msg .= "Approved by Financial Institution, VIP"; 
		break;
		
		case '12':  $msg .= "Invalid Transaction"; 
		break;
		
		case '13':  $msg .= "Invalid Amount"; 
		break;
		
		case '14':  $msg .= "Invalid Card Number"; 
		break;
		
		case '15':  $msg .=  "No Such Financial Institution"; 
		break;
		
		case '16':  $msg .=  "Approved by Financial Institution, Update Track 3"; 
		break;
		
		case '17':  $msg .=  "Customer Cancellation"; 
		break;
		
		case '18':  $msg .=  "Customer Dispute"; 
		break;
		
		case '19':  $msg .=  "Re-enter Transaction"; 
		break;
		
		case '20':  $msg .=  "Invalid Response from Financial Institution"; 
		break;
		
		case '21':  $msg .= "No Action Taken by Financial Institution"; 
		break;
		
		case '22':  $msg .= "Suspected Malfunction"; 
		break;
		
		case '23':  $msg .= "Unacceptable Transaction Fee"; 
		break;
		
		case '24':  $msg .= "File Update not Supported"; 
		break;
		
		case '25':  $msg .= "Unable to Locate Record"; 
		break;
		
		case '26':  $msg .= "Duplicate Record "; 
		break;
		
		case '27':  $msg .= "File Update Field Edit Error"; 
		break;
		
		case '28':  $msg .= "File Update File Locked"; 
		break;
		
		case '29':  $msg .= "File Update Failed"; 
		break;
		
		case '30':  $msg .= "Format Error"; 
		break;
		
		case '31':  $msg .= "Bank Not Supported"; 
		break;
		
		case '32':  $msg .= "Completed Partially by Financial Institution"; 
		break;
		
		case '33':  $msg .= "Expired Card, Pick-Up"; 
		break;
		
		case '34':  $msg .= "Suspected Fraud, Pick-Up"; 
		break;
		
		case '35':  $msg .=  "Contact Acquirer, Pick-Up"; 
		break;
		
		case '36':  $msg .=  "Restricted Card, Pick-Up"; 
		break;
		
		case '37':  $msg .=  "Call Acquirer Security, Pick-Up"; 
		break;
		
		case '38':  $msg .=  "PIN Tries Exceeded, Pick-Up"; 
		break;
		
		case '39':  $msg .=  "No Credit Account"; 
		break;
		
		case '40':  $msg .=  "Function not Supported"; 
		break;		
		
		case '41':  $msg .= "Lost Card, Pick-Up"; 
		break;
		
		case '42':  $msg .= "No Universal Account"; 
		break;
		
		case '43':  $msg .= "Stolen Card, Pick-Up"; 
		break;
		
		case '44':  $msg .= "No Investment Account"; 
		break;
		
		case '51':  $msg .= "Insufficient Funds"; 
		break;
		
		case '52':  $msg .= "No Check Account "; 
		break;
		
		case '53':  $msg .= "No Savings Account"; 
		break;
		
		case '54':  $msg .= "Expired Card"; 
		break;
		
		case '55':  $msg .= "Incorrect PIN"; 
		break;
		
		case '56':  $msg .= "No Card Record"; 
		break;
		
		case '57':  $msg .= "Transaction not permitted to Cardholder"; 
		break;
		
		case '58':  $msg .= "Transaction not permitted on Terminal"; 
		break;
		
		case '59':  $msg .= "Suspected Fraud"; 
		break;
		
		case '60':  $msg .= "Contact Acquirer"; 
		break;
		
		case '61':  $msg .=  "Exceeds Withdrawal Limit"; 
		break;
		
		case '62':  $msg .=  "Restricted Card"; 
		break;
		
		case '63':  $msg .=  "Security Violation"; 
		break;
		
		case '64':  $msg .=  "Original Amount Incorrect"; 
		break;
		
		case '65':  $msg .=  "Exceeds withdrawal frequency"; 
		break;
		
		case '66':  $msg .=  "Call Acquirer Security"; 
		break;
		
		case '67':  $msg .= "Hard Capture"; 
		break;
		
		case '68':  $msg .= "Response Received Too Late"; 
		break;
		
		case '75':  $msg .= "PIN tries exceeded"; 
		break;
		
		case '76':  $msg .= "Reserved for Future Postilion Use"; 
		break;
		
		case '77':  $msg .= "Intervene, Bank Approval Required"; 
		break;
		
		case '78':  $msg .= "Intervene, Bank Approval Required for Partial Amount"; 
		break;
		
		case '90':  $msg .= "Cut-off in Progress"; 
		break;
		
		case '91':  $msg .= "Issuer or Switch Inoperative"; 
		break;
		
		case '92':  $msg .= "Routing Error"; 
		break;
		
		case '93':  $msg .= "Violation of law"; 
		break;
		
		case '94':  $msg .= "Duplicate Transaction"; 
		break;
		
		case '95':  $msg .= "Reconcile Error"; 
		break;
		
		case '96':  $msg .= "System Malfunction"; 
		break;
		
		case '98':  $msg .= "Exceeds Cash Limit"; 
		break;
		
		case 'A0':  $msg .=  "Unexpected error"; 
		break;
		
		case 'A4':  $msg .=  "Transaction not permitted to card holder, via channels"; 
		break;
		
		case 'Z0':  $msg .=  "Transaction Status Unconfirmed"; 
		break;
		
		case 'Z1':  $msg .=  "Transaction Error"; 
		break;
		
		case 'Z2':  $msg .=  "Bank account error"; 
		break;
		
		case 'Z3':  $msg .=  "Bank collections account error"; 
		break;		
		
		case 'Z4':  $msg .=  "Interface Integration Error"; 
		break;
		
		case 'Z5':  $msg .=  "Duplicate Reference Error"; 
		break;
		
		case 'Z6':  $msg .=  "Incomplete Transaction"; 
		break;
		
		case 'Z7':  $msg .=  "Transaction Split Pre-processing Error"; 
		break;
		
		case 'Z8':  $msg .=  "Invalid Card Number, via channels"; 
		break;
		
		case 'Z9':  $msg .=  "Transaction not permitted to card holder, via channels"; 
			break;
		
		default: $msg = " There Was A Problem Validating Your Payment!";
	}
	return  $msg;	
}

?>





