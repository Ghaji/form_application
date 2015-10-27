<?php
	require_once("../../inc/initialize.php");
	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	
	$user = new User();
	$user_exists = $user->find_by_sql("SELECT * FROM `personal_details` WHERE `email`='".$email."' LIMIT 1");
	if(empty($user_exists))
	{
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "This E-mail: <font color='#FF0000'>'" . $email  . "'</font> does not exist in our database";
		echo '<br>';
		echo 'Use the Close Button to Continue';
	}
	else
	{
		$user->email = $email;
		$user_exists = array_shift($user_exists);
		if($user_exists->progress == 'Completed'){
			$referees = new Referees();
			$referees_details = $referees->find_by_sql("SELECT * FROM referees WHERE applicant_id='".$user_exists->applicant_id."'");
			$mail_error = '';
			foreach($referees_details as $referee_info)
			{
				$referees->referee_email = $referee_info->referee_email;
				$referees->referee_name = $referee_info->referee_name;
				$referees->referees_id = $referee_info->referees_id;
				if(!$referees->sendRefereeMail())
				{
					$mail_error .= "Mail not sent to ".$referees->referee_email."<br>";
				}
			}
			
			if($mail_error == ''){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "Referee mails for applicant with email: <font color='#FF0000'>'" . $email  . "'</font> has been successfully sent";
				echo '<br>';
				echo 'Use the Close Button to Continue';
			}
			else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo $mail_error;
				echo 'Use the Close Button to Continue';
			}
			
		}
		else{
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "The applicant with this e-mail: <font color='#FF0000'>'" . $email  . "'</font> has not completed his application";
			echo '<br>';
			echo 'Use the Close Button to Continue';
		}
	}
	
?>