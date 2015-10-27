<?php
	require_once('../inc/initialize.php');
	
	$user = new User();
	
	$sqlstatus = $user->find_by_sql("SELECT student_status FROM personal_details WHERE applicant_id = ".$session->applicant_id);
	
	$sqlstatus = array_shift($sqlstatus);

	if($sqlstatus->student_status == 'PGA'){
		$arrayDateDetails = explode('-', $_POST['dob']);
		
		$dateintimeformat = mktime(0, 0, 0, $arrayDateDetails[1], $arrayDateDetails[2], $arrayDateDetails[0]);
	
		if(time() - $dateintimeformat < 568080000){
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Sorry, You must be at least 18 years to register for Post-Graduate Programme";
			echo "<br>";
			echo '<hr>';
			
			exit();
		}
	}
	
	$user->db_fields = array('title_id', 'gender', 'marital_status', 'dob', 'address', 'lga_id', 'religion_id', 'country_id');
	
	$user->title_id= $_POST['title_id'];
	
	$user->gender = $_POST['gender_id'];
	
	$user->marital_status = $_POST['marital_status_id'];
	
	$user->dob = $_POST['dob'];
	
	$user->country_id = $_POST['country_id'];
	
	$user->lga_id = $_POST['lga_id'];
	
	$user->religion_id = $_POST['religion_id'];
	
	$user->address = $_POST['address'];
	
	$user->applicant_id = $session->applicant_id;

	if($user->save())
	{
		$next_of_kin = new NextOfKin();
		
		$next_of_kin_details = $next_of_kin->find_by_id($user->applicant_id);
		
		if(!empty($next_of_kin_details))
		{
			$next_of_kin->next_kin_id = $next_of_kin_details->next_kin_id;
		}
		
		$next_of_kin->next_of_kin_name = $_POST['next_kin_name'];
		
		$next_of_kin->next_of_kin_relationship = $_POST['next_of_kin_relationship'];
		
		$next_of_kin->next_of_kin_number = $_POST['next_of_kin_number'];
		
		$next_of_kin->next_of_kin_address = $_POST['next_of_kin_address'];
		
		$next_of_kin->applicant_id = $user->applicant_id;
		
		if($next_of_kin->save())
		{
			$user->updateProgress('A');
			
			sleep(2);
			echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
			echo '<hr>';
			echo 'You have successfully saved your <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;">Personal Details </span> tab, use the close button to continue.';
			echo "<br>";
			echo '<hr>';
		}
		else
		{
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Your next of kin details were not saved";
			echo "<br>";
			echo '<hr>';
		}
	}
	else
	{
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Your personal details were not saved\n";
		echo "<br>";
		echo '<hr>';
	}
?>