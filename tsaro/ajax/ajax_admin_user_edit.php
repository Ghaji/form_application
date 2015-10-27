<?php
	require_once("../../inc/initialize.php");
	
	// print_r($_POST);
	// die();
	if(isset($_POST['uid'])) {
		$user = new AdminLog();
		$user->user_id 			= customDecrypt($_POST['uid']);
		$user->surname 			= $_POST['surname'];
		$user->othernames		= $_POST['othernames'];
		if($_POST['epassword'] != ''){
			$user->password 		= sha1($_POST['epassword']);
			$user->db_fields=array('surname', 'othernames', 'password', 'email', 'staff_id', 'rank', 'activated_status', 'role', 'department_id');
		}else{
			$user->db_fields=array('surname', 'othernames', 'email', 'staff_id', 'rank', 'activated_status', 'role', 'department_id');
		}
		$user->email 			= $_POST['email'];
		$user->staff_id			= $_POST['staffid'];
		$user->rank				= $_POST['rank'];
		$user->activated_status = $_POST['activated_status'];
		$user->role				= $_POST['role'];
		
		if($user->role != 4){
			$user->department_id = 0;
		}else{
			$user->department_id	= $_POST['department_id'];
		}

		// print_r($user);
		// die();
		
		 //$database->affected_rows() == 1
		if($user->save()){
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo "You have successfully edited ".$user->surname." ".$user->othernames."'s account\n";
			echo '<hr>';
			echo "Use the button below to proceed to view admin users";
			echo '<hr>';
			echo '<a href="view_users.php" class="btn btn-info">View Users</a>';
		 
	    }else{
		  	echo "No change was made to ".$user->surname." ".$user->othernames."'s account\n";
	    }
  }
?>