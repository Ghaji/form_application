<?php
	require_once("../../inc/initialize.php");
	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	
	$arrayEmails = explode(', ', $email);
	
	$mailsnotexisting = '';
	$mailsnotsent = '';
	
	foreach($arrayEmails as $key=>$value){
		$email = $value;
		$user = new User();
		$user_exists = $user->find_by_sql("SELECT * FROM `personal_details` WHERE `email`='".$email."' LIMIT 1");
		if(empty($user_exists))
		{
			$mailsnotexisting .= $email.', ';
		}
		else
		{
			$user->email = $email;
			$user_exists = array_shift($user_exists);
			$user->surname = $user_exists->surname;
			$user->first_name = $user_exists->first_name;
			$user->middle_name = $user_exists->middle_name;
			
			if($user->sendVerificationMail())
			{
				
			}
			else
			{
				$mailsnotsent .= $user->email.', ';
			}
		}	
	}
	
	if($mailsnotexisting != '' || $mailsnotsent != ''){
		if($mailsnotexisting != ''){
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "The E-mail(s): <font color='#FF0000'>'" . $mailsnotexisting  . "'</font> does not exist in our database";
			echo '<br>';
			echo 'Use the Close Button to Continue';
		}
		
		if($mailsnotsent != ''){
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "The verification mail(s) to <font color=#0000FF>" . $mailsnotsent . "</font> was not sent\n";
		}
	}
	else{
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "Verification mail has been successfully sent to <font color=#0000FF>" . $user->email . "</font>\n";
	}
	
?>