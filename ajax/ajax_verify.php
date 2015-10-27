<?php
	require_once("../inc/initialize.php");
	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES);

	$password = htmlspecialchars(md5($_POST['epassword']), ENT_QUOTES);
	
	//Checks the table if the email is in the database and it corresponds with the password entered
	$sql  = "SELECT * FROM `personal_details` WHERE `email`='".$email."' AND `password`= '".$password."' LIMIT 1";

	$user_exists = User::find_by_sql($sql);

	foreach($user_exists as $user_exist)
	{	
	  $user_exist->email;
	  $user_exist->password;
	  $user_exist->applicant_id;
	  $user_exist->mail_validation;
	}
	
	if($user_exist->email != $email){	
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Invalid password, Enter your password again. \n";
		echo "Password is case sensitive";
	}else{
		if($user_exist->mail_validation == 1)
		{
			sleep(2);
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo 'Your account has been verified already<br>';
			echo 'Use the Button below to Continue your registration<br>';
			echo '<a href="index.php" class="btn btn-primary">Continue</a>';
		}
		else
		{
			$user = new User();		
			$user->applicant_id = $user_exist->applicant_id;
			$user->mail_validation=1;
			$user->db_fields = array('mail_validation');
			$user->save();
			if($database->affected_rows() == 1)
			{
				$session->login($user->applicant_id);	
				sleep(2);
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo 'You have successfully verified your account, to continue your registration, use the button below';
				echo '<a href="select_form.php" class="btn btn-primary">Click Here</a>';
			}
			else
			{
				sleep(2);
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo 'Your account was not verified, Please try again later...';
			}
		}
	}
?>
