<?php
	require_once('../inc/initialize.php');
	
	$error_academic_publication = false;
	
	$publication = new Publication();
	
	
	for($i = 1; $i <= $_POST['num_of_pub_rows']; $i++) {
		
		if(isset($_POST['publication_id_'.$i]))
		{
			$publication->publication_id = $_POST['publication_id_'.$i];
		}
		$pub_title_key = 'publication_title_'.$i;
		$pub_inst_key = 'publication_institution_'.$i;
		$pub_qual_key = 'publication_qualification_'.$i;
		$pub_date_key = 'publication_date_'.$i;
		
		$publication->title_of_publication = $_POST[$pub_title_key];
		$publication->institution = $_POST[$pub_inst_key];
		$publication->qualification = $_POST[$pub_qual_key];
		$publication->year_of_publication = $_POST[$pub_date_key];
		
		if($publication->title_of_publication == '')
		{
			continue;
		}
		
		$publication->applicant_id = $session->applicant_id;
		
		if(!$publication->save())
		{
			$error_academic_publication = true;
		}
		unset($publication->publication_id);
	}
	
	if(!$error_academic_publication)
	{
		$o_publication = new OtherPublication();
		$error_other_publication = false;
		
		for($j = 1; $j <= $_POST['num_of_o_pub_rows']; $j++) {
			if(isset($_POST['other_publications_id_'.$j]))
			{
				$o_publication->publication_id = $_POST['other_publications_id_'.$j];
			}
			$o_pub_title_key = 'other_publications_title_'.$j;
			$o_pub_publisher_key = 'other_publications_publisher_'.$j;
			
			$o_publication->title_of_publication = $_POST[$o_pub_title_key];
			$o_publication->publisher = $_POST[$o_pub_publisher_key];
			$o_publication->applicant_id = $session->applicant_id;

			if($o_publication->title_of_publication == '')
			{
				continue;
			}
			
			if(!$o_publication->save())
			{
				$error_other_publication = true;
			}
			unset($o_publication->publication_id);
		}
			if(!$error_other_publication)
			{
				$user = new User();
				$user->applicant_id = $session->applicant_id;
				$user->updateProgress('E');
				sleep(2);
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "You have successfully saved your publication details\n";
				echo "Continue";
			} 
			else
			{
				sleep(2);
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Your publication details were not saved";
			}
	}
	else
	{
		sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "Your publication details were not save";
	}
?>