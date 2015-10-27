<?php
require_once('../inc/initialize.php');

	$error_higher_institution = false;
	$error_other_relevant_qualification = false;
	$error_secondary_school = false;
	$error_olevel = false;
	$error_academic_prizes = false;

	/*Update Higher Institution*/
  	$high_inst = new HigherInstitutions();
	$high_inst->db_fields = array('high_id','applicant_id','institution_name','class_of_degree','year_of_attendance','graduation_year','degree_earned','cgpa','course_of_study');
	
	
	/*loop for number of higher institution rows*/
	for($i = 1; $i < $_POST['num_of_high_insti_rows']; $i++) {
		$high_inst_key = 'tetiary_institution_name_'.$i;
		$class = 'tetiary_institution_class_'.$i;
		$from = 'tetiary_institution_from_'.$i;
		$to = 'tetiary_institution_to_'.$i;
		$degree = 'tetiary_institution_degree_'.$i;
		$cpga = 'tetiary_institution_cgpa_'.$i;
		$course = 'tetiary_institution_course_'.$i;
		$high_id = "high_id_".$i;
		
		/*set properties for higher institution details*/
		$high_inst->institution_name = $_POST[$high_inst_key];
		$high_inst->class_of_degree = $_POST[$class];
		$high_inst->year_of_attendance = $_POST[$from]; 
		$high_inst->graduation_year = $_POST[$to];
		$high_inst->degree_earned = $_POST[$degree];
		$high_inst->cgpa = $_POST[$cpga];
		$high_inst->course_of_study = $_POST[$course];
		if($high_inst->institution_name == '')
		{
			continue;
		}
		/*obatin applicant id from session*/
		$high_inst->applicant_id = $session->applicant_id;
		
		/*obtain $_POST[$high_id] if it is set and not empty*/
		if (isset($_POST[$high_id]) && !empty($_POST[$high_id])) {
			$high_inst->high_id = $_POST[$high_id];
		}
		
		/*insert new record or update existing record in the higher_institution table*/
		if(!$high_inst->save()) {
			$error_higher_institution = true;
		}
		
		$high_inst->high_id = null;
	}

	/*Update Other Qualifications*/
    $qualification = new Qualifications();
	$qualification->db_fields = array('other_qualifications_id','applicant_id','name_of_institutions','from_year','to_year','certificate_qualification_name','grade');
	
	/*loop for number of Other Qualifications rows*/
	
	for($j = 1; $j < $_POST['num_of_o_qualification_rows']; $j++) {
		$name_of_insti = 'other_qualification_institute_name_'.$j;
		$from = 'other_qualification_from_'.$j;
		$to = 'other_qualification_to_'.$j;
		$certificate = 'other_qualification_certificate_'.$j;
		$grade = 'other_qualification_grade_'.$j;
		$qual_id = 'qual_id_'.$j;
		 
		/*set properties for Other Qualifications details*/
		$qualification->name_of_institutions = $_POST[$name_of_insti];
		$qualification->from_year = $_POST[$from]; 
		$qualification->to_year = $_POST[$to];
		$qualification->certificate_qualification_name = $_POST[$certificate];
		$qualification->grade = $_POST[$grade];
		
		if($qualification->name_of_institutions == '')
		{
			continue;
		}
		
		/*obatin applicant id from session*/
		$qualification->applicant_id = $session->applicant_id;
		
		/*obtain $_POST[$high_id] if it is set and not empty*/
		if (isset($_POST[$qual_id]) && !empty($_POST[$qual_id])) {
			$qualification->other_qualifications_id = $_POST[$qual_id];
		}
		
		/*insert new record or update existing record in the Other Relevant Qualifications table*/
		if(!$qualification->save()) {
			$error_other_relevant_qualification = true;
		}
		
		$qualification->other_qualifications_id = null;
	}

	/*Update Secondary School Attended*/
	$school = new SecondarySchoolUser();
	$school->db_fields = array('school_id','applicant_id','school_name','school_address','from_year','to_year');
	
	
	/*loop for number of Secondary School rows*/
	for($k = 1; $k < $_POST['num_of_sec_school_rows']; $k++) {
		
		/*keys for post values*/
		$name = "secondary_school_name_".$k;
		$address = "secondary_school_address_".$k;
		$from_y = "secondary_school_from_".$k;
		$to_y = "secondary_school_to_".$k;
		$sch_id = 'sch_id_'.$k;
		
		/*set properties for the Secondary School details*/
		$school->school_name = $_POST[$name];
		$school->school_address = $_POST[$address];
		$school->from_year = $_POST[$from_y];
		$school->to_year = $_POST[$to_y];
		
		if($school->school_name == '')
		{
			continue;
		}
		
		/*obatin applicant id from session*/
		$school->applicant_id = $session->applicant_id;
		
		/*obtain $_POST[$high_id] if it is set and not empty*/
		if (isset($_POST[$sch_id]) && !empty($_POST[$sch_id])) {
			$school->school_id = $_POST[$sch_id];
		}
		
		/*insert new record or update existing record in the Secondary School table*/
		if(!$school->save()) {
			$error_secondary_school = true;
		}
		
		$school->school_id = null;
	}
	
	/*Update Awards and Prizes*/
	$user = new User();
	$user->db_fields = array('academic_prizes');
	$award_record = array();
	
	/*loop for number of Awards and Prizes rows*/
	for($a = 1; $a < $_POST['num_of_award_rows']; $a++) {
		$prize  = 'academic_prize_'.$a;
		$award_body  = 'awarding_body_'.$a;
		$year  = 'award_year_'.$a;
		
		if($_POST[$prize] == '')
		{
			continue;
		}
		
		/*temporary array for Awards and Prizes*/
		$temp_arr = array('prize' => $_POST[$prize], 'awarding_body' => $_POST[$award_body], 'year' => $_POST[$year]);
		$award_record[$a] = $temp_arr;
	}
		
	$user->academic_prizes = serialize($award_record);
	
	/*obatin applicant id from session*/
 	$user->applicant_id = $session->applicant_id;
	
	if(!$user->save()) {
			$error_academic_prizes = true;
	}
	
	/*update O level details*/
	$olevel = new Olevel();
	
	//checks if the user has removed second sitting and thereby deletes the second sitting from the db
	if($_POST['exam_no_2'] == '')
	{
		//get the id of the second sitting
		$resultsecondsitting = $olevel->find_by_sql("SELECT o_level_id FROM o_level_details WHERE applicant_id='".$session->applicant_id."' ORDER BY o_level_id DESC");
		$resultsecondsitting = array_shift($resultsecondsitting);
		if(sizeof($resultsecondsitting) > 1){
			$olevel->o_level_id = $resultsecondsitting->o_level_id;	
			$olevel->delete();
		}
	}
	
	$olevel->db_fields = array('o_level_id','applicant_id','subject_grade','exam_number','exam_year','exam_centre','exam_type_id');
	$o = 1;

	/*loop for number of Exam sitting*/
	
	while($o <= $_POST['num_of_exam_sitting']) {
		$no = 'exam_no_'.$o;
		$year = 'exam_year_'.$o;
		$type = 'exam_type_'.$o;
		$centre = 'exam_centre_'.$o;
		
		/*set properties for the O Level details*/
		$olevel->exam_number = $_POST[$no];
		$olevel->exam_year = $_POST[$year];
		$olevel->exam_type_id = $_POST[$type];
		$olevel->exam_centre = $_POST[$centre];
		
		$temp_arr = array();
		
		$z = 1;
		if($o == 1) {
			while($z < $_POST['num_of_o_level1']) {
				$o_level_subject_id = "o_level_".$o."_subject_$z";
				$o_level_grade_id = "o_level_".$o."_grade_$z";
				
				$temp_arr[$o_level_subject_id] = $_POST[$o_level_subject_id];
				$temp_arr[$o_level_grade_id] = $_POST[$o_level_grade_id];
				$z++;
			}
		} else if($o == 2) {
			while($z < $_POST['num_of_o_level2']) {
				$o_level_subject_id = "o_level_".$o."_subject_$z";
				$o_level_grade_id = "o_level_".$o."_grade_$z";
				
				$temp_arr[$o_level_subject_id] = $_POST[$o_level_subject_id];
				$temp_arr[$o_level_grade_id] = $_POST[$o_level_grade_id];
				$z++;
			}
		}
		
		$olevel->subject_grade = serialize($temp_arr);
		
		/*set appropriate o_level_id*/
		if (isset($_POST['o_level1_id']) && !empty($_POST['o_level1_id']) && $o == 1) {
			$olevel->o_level_id = $_POST['o_level1_id'];
		} else if (isset($_POST['o_level2_id']) && !empty($_POST['o_level2_id'])) { 
			$olevel->o_level_id = $_POST['o_level2_id'];
		}

		/*obatin applicant id from session*/
 		$olevel->applicant_id = $session->applicant_id;
		

		/*insert new record or update existing record in the O Level Details table*/
		if(!$olevel->save()) {
				$error_olevel = true;
		}
		$olevel->o_level_id = null;
			
		$o++;
	}
		
	/*User Feedback*/
	if($error_higher_institution == true){
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "Your details in the Tetiary Institution section were not saved.";
		echo '<br><hr>';
	}
	if($error_other_relevant_qualification == true){
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "Your details in the Other Relevant Qualifications section were not saved.>";
		echo '<br><hr>';
	}
	if($error_secondary_school == true){
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "Your details in the Secondary School section were not saved.";
		echo '<br><hr>';
	}
	if($error_olevel == true){
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "Your details in the Secondary School section were not saved.";
		echo '<br><hr>';
	}
	if($error_academic_prizes == true){
		sleep(2);
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "Your details in the Secondary School section were not saved.";
		echo '<br><hr>';
	}
	if($error_higher_institution == false && $error_other_relevant_qualification == false && $error_secondary_school == false && $error_olevel == false && $error_academic_prizes == false){
		$user = new User();
		$user->applicant_id = $session->applicant_id;
		$user->updateProgress('B');
		sleep(2);
		echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
		echo '<hr>';
		echo 'You have successfully saved your <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;"> Academic qualification </span> details tab.';
		echo '<br><hr>';
				
	}
?>