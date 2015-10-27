<?php
require_once ('../inc/initialize.php');

$email = htmlspecialchars($_POST['email'], ENT_QUOTES);

//checks if the email is in the database
$sql = "SELECT * FROM `personal_details` WHERE `email`='".$email."' LIMIT 1";

$user = User::find_by_sql($sql);

if(empty($user))
{
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Invalid email, Are you sure you used that email to register?";
}
else
{
	$user = new User();
	
	$user->applicant_id = $session->applicant_id;
	
	$user->email = $email;
	
	if($user->sendPasswordReset())
	{
		sleep(2);
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo 'A mail has been sent to <span class="success">'.$email.'</span>\n';
		echo 'Check your inbox and follow the instructions';
	}
	else
	{
		sleep(2);
		echo '<h4 class="alert alert-error">error</h4>';
		echo '<hr>';
		echo 'Please try again';
	}
}
?>
