<?php
	require_once('../inc/initialize.php');

	$referee = new Referees();
	
	$referee->referees_id = $_POST['referee_id'];

	$referee_details = $referee->find_by_id($referee->referees_id);

	if($referee_details->referee_form_status == 1)
	{
		echo '<h4 class="alert alert-error">Error</h4><br>';
		echo 'You have already filled this before';
	}
	else
	{
		$referee->professional_rank = $_POST['referee_rank'];
	
		$referee->referee_address = $_POST['address'];
		
		$referee->referee_job_description = $_POST['job_description'];
		
		$referee->how_long = $_POST['how_long'];
		
		$referee->what_capacity = $_POST['whatcapacity'];

		$referee->comments_on_candidate = $_POST['comment'];

		$referee->rank_candidate = $_POST['rank_candidate'];
		
		$referee->referee_highest_qualification_obtained = $_POST['referee_rank'];
		
		$intellectual_capacity = $_POST['intellectual_capactiy'];
		
		$capactiy_for_persistence = $_POST['capactiy_for_persistence'];
		
		$ability_for_imagination = $_POST['ability_for_imagination'];
		
		$promise_of_productive_scholarship = $_POST['promise_of_productive_scholarship'];
		
		$quality_of_previous_work = $_POST['quality_of_previous_work'];
		
		$oral_written_expressions = $_POST['oral_written_expressions'];
		
		$questionnaire = serialize(array('intellectual_capactiy'=>$intellectual_capacity, 'capactiy_for_persistence'=>$capactiy_for_persistence, 'ability_for_imagination'=>$ability_for_imagination, 'promise_of_productive_scholarship'=>$promise_of_productive_scholarship, 'quality_of_previous_work'=>$quality_of_previous_work, 'oral_written_expressions'=>$oral_written_expressions));
		
		$referee->questionnaire = $questionnaire;
		
		$referee->referee_form_status = 1;
		
		$referee->db_fields = array('referee_form_status','referee_job_description','referee_address','referee_highest_qualification_obtained','rank_candidate','questionnaire','comments_on_candidate', 'how_long', 'what_capacity');
		
		if($referee->save())
		{
			sleep(2);
			echo '<h4 class="alert alert-success">Success</h4><br>';
			echo 'Thank you for filling the questionnaire';
		}
		else
		{
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4><br>';
			echo 'Sorry, the fields were not saved';
		}
	}
	
?>