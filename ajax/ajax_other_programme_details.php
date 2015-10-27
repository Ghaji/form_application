<?php
	require_once('../inc/initialize.php');
	
	$other_programme = new OtherProgramme();
	
	$other_programme->applicant_id = $session->applicant_id;
	$other_programme->sponsor_fullname = $_POST['fullname_id'];
	$other_programme->sponsor_occupation = $_POST['occupation'];
	$other_programme->sponsor_address = $_POST['address'];
	$other_programme->applied_to_other_institution = $_POST['applied_to_other_institution'];
	if($other_programme->applied_to_other_institution == 0)
	{
		$other_programme->denied_admission = $other_programme->institution_name = $other_programme->institution_address = $other_programme->other_details = $other_programme->name_of_institution = $other_programme->address_of_institution = $other_programme->date_of_admission = $other_programme->course_of_study = '';
	}
	else
	{
		$other_programme->denied_admission = $_POST['denied_admission'];
		$other_programme->institution_name = $_POST['institution_name'];
		$other_programme->institution_address = $_POST['institution_address'];
		$other_programme->other_details = $_POST['other_details'];
		$other_programme->name_of_institution = $_POST['name_of_institution'];
		$other_programme->address_of_institution = $_POST['address_of_institution'];
		$other_programme->date_of_admission = $_POST['date_of_adm'];
		$other_programme->course_of_study = $_POST['Present_Course_of_Study'];
	}
	$other_programme->reasons = $_POST['reasons_for_seeking_admission'];
	
	$other_programme_details = $other_programme->find_by_id($other_programme->applicant_id);
	
	if(!empty($other_programme_details))
	{
		$other_programme->other_details_id = $other_programme_details->other_details_id;
	}
	
	if($other_programme->save())
	{
		$user = new User();
		$user->applicant_id = $session->applicant_id;
		$user->updateProgress('I');
		sleep(2);
		echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
		echo '<hr>';
		echo 'Your details for other programme details have been saved successfully';
		echo '<br><hr>';
	}
	else
	{
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo 'Your details were not saved due to some reason';
		echo '<br><hr>';
	}
?>