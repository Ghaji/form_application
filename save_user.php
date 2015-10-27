<?php 
require_once('../../inc/initialize.php'); 
/*if($session->is_logged_in()) {
  redirect_to("../../index.php");
}*/
	$username = htmlspecialchars($_POST['username'],ENT_QUOTES);
	$email = htmlspecialchars($_POST['email'],ENT_QUOTES);
	$file = $_FILES['picture']['name'];
	
	$sql = "SELECT * FROM admin WHERE `email` =  '" .$email ."' LIMIT 1";
	
	$user_exists = User::find_by_sql($sql);
	foreach($user_exists as $user_exist):	
	  $user_exist->username;
	  $user_exist->email;
	endforeach;
	
	if($user_exist->username == $username){
		
		  sleep(2);
		  echo '<h4 class="alert alert-error">Error</h4>';
		  echo '<hr>';
		  echo "The Username:<font color='#FF0000'>'" . $user_exist->username . $file . "'</font> already exist in our database. \n";
		  echo "Choose a new one";
	
	}elseif($user_exist->email == $email){
		
		  sleep(2);
		  echo '<h4 class="alert alert-error">Error</h4>';
		  echo '<hr>';
		  echo "The E-mail:<font color='#FF0000'> '" . $user_exist->email . $file . "'</font> already exist in our database. \n";
		  echo "Choose a new one";
	
	}else{
	
		  $user = new User();
		  $user->username 		= htmlspecialchars($_POST['username'],ENT_QUOTES);
		  $user->email 			= htmlspecialchars($_POST['email'],ENT_QUOTES);
		  $user->password 		= htmlspecialchars(md5($_POST['password']),ENT_QUOTES);
		  $user->cpassword 		= htmlspecialchars(md5($_POST['cpassword']),ENT_QUOTES);
		  $user->lname 			= htmlspecialchars($_POST['lname'],ENT_QUOTES);
		  $user->fname 			= htmlspecialchars($_POST['fname'],ENT_QUOTES);
		  $user->mname 			= htmlspecialchars($_POST['mname'],ENT_QUOTES);
		  $user->picture 		= htmlspecialchars($_FILES['picture']['name']);
		  $user->phone 			= htmlspecialchars($_POST['phone'],ENT_QUOTES);
		  $user->regdate 		= htmlspecialchars($_POST['regdate'],ENT_QUOTES);
		  $user->role			= htmlspecialchars($_POST['role'],ENT_QUOTES);
		  $user->status 		= htmlspecialchars($_POST['status'],ENT_QUOTES);
		  $user->account_type 	= htmlspecialchars($_POST['account_type'],ENT_QUOTES);
		  $user->secQ 			= htmlspecialchars($_POST['secQ'],ENT_QUOTES);
		  $user->secA 			= htmlspecialchars($_POST['secA'],ENT_QUOTES);
		  $user->flag 			= htmlspecialchars($_POST['flag'],ENT_QUOTES);
		  
		  $user->save();
		  
		  if($database->affected_rows() == 1){
			  
			  sleep(2);
		  	  echo '<h4 class="alert alert-success">Success</h4>';
		  	  echo '<hr>'; 
			  echo "The Information for <font color='#0066FF'>" . $user->email . "</font> is Successfully Saved\n";
			  echo "Use the close botton to go back and continue";
		  }else{
			  sleep(2);
		      echo '<h4 class="alert alert-error">Error</h4>';
		      echo '<hr>';
			  echo "The Information cannot be Saved at this time <br> ";
			  echo "Contact the system administrator to do that.\n";
		  }
	
	}
?>