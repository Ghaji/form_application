<?php require_once("inc/initialize.php"); 
	  require_once("inc/remita_functions.php");

if(!$session->is_logged_in()){
		
		redirect_to('index.php');
	}
	
	$applicant_form_id = User::find_by_sql("SELECT `form_id` FROM `personal_details` WHERE `applicant_id`='".$session->applicant_id."'");
	
	foreach($applicant_form_id as $applicantFormId)
	{
	 	 $applicantFormId->form_id;
	}
	
	if(empty($applicantFormId->form_id))
	{
		if(isset($_SESSION['form_id']))
		{
			$user = new User();
	
			$user->form_id = $_SESSION['form_id'];
			
			$user->programme_applied_id = $_SESSION['course'];
			
			$user->student_status = $_SESSION['student_status'];
			
			$user->type_of_programme = $_SESSION['type_of_programme'];
			
			$user->db_fields = array('form_id', 'programme_applied_id', 'student_status', 'type_of_programme');
			
			$user->applicant_id = $session->applicant_id;
			
			$user->save();
			
			$applicantFormId->form_id = $user->form_id;
			
			unset($_SESSION['form_id']);
			unset($_SESSION['type_of_programme']);
		}
		else
		{
			redirect_to('select_form.php');
		}
	}
	else{
		$sqlpayment = "SELECT * FROM adm_access_code WHERE jamb_rem_no='".$applicantFormId->form_id."' AND reg_num='".$applicantFormId->form_id."' LIMIT 1";
		
		$payment_details = User::find_by_sql($sqlpayment);
		
		if(!empty($payment_details))
		{
			redirect_to('application_form.php');
		}
	}

	
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
</head>
<body>
<?php include_layout_template("header.php"); ?>

<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span10 offset1" >
            <h4>MAKE PAYMENT</h4>
            <hr>
            <?php
                $database = new MYSQLDatabase();
                $sql = "SELECT * FROM `personal_details` p JOIN `faculty` f JOIN `department` d JOIN `form_amount` fa WHERE p.applicant_id='".$session->applicant_id."' AND p.programme_applied_id=d.department_id AND f.faculty_id=d.faculty_id AND fa.student_status=p.student_status";
                $result = $database->query($sql);
                $result = $database->fetch_array($result);
                $student_status = $result['student_status'];
                $transaction_charge = $result["transaction_amount"];
                $our_total = $result["amount"];
                $total_charge = $our_total + $transaction_charge;
                //$our_total = ($result["amount"] + $transaction_charge) * 100;
                $payment_id = $result["pay_item_id"];
                $naira = '&#8358;';
            ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Programme</th>
                        <th>Course</th>
                        <th>Programme Charge</th>
                        <th>Transaction Charge</th>
                        <th>Total Charge</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
					$fullname = $result["surname"].' '.$result["first_name"].' '.$result["middle_name"];
                        echo '
                        <td>'.$fullname.'</td>
                        <td>'.$result["faculty_name"].'</td>
                        <td>'.$result["department_name"].'</td>
                        <td>&#8358;'.$result["amount"].'</td>
                        <td>&#8358;'.$transaction_charge.'</td>
                        <td>&#8358;'.$total_charge.'</td>';
						
                    ?>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="span4 offset5">
                <?php 
							$acceptance = new AcceptanceLog();
							$sql = "SELECT * FROM acceptance_log WHERE student_id = '".$applicantFormId->form_id."' AND ResponseDescription = 'Transaction Pending' LIMIT 1";
							//$checks = AcceptanceLog::find_by_sql($sql);
							$checks = $acceptance->find_by_sql($sql);
							$check = array_shift($checks);
							if(!empty($check)){
								if($check->ResponseDescription == "Transaction Pending" OR $check->ResponseCode == '021' ){ ?>
  								 
									<button id="Exit" onClick="location.replace('logout.php?logoff=logoff');" class="btn btn-danger">
										Oppsy - You Have a Pending Transaction clear it to avoid double payment
									</button>


					  

					 <?php 		}
							}else{ ?>
                    <img src="images/remita.png" alt="remita-payment-logo-horizontal">
                    <br>
                    <?php

						// $timesammp = DATE("dmyHis");	
						// $orderID = $timesammp;	
						$randomDigit = randomDigits(4);	
											
						$transaction_id = substr($randomDigit, 0, 2).$result["form_id"].substr($randomDigit, 2, 2);
						$_SESSION["transaction_id"] = $transaction_id;
						$return_url = 'http://'.$_SERVER['HTTP_HOST'].'/mis.unijos.edu.ng/app_form_template/processpayment.php'; 
						$total_kobo = $total_charge;
						$_SESSION['amount'] = $our_total;
						$_SESSION['student_status'] = $student_status;
						
						// $hash_value = $transaction_id . '3944' . $payment_id . $total_kobo . $return_url . "CF82609ADB4A2352966649823625C1217BE486E1B23D4686621EFED077B0B42924B2098F0B36656BAC8B6008576BF05A254B244675B501DA3DF863311BF1BB75";
						//echo  $hash_value . "<br>";
						$hash_value = MERCHANTID . SERVICETYPEID . $transaction_id . $total_kobo . $return_url . APIKEY;
						$ourhas =  hash("sha512", $hash_value); 
						$paymenttype = 'VERVE';
					?>
                    <form name="regform" id="form1" class="payment_form" method="POST" action="<?php echo GATEWAYURL; ?>">
                    <?php
					echo '
                    	<input id="amt" name="amt" value="'.$total_kobo.'" type="hidden"/>
						<input id="merchantId" name="merchantId" value="'.MERCHANTID.'" type="hidden"/>
						<input id="serviceTypeId" name="serviceTypeId" value="'.SERVICETYPEID.'" type="hidden"/>
						<input id="responseurl" name="responseurl" value="'.$return_url.'" type="hidden"/>
						<input id="orderId" name="orderId" value="'.$transaction_id.'" type="hidden"/>
						<input id="payerName" name="payerName" value="'.$fullname.'" type="hidden"/>
						<input id="hash" name="hash" value="'.$ourhas.'" type="hidden"/>
						<input id="paymenttype" name="paymenttype" value="'.$paymenttype.'" type="hidden"/>';
					?>
 						
 						<button type="submit" class="btn btn-primary" id="submit_payment">
  						<span>Pay Via Remita</span></button>
  						
                    </form>
                  <button id="Exit" onClick="location.replace('logout.php?logoff=logoff');" class="btn">Exit</button>
                  <?php } ?>
                </div>
            </div>
            <br><br>
            
		</div>
		
		
	</div>
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
<script type="text/javascript" src="js/payment.js"></script>
</body>
</html>