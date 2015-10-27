<?php
	
	require_once("../../inc/initialize.php");
	
	$staff_id = htmlspecialchars($_POST['staff_id'], ENT_QUOTES);
	$pass = htmlspecialchars($_POST['apassword'], ENT_QUOTES);
	
	// Ensure password is not the default
	// if($pass == '' || $pass == 'pass' || $pass == 'password') {
		// sleep(2);
		// echo '<h4 class="alert alert-error">Error</h4>';
		// echo '<hr>';
		// echo 'Your password is too predictable.';
	// }
	
	$password = sha1($pass);
	
	//Create the greeting message
	$display_greeting = greeting();
	
	//check if an admin account with the staff_id & password already exists
	$sql  = "SELECT * FROM `admin_users` WHERE `staff_id`='".$staff_id."' AND `password`= '".$password."' LIMIT 1";

	$user = AdminLog::find_by_sql($sql);
	$user = array_shift($user);

	if(empty($user)){
	
		// Your don't have an account yet or email and password combination wrong
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo 'Your information does not exist in our database it may be due to the following reasons.';
		echo '<ol>';
		echo '<li>Your staff_id and password combination is wrong.</li>';
		echo '<li>You do not have an account.</li>';
		echo '</ol>';
	} else {
		// store applicant_id in session
		$adminLog = new AdminLog();
		$adminLog->user_id = $user->user_id;
		if($user->activated_status == 1) {
			$adminLog->db_fields = array('last_logged_in');
			$adminLog->last_logged_in = date('Y-m-d H:i:s');
			$adminLog->save();
			$session->admin_login($user->user_id);
			
			$_SESSION["role"] = $user->role;
			if($user->role == 4){
				$_SESSION["department_id"] = $user->department_id;
			}
			
			sleep(2);
			echo '<h4 class="alert alert-success">'.$display_greeting .', '. ucfirst($user->surname).' '.ucfirst($user->othernames) .'</h4>';
			if($user->edit_status == 0)
			{
				echo '<hr>';
				echo 'You must edit your details before you can continue<br>';
				echo '<hr>';
				echo '<a href="editprofile.php" class="btn btn-info">Proceed</a>';
			}
			else{
				echo '<hr>';
				echo 'You can continue with your administrative privieges<br>';
				echo '<hr>';
				echo '<a href="home.php" class="btn btn-info">Proceed</a>';
			}
		} else {
			echo '<h4 class="alert alert-warning">Warning!</h4>';
			echo '<hr>';
			echo 'You cannot log in because your account is currently deactivated.';
		}
	}
	
?>