<?php
	require_once("../../inc/initialize.php");

	//print_r ($_POST);
	
	$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
	$staff_id = htmlspecialchars($_POST['staffid'], ENT_QUOTES);
	
	//checks if an account with the email & phone number already exists
	$sql  = "SELECT * FROM `admin_users` WHERE `email`='".$email."' OR `staff_id`= '".$staff_id."' LIMIT 1";

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
	
			$user = new AdminLog();
			$user->surname 		= htmlspecialchars($_POST['surname'],ENT_QUOTES);
			$user->othernames	= htmlspecialchars($_POST['othernames'],ENT_QUOTES);
			$user->password 	= htmlspecialchars(sha1($_POST['epassword']),ENT_QUOTES);
			$user->email 		= htmlspecialchars($_POST['email'],ENT_QUOTES);
			$user->staff_id	= htmlspecialchars($_POST['staffid'],ENT_QUOTES);
			$user->rank	= htmlspecialchars($_POST['rank'],ENT_QUOTES);
			$user->role = htmlspecialchars($_POST['role'], ENT_QUOTES);
			$user->department_id = htmlspecialchars($_POST['department_id'], ENT_QUOTES);
			$user->activated_status = 1;
			$user->save();
		  
			if($database->affected_rows() == 1){
				
				if($user->sendVerificationMail($_POST['epassword']))
				{
					sleep(2);
					echo '<h4 class="alert alert-success">Success</h4>';
					echo '<hr>';
					echo "The Information for staff with ID <font color=#0000FF>" . $user->staff_id . "</font> has been successfully saved.\n";
					echo "Use the close botton to go back and continue";
					echo '<br>';
					
				}
				else
				{
					sleep(2);
					echo '<h4 class="alert alert-info">Information</h4>';
					echo '<hr>';
					echo 'Your information has been successfully saved but activation mail was not sent.<br>';

					echo 'Please contact us at <span class="label label-success">support@unijos.edu.ng</span> for further enquiries';
					echo '<br>';
				}
			 
		  }else{
			  
			  sleep(2);
			  echo '<h4 class="alert alert-success">Success</h4>';
			  echo '<hr>';
			  echo "The Information cannot be Saved at this time <br> ";
			  echo "Contact the system administrator to do that.";
		  }
	
	}
	
?>