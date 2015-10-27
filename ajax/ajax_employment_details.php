<?php
	require_once('../inc/initialize.php');
	
	$employment = new Employment();
	
	
	/*loop for number of employment rows*/
	for($i = 1; $i < $_POST['num_of_emp_rows']; $i++) {
		$emp_key = 	'employer_'.$i;
		$emp_year_key = 'employment_year_'.$i;
		$emp_addr_key = 'employer_address_'.$i;
		
		/*temporary array for employment details*/
		if($_POST[$emp_key] == '')
		{
			continue;
		}
		
		$temp_arr = array('employer' => $_POST[$emp_key], 'year' => $_POST[$emp_year_key], 'address' => $_POST[$emp_addr_key]);
		
		/*Serialize for each column in the employment table*/
		switch ($i) {
			case 1:
				$employment->employment_detail_one = serialize($temp_arr);
				break;
			case 2:
				$employment->employment_detail_two = serialize($temp_arr);
				break;
			case 3:
				$employment->employment_detail_three = serialize($temp_arr);
				break;
			case 4:
				$employment->employment_detail_four = serialize($temp_arr);
				break;
			default:
				// Please remeber to set i
				break;
		}
		
		$employment->applicant_id = $session->applicant_id;
	}
	
	$employment_details = $employment->find_by_id($employment->applicant_id);
		
	/*set employment_id*/
	if(!empty($employment_details))
	{
		$employment->employment_id = $employment_details->employment_id;
	}
	
	//print_r($employment);
	/*insert new record or update existing record in the employment table*/
	
	/*check any changes to the database employment table*/
	if($employment->save())
	{
		$user = new User();
		$user->applicant_id = $session->applicant_id;
		$user->updateProgress('C');
		
		sleep(2);
		echo '<h4 class="alert alert-success"> <i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
		echo '<hr>';
		echo 'You have successfully saved your <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;"> Employment Details </span> tab.';
		echo '<br><hr>';
	}
	else
	{
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "Your details were not saved please try again later here";
		echo '<br><hr>';
	}
?>