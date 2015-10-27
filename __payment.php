<?php 
require_once("inc/initialize.php"); 

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
                $transaction_charge = $result["transaction_amount"];
                $our_total = ($result["amount"] + $transaction_charge) * 100;
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
                        <td>&#8358;'.($result["amount"]+ $transaction_charge).'</td>';
						
                    ?>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="span4 offset5">
                <?php 
							$acceptance = new AcceptanceLog();
							$sql = "SELECT * FROM acceptance_log WHERE student_id = '".$applicantFormId->form_id."' AND ResponseDescription = 'Pending...' LIMIT 1";
							//$checks = AcceptanceLog::find_by_sql($sql);
							$checks = $acceptance->find_by_sql($sql);
							$check = array_shift($checks);
							if(!empty($check) AND $check->ResponseDescription == "Pending..."){ ?>
  								 
  								 <button id="Exit" onClick="location.replace('logout.php?logoff=logoff');" class="btn btn-danger">
									Oppsy - You Have a Pending Transaction clear it to avoid double payment
  								 </button>


					  

					 <?php 	}else{ ?>
                    <img src="images/interswitch_logo.png" alt="interswitch_logo">
                    <br>
                    <?php
						$randomDigit = randomDigits(4);
											
						$transaction_id = substr($randomDigit, 0, 2).$result["form_id"].substr($randomDigit, 2, 2);
						$_SESSION["transaction_id"] = $transaction_id;
						$return_url = 'http://'.$_SERVER['HTTP_HOST'].'/mis.unijos.edu.ng/app_form_template/processpayment.php'; 
						$total_kobo = $our_total;
						
						$hash_value = $transaction_id . '3944' . $payment_id . $total_kobo . $return_url . "CF82609ADB4A2352966649823625C1217BE486E1B23D4686621EFED077B0B42924B2098F0B36656BAC8B6008576BF05A254B244675B501DA3DF863311BF1BB75";
						//echo  $hash_value . "<br>";
						$ourhas =  hash("sha512", $hash_value    ); 
					?>
                    <form name="regform" id="form1" method="POST" action="https://webpay.interswitchng.com/paydirect/webpay/pay.aspx" onsubmit="return createTargeter(this.target, 600, 650);" target="new_window">
                    <?php
					echo '
                    	<input name="product_id" type="hidden" value="3944" /> 
                        <input name="pay_item_id" type="hidden" value="'.$payment_id.'" />
                        <input name="amount" id="total_kobo" type="hidden" value="'.$total_kobo.'" />
                        <input name="currency" type="hidden" value="566" />
                        <input name="site_redirect_url" type="hidden" value="'.$return_url.'" />
                        <input name="txn_ref" id="txn_ref" type="hidden" value="'.$transaction_id.'" /> 
                        <input name="hash" type="hidden" value="'.$ourhas.'" />
                        <input name="cust_id" type="hidden" value="'.$result["form_id"].'" />
                        <input name="cust_name" type="hidden" value="'.$fullname.'" />';
					?>
						
 						
 						
 						<button class="btn btn-primary" name="Continue" id="Continue">
  						<span>Pay Via Interswitch</span></button>
  						
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
</body>
</html>
<script type="text/javascript" src="js/payment.js"></script>