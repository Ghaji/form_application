<?php
	require_once("../../inc/initialize.php");
	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	$staff_id = htmlspecialchars($_POST['staffid'], ENT_QUOTES);
	
	//checks if an account with the email & phone number already exists
	$sql  = "SELECT * FROM `admin_users` WHERE (`email`='".$email."' OR `staff_id`= '".$staff_id."') AND user_id != '".$session->applicant_id."'LIMIT 1";

	$user_exists = AdminLog::find_by_sql($sql);

	foreach($user_exists as $user_exist)
	{	
	  $user_exist->email;
	  $user_exist->staff_id;
	}
	
	if($user_exist->email == $email){
		
		  sleep(2);
		  echo '<h4 class="alert alert-error">Error</h4>';
		  echo '<hr>';
		  echo "The E-mail:<font color='#FF0000'>'" . $user_exist->email  . "'</font> already exists in our database";
		  echo '<br>';
		  echo 'Use the Close Button to Continue';
	
	}elseif($user_exist->staff_id == $staff_id){
		
		  sleep(2);
		  echo '<h4 class="alert alert-error">Error</h4>';
		  echo '<hr>';
		  echo "The Staff ID:<font color='#FF0000'> '" . $user_exist->staff_id . "'</font> already exists in our database";
		  echo '<br>';
		  echo 'Use the Close Button to Continue';
		  
	
	}
	else{
			//get current details from the db
			$initial_details = AdminLog::find_by_id($session->applicant_id);
			
			if($initial_details->edit_status == 0 && $initial_details->password == htmlspecialchars(sha1($_POST['epassword']),ENT_QUOTES))
			{
				sleep(2);
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "You cannot use the same password<br> ";
				echo '<hr>';
				exit();
			}
			
			$user = new AdminLog();
			$user->user_id = $session->applicant_id;
			$user->surname 		= htmlspecialchars($_POST['surname'],ENT_QUOTES);
			$user->othernames	= htmlspecialchars($_POST['othernames'],ENT_QUOTES);
			$user->password 	= htmlspecialchars(sha1($_POST['epassword']),ENT_QUOTES);
			$user->email 		= htmlspecialchars($_POST['email'],ENT_QUOTES);
			$user->staff_id	= htmlspecialchars($_POST['staffid'],ENT_QUOTES);
			$user->rank	= htmlspecialchars($_POST['rank'],ENT_QUOTES);
			$user->edit_status = 1;
			$user->db_fields = array('staff_id', 'surname', 'othernames', 'password', 'email', 'rank', 'edit_status');
			
			$user->save();
		  
			if($database->affected_rows() == 1){
				
				sleep(2);
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "You have successfully edited your account\n";
				echo '<hr>';
				echo "Use the button below to proceed";
				echo '<hr>';
				echo '<a href="home.php" class="btn btn-info">Proceed</a>';
			 
		  }else{
			  
			  sleep(2);
			  echo '<h4 class="alert alert-error">Error</h4>';
			  echo '<hr>';
			  echo "The Information cannot be Saved at this time <br> ";
			  echo "Contact the system administrator to do that.";
		  }
	
	}
	
?>