<?php
	require_once('../inc/initialize.php');
	
	$sqlemail = User::find_by_sql("SELECT email FROM personal_details WHERE applicant_id=".$session->applicant_id);
	
	$sqlemail = array_shift($sqlemail);
	$applicant_email = $sqlemail->email;
	
	$error = false;
	$ref_ids = '';
	
	$referee = new Referees();
	
	$error = '';
		
	$i=1;

	while($i <= 3) {
		if(isset($_POST['referees_id_'.$i]) && !empty($_POST['referees_id_'.$i]))
		{
			$referee->referees_id = $_POST['referees_id_'.$i];
		}
		$referee->referee_title_id = $_POST['reference_title_id_'.$i];
		$referee->referee_name = $_POST['referees_name_'.$i];
		$referee->referee_email = $_POST['referees_email_'.$i];
		
		if($referee->referee_email == $applicant_email){
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo "The referee email must be different from the applicant's email\n";
			echo '<hr>';
			echo "The referee with the email ".$applicant_email." was therefore not saved\n";
			die();
		}
		$referee->referee_phone_number = $_POST['referees_phone_number_'.$i];
		
		
		$referee->applicant_id = $session->applicant_id;
		
		$r_id = $referee->save();
		if(!$r_id)
		{
			$error = true;
		}
		else
		{
			if($i == 3)
			{
				$ref_ids .= $r_id.';';
			} 
			else
			{
				$ref_ids .= $r_id.':';
			}
			
		}
		
		/*if(!$referee->sendRefereeMail())
		{
			$error .= 'Mail not sent to '.$referee->referee_email;
			
		}*/
		
		$i++;
	}
	
	if(!$error)
	{
		echo $ref_ids;
		$user = new User();
		$user->applicant_id = $session->applicant_id;
		$user->updateProgress('F');
		sleep(2);
		echo '<h4 class="alert alert-success">Success</h4>';
		echo '<hr>';
		echo "You have successfully saved your referee details<br>";
		echo "<hr>";
	}
	else
	{
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Your referee details were not saved<br>";
		echo "<hr>";
	}
?>
