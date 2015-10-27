<?php
	require_once('../inc/initialize.php');

	$document_upload_msg = 0;
	$empty_file_msg = 0;
	$counter = 1;
	$max = 5;
	$upload_dir = "documents".DS."files";
	foreach($_FILES as $key => $value){
		if(!empty($value) && $value["size"] != 0) {
			$sql = "SELECT * FROM files WHERE applicant_id=" . $session->applicant_id .  " AND caption='Document ".$counter."'";
			$result = Files::find_by_sql($sql);
			$result = array_shift($result);
			
			$document = new Files();
			$document->upload_dir = $upload_dir;
			
			if(!empty($result->file_id) && !empty($value['name'])) {
				$document->file_id = $result->file_id;
				unlink(SITE_ROOT.DS.$document->upload_dir.DS.$result->filename);
			}
			
			$filedetails = explode('.', $value['name']);
			$extension = $filedetails[sizeof($filedetails)-1];
			$value['name'] = $session->applicant_id.'-Document-'.$counter.'.'.$extension;
			
			if($document->attach_file($value)) {
				$document->caption = 'Document '.$counter;
				$document->applicant_id = $session->applicant_id;
				
				if($document->save()) {
					$document_upload_msg = 1;
				}
			} else {
				sleep(2);
				echo "<table>";
				echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
				echo '<hr>';
				echo "<tr><td>You attached an incorrect file, please ensure that the document you are uploading is in pdf format.<br>Also ensure that each file is not more than 2MB</td></tr>";
				echo "</table>";
			}
		} else {
			$empty_file_msg += $counter;
		}
		$counter++;
	}
	
	/*Remove unwanted files*/
	$r_counter = $counter;
	$db = new MySQLDatabase();
	while($r_counter < $max){
		$filename = SITE_ROOT.DS.$upload_dir.DS.$session->applicant_id.'-Document-'.$r_counter.'.pdf';
		if(file_exists($filename)) {
			$sql = "DELETE FROM `files` WHERE applicant_id=" . $session->applicant_id .  " AND caption='Document ".$counter."'";
			$db->query($sql);
			unlink($filename);
		}
		$r_counter++;
	}

	/*User Feedback*/
	echo "<table>";
	if($empty_file_msg > 0){
		echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
		echo '<hr>';
		echo "<tr><td>You cannot upload an empty file.<br>Please ensure that you are not uploading any empty file and that you do not save the details of this page without choosing one or more file(s).</td></tr>";
	} else if($empty_file_msg == 0) {
		$user = new User();
		$user->applicant_id = $session->applicant_id;
		$user->updateProgress('H');
		echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
		echo '<hr>';
		echo "<tr><td>You have successfully saved your certificate and transcript.</td></tr>";
	}
	echo "</table>";
?>