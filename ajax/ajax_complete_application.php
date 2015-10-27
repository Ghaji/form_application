<?php
	require_once('../inc/initialize.php');
	$database = new MySQLDatabase();
	$session_sql = $database->query("SELECT session FROM application_status WHERE id=1");
	$session_sql = $database->fetch_array($session_sql);
	$greeting = greeting();
	
	$user = new User();
	
	$user_details = $user->find_by_id($session->applicant_id);
	
	$progress = $user_details->progress;
	$student_status = $user_details->student_status;
	$surname 		= $user_details->surname;
	$firstname 		= $user_details->first_name;
	
	$message = 'You have not filled the following tab(s): <br>';
	
	if($student_status == 'PGA')
	{
		if($progress == "Completed"){
				
			sleep(2);
			echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success </h4>';
			echo '<hr>';
			echo $greeting .', <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;"> '. ucfirst($surname . ' ' . $firstname) . '</span>.<br>';
			echo 'You have successfully completed your application form, Please use the button below to view your application details.';
			echo '<br><br>';
			echo '<a href="confirmation.php" class="btn btn-info">View Your Details</a>';
			echo '<hr>';
				
		}
		else{
			$tab_filled = str_split($progress);
			
			$compulsory_tabs = array('Personal Details'=>'A', 'Academic Qualification'=>'B', 'Referee'=>'F', 'Passport'=>'G');
			 
			$size = sizeof($compulsory_tabs);
			
			$empty_tab_flag = false;

			foreach($compulsory_tabs as $key=>$value)
			{
				if(!in_array($value, $tab_filled)){
	$message .= '<span style=" font-weight: bold; text-shadow: 1px 1px 4px Red">'.$key . '</span><br>';
					$empty_tab_flag = true;
				}
			}
			
			if($empty_tab_flag){
				echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
				echo '<hr>';
				echo $message;
				echo '<br><hr>';
				echo '<a href="application_form.php" class="btn">Close</a>';
			}
			else
			{
				$user->progress = 'Completed';
				$user->db_fields = array('progress');
				$user->applicant_id = $session->applicant_id;
				$referees = new Referees();
				$referees_details = $referees->find_by_sql("SELECT * FROM referees WHERE applicant_id='".$session->applicant_id."'");
				$mail_error = '';
				$applicant_name = User::find_by_sql("SELECT * FROM personal_details WHERE applicant_id=".$session->applicant_id);
				$applicant_name = array_shift($applicant_name);
				$applicant_name = $applicant_name->surname.' '.$applicant_name->first_name.' '.$applicant_name->middle_name;

				foreach($referees_details as $referee_info)
				{
					$referees->referee_email = $referee_info->referee_email;
					$referees->referee_name = $referee_info->referee_name;
					$referees->referees_id = $referee_info->referees_id;
					if(!$referees->sendRefereeMail($applicant_name))
					{
						$mail_error .= "Mail not sent to ".$referees->referee_email."<br>";
					}
				}

				if($user->save())
				{
					$admissions = new Admission();
					
					$sql_adm = "select admission_id from admission_status where applicant_id='".$session->applicant_id."'";
					$res_adm = Admission::find_by_sql($sql_adm);
					
					if(empty($res_adm)){
						
						$academic_session = $session_sql['session'];
						$admissions->applicant_id = $session->applicant_id;
						$admissions->time_completed_application = time();
						$admissions->academic_session = $academic_session;
						$admissions->status = 1;
						
						$admissions->save();
						
					}	
					
					echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
					echo '<hr>';
					echo $greeting .', <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;"> '. ucfirst($surname . ' ' . $firstname) . '</span>.<br>';
					echo 'You have successfully completed your application form, Please use the button below to view your application details.';
					if($mail_error != '')
					{
						echo $mail_error;
					}
					echo '<br><br>';
					echo '<a href="confirmation.php" class="btn btn-info">View Your Details</a>';
					echo '<hr>';
				}
			}
		}
	}
	else
	{
		if($progress == "Completed"){
				
				echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success </h4>';
				echo '<hr>';
				echo $greeting .', <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;">'. ucfirst($surname . ' ' . $firstname) . '</span>.<br>';
				echo 'You have successfully completed your application form, Please use the button below to view your application details.';
				echo '<br><br>';
				echo '<a href="confirmation.php" class="btn btn-info">View Your Details</a>';
				echo '<hr>';
				
		}
		else{
			$tab_filled = str_split($progress);
			
			$compulsory_tabs = array('Personal Details'=>'A', 'Academic Qualification'=>'B', 'Other Programme Details'=>'I', 'Passport'=>'G');
			
			$size = sizeof($compulsory_tabs);
			
			$empty_tab_flag = false;
			
			foreach($compulsory_tabs as $key=>$value)
			{
				if(!in_array($value, $tab_filled)){
	$message .= '<span style=" font-weight: bold; text-shadow: 1px 1px 4px Red">'.$key . '</span><br>';
					$empty_tab_flag = true;
					break;
					
				}
			}
			
			if($empty_tab_flag){
				echo '<h4 class="alert alert-error"><i class="iconic-o-x" style="color: red"></i> Error!</h4>';
				echo '<hr>';
				echo $message;
				echo '<hr>';
				echo '<a href="application_form.php" class="btn">Close</a>';
			}else{
				$user->progress = 'Completed';
				$user->db_fields = array('progress');
				$user->applicant_id = $session->applicant_id;
				
				//Send confirmation mail
				$user->registrationConfirmationMail();
				
				if($user->save())
				{
					$admissions = new Admission();	
					$academic_session = $session_sql['session'];
					$admissions->applicant_id = $session->applicant_id;
					$admissions->time_completed_application = time();
					$admissions->academic_session = $academic_session;
					$admissions->status = 1;
					$admissions->save();	

					echo '<h4 class="alert alert-success"><i class="iconic-o-check" style="color: #51A351"></i> Success</h4>';
					echo '<hr>';
					echo 'You have successfully completed your application form <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;">' . ucfirst($surname . ' ' . $firstname . '</span>');
					echo '<br><br>';
					echo '<a href="confirmation.php" class="btn btn-info">View Your Details</a>';
					echo '<hr>';
				}
			}
		}
	}
?>