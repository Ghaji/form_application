<?php
	require_once('../inc/initialize.php');
	
	$photograph = new Photograph();
	
	$photograph_details = $photograph->find_by_id($session->applicant_id);
	
	if($_FILES['picture']['error'] == 2)
	{
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Maximum File size Exceeded(250Kb)";
		die();
	}
	
	if(!empty($photograph_details) && !empty($_FILES['picture']['name']))
	{
		$photograph->image_id = $photograph_details->image_id;

		unlink(SITE_ROOT.DS.'passport'.DS.$photograph_details->filename);
	}
	
	$arrayfiledetails = explode('.', $_FILES['picture']['name']);
	
	$extension = $arrayfiledetails[sizeof($arrayfiledetails)-1];
	
	$_FILES['picture']['name'] = $session->applicant_id.'.'.$extension;
	
	if($photograph->attach_file($_FILES['picture']))
	{
		$photograph->caption = User::applicant_fullname($session->applicant_id);
		$photograph->applicant_id = $session->applicant_id;
		
		//explode filename to get file extension
		
		$photograph->filename = $_FILES['picture']['name'];
		
		if($photograph->save())
		{
			$user = new User();
			$user->applicant_id = $session->applicant_id;
			$user->updateProgress('G');
			sleep(2);
			echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
			echo '<hr>';
			echo 'Your <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;">Passport</span> has been successfully uploaded';
			echo '<br><hr>';
		}
		else {
			sleep(2);
			echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
			echo '<hr>';
			echo 'Your <span style=" font-weight: bold; text-shadow: 1px 1px 4px red;">Passport</span> was not uploaded, due to some errors';
			echo '<br><hr>';
		}
	}
	else{
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "File not attached, Please check the file again\nEnsure the file is in png or jpeg format";
		echo '<br><hr>';
	}
?>