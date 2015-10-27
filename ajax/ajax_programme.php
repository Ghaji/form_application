<?php
	require_once ("../inc/initialize.php");
	//print_r($_SESSION);
	//Passing Post value to the page
	$full_name = htmlspecialchars($_POST['full_name'], ENT_QUOTES);
	$programme = htmlspecialchars($_POST['faculty_id'], ENT_QUOTES);
	$course = htmlspecialchars($_POST['department_id'], ENT_QUOTES);
	$type_of_programme = htmlspecialchars($_POST['type_of_programme'], ENT_QUOTES);
	
	//Generate and save the applicant form number to the form. 
	$form_id = form_id_generator($session->applicant_id, $programme);
	
	//this is to pick from two differenet tables and save the information the page.
	$sql_fac = "SELECT department_id, d.faculty_id, d.department_name, f.faculty_name, f.faculty_code FROM department d 
	INNER JOIN faculty f ON d.faculty_id = f.faculty_id WHERE d.department_id = '".$course."' LIMIT 1";
	$result_set_fac = $database->query($sql_fac);
		  
	while($row = $database->fetch_array($result_set_fac))
	{
		$programme_db = $row['faculty_name'];
		$fac_code_db = $row['faculty_code'];
		$course_db = $row['department_name'];
	}
	
	$_SESSION['programme'] = $programme;
	$_SESSION['course'] = $course; 
	$_SESSION['form_id'] = $fac_code_db.$form_id;
	$_SESSION['student_status'] = $fac_code_db;
	$_SESSION['type_of_programme'] = $type_of_programme;
	

	sleep(2);
	echo '<h4 class="alert alert-info">Verify your details before you continue</h4>';
	echo '<form>
	<table class="table table-hover">
			<tr ><td>Name:</td><td>'.$full_name.'</td></tr>
			<tr ><td>Form Number:</td><td>'.$fac_code_db.$form_id.'</td></tr>
			<tr ><td>Programme:</td><td>'.$programme_db.'</td></tr>
			<tr ><td>Course:</td><td>'.$course_db.'</td></tr>
			<tr>
			<td colspan="2" ><a href="payment.php" class="btn btn-primary">Proceed to make Payment</a></td></tr>
			</table></form>';
			
			echo '<p class="alert alert-info">Note: Please make sure you verify your details before proceeding to  make payment because after this step you can\'t make changes to any of your details. <span class="label label-important">All payments made here are non-refundable.</span></p>';
			echo '';
	
	
?>