<?php 
	require_once("../inc/initialize.php");
	
	$email = htmlspecialchars($_POST['email'],ENT_QUOTES);
	$epassword = htmlspecialchars($_POST['epassword'],ENT_QUOTES);
	$epassword = md5($epassword);
	
	//Create the greeting message
	$display_greeting = greeting();
	
	$sql = "SELECT * FROM `personal_details` WHERE `email`='".$email."' AND `password`='".$epassword."' LIMIT 1";
	$user_exists = User::find_by_sql($sql);

	if(empty($user_exists)){
	
		// Your don't have an account yet or email and password combination wrong
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo 'Your information does not exist in our database it may be due to the following reasons.';
		echo '<ol>';
		echo '<li>Your email and password combination is wrong.</li>';
		echo '<li>You have not created an account yet.</li>';
		echo '</ol>';
		echo '<span class="label label-success">Note:</span> Use the create account button below to create an account.';
	} else {
		foreach($user_exists as $user):
			if ($user->mail_validation == 0) {
				
				// account not activated
				$user_for_mail = new User();
				$user_for_mail->email = $user->email;
				$user_for_mail->sendVerificationMail();
				sleep(2);
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo 'Your account has not been activated. Activate your account using the link sent to your email.';
				echo '<hr>';
			} else {
				
				$form_id = $user->form_id;
				
				/* no access code/pin in the personal details_table.
				 * form_id is the relationship and is unique*/
				$sql_payment = "SELECT * FROM `adm_access_code` WHERE `jamb_rem_no`='".$form_id."' AND `reg_num`='".$form_id."' LIMIT 1";
				$user_payments = User::find_by_sql($sql_payment);	
						
					if(empty($user_payments)) {
						
					// redirect to buy form
					$session->login($user->applicant_id);
					sleep(2);
					echo '<h4 class="alert alert-success">'.$display_greeting .', '. ucfirst($user->surname).' '.ucfirst($user->first_name) .'</h4>';
					echo '<hr>'; 
					echo 'No Payment Information Found for: ';
					echo '<span class="label label-success">' .$user->surname. ' ' . $user->first_name . ' ' . $user->middle_name .'</span><br>';
					echo 'Please use the link below to proceed and make payment.<br><br>';
					echo '<hr>';
					echo '<a href="select_form.php" class="btn btn-primary">Proceed</a>';
					
					}elseif($user->progress == 'Completed'){
						$session->login($user->applicant_id);
						sleep(2);
						echo '<h4 class="alert alert-success">'.$display_greeting .', '. ucfirst($user->surname).' '.ucfirst($user->first_name) .'</h4>';
						//echo '<hr>';
						echo '<table class="table table-hover"><tr>
						<td colspan="2" >You have completed your application. Click the link below to proceed</td></tr>
						<tr><td></td><td>&nbsp;</td></tr>
						<tr>
						<td colspan="2" ><a href="home.php" class="btn btn-primary">Proceed</a></td></tr>
						</table>';
					}
					else{
						
					// store applicant_id in session
					$session->login($user->applicant_id);
					// continue with registration
					sleep(2);
					echo '<h4 class="alert alert-success">'.$display_greeting .', '. ucfirst($user->surname).' '.ucfirst($user->first_name) .'</h4>';
					//echo '<hr>';
					echo '<table class="table table-hover"><tr>
					<td colspan="2" >You can continue with your application by using the link below.</td></tr>
					<tr><td>Fullname:</td><td>'.$user->surname . ' ' . $user->first_name . ' ' . $user->middle_name.'</td></tr>
					<tr><td>Form Number:</td><td>'.$user->form_id.'</td></tr>
					<tr><td></td><td>&nbsp;</td></tr>
					<tr>
					<td colspan="2" ><a href="application_form.php" class="btn btn-primary">Proceed</a></td></tr>
					</table>';
					}
			}
		endforeach;
	}
	
?>