<?php
	require_once ('../inc/initialize.php');

	$password = htmlspecialchars(md5($_POST['epassword']), ENT_QUOTES);
	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	
	$sql = "SELECT * FROM `personal_details` WHERE `email`='".$email."'";
	
	$user_details = User::find_by_sql($sql);
	
	if(empty($user_details))
	{
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Invalid email\n";
		echo "Ensure that it was the link in your mail that you clicked";
	}
	else
	{
		foreach($user_details as $users)
		{
			$users->applicant_id;
		}
		
		$user = new User();
		
		$user->applicant_id = $users->applicant_id;
		
		$user->password = $password;

		$user->db_fields = array('password');
		
		$user->save();
		
		if($database->affected_rows() == 1)
			{
				sleep(2);
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo 'You have successfully reset your password<br>';
				echo '<a href="index.php">Continue</a>';
			}
			else
			{
				sleep(2);
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Your password reset was  not successful\n";
				echo "Please try again";
			}
	}
?>