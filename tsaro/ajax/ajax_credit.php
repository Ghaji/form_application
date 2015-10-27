<?php
	require_once('../../inc/initialize.php');
	
	if($_FILES['picture']['size'] < $_POST['MAX_FILE_SIZE'])
	{
		$credit = new Credit();
		
		$credit->fullname = $_POST['fullname'];
		$credit->email = $_POST['email'];
		$credit->phone = $_POST['phone'];
		$credit->role = $_POST['role'];
		$filename = str_replace(' ', '.', $credit->fullname);
		$extention = explode('.', $_FILES['picture']['name']);
		$extention = "." . $extention[sizeof($extention) - 1];
		$credit->aboutyou = $_POST['aboutyou'];
		$credit->status = $_POST['status'];

		$target_path = SITE_ROOT .DS. "documents" .DS. "credit_passports" .DS. $filename . $extention;
		
		move_uploaded_file($_FILES['picture']['tmp_name'], $target_path);
		$credit->passport = $filename . $extention;
		
		if(isset($_POST['credit_id']) && !empty($_POST['credit_id'])){
			$credit->credit_id = $_POST['credit_id'];
		} else {
			$credit_exist_query = "SELECT * from credits WHERE email = '".$_POST['email']."' OR fullname = '".$_POST['fullname']."' OR passport = '".$target_path."'";
		
			$credit_exist = Credit::find_by_sql($credit_exist_query);
			$credit_exist = array_shift($credit_exist);
			
			if($credit_exist) {
				$credit->credit_id = $credit_exist->credit_id;
			}
		}
		
		if($credit->save()) {

			sleep(2);
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo 'Developers Role information has been successfully saved.';
			echo '<hr>';
			
		} else {
			
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo 'An error occured while saving credit information.';
			echo '<hr>';
		}
	} else {
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo 'Maxium passport size exceeded. Please upload a passport with file size less than '. $_POST['MAX_FILE_SIZE'];
		echo '<hr>';
	}
?>