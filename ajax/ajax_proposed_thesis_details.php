<?php
	require_once('../inc/initialize.php');

	$thesis = new Thesis();
	
	if($_FILES['attach_thesis_proposal']['error'] == 2)
	{
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo 'Your thesis attachment is bigger than the maximum file size of 2MB';
		die();
	}
	
	$thesis->comment_on_field = $_POST['proposed_field_brief'];
	
	$thesis->applicant_id = $session->applicant_id;
	
	$thesis->thesis_topic = $_POST['proposed_thesis_topic'];
	
	$thesis->proposal_on_thesis = $_POST['thesis_proposal'];
	
	$initiafilename = $_FILES['attach_thesis_proposal']['name'];
	
	$thesis_details = $thesis->find_by_id($session->applicant_id);
	
	if(!empty($thesis_details))
	{
		$thesis->thesis_id = $thesis_details->thesis_id;
	}
	
	if($thesis->save())
	{
		if(!empty($_FILES['attach_thesis_proposal']))
		{
			$files = new Files();
		
			//$file_details = $files->find_by_id($session->applicant_id);
			
			/*find file record for proposed thesis*/
			$sql_thesis_upload_file = "SELECT * FROM files WHERE applicant_id=" . $session->applicant_id .  " AND caption='Thesis Proposal'";
			$result_thesis_upload_file = Files::find_by_sql($sql_thesis_upload_file);
			
			foreach($result_thesis_upload_file as $row):
				$thesis_file_id = $row->file_id;
				$thesis_filename = $row->filename;
			endforeach;

			
			$files->upload_dir = "documents".DS."thesis";

			if(!empty($thesis_file_id) && !empty($_FILES['attach_thesis_proposal']['name']))
			{
				$files->file_id = $thesis_file_id;
		
				unlink(SITE_ROOT.DS."documents".DS."thesis".DS.$thesis_filename);
			}
	
			$arrayfiledetails = explode('.', $_FILES['attach_thesis_proposal']['name']);
		
			$extension = $arrayfiledetails[sizeof($arrayfiledetails)-1];
		
			$_FILES['attach_thesis_proposal']['name'] = $session->applicant_id.'-thesis.'.$extension;
			
			if($files->attach_file($_FILES['attach_thesis_proposal']))
			{
				
				$files->caption = 'Thesis Proposal';
				$files->applicant_id = $session->applicant_id;
				
				if($files->save())
				{
					$fileuploadmessage = 1;
				}else{
					$fileuploadmessage = 'Thesis not uploaded';
				}
			}
			else {
					$fileuploadmessage = 'You attached an incorrect file, please ensure that the file is in doc or pdf format';
				}
		}
		
		
		$user = new User();
		$user->applicant_id = $session->applicant_id;
		$user->updateProgress('D');
		
		sleep(2);
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo 'Your thesis details have been saved';
			echo '<hr>';
			if($fileuploadmessage != 1)
			{
				echo $fileuploadmessage;
			}
	}
	else
	{
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo 'Your thesis details were not saved';
	}

?>