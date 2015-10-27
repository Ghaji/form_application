<?php
	require_once('../../inc/initialize.php');
	
	// print_r($_FILES);
	// echo '<br>';
	// print_r($_POST);
	// die();
	
	
	
	if($_FILES['signature']['error'] == 2)
	{
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo "Maximum File size Exceeded(250Kb)";
		die();
	}
	
	

$current_time = date('Y-m-d H:i:s', time());

if (isset($_POST["btn"])) {
	switch ($_POST["btn"]) {
		case 'add_registra':
			$registra = new Registra();

			$active_registra = $registra->find_by_sql("SELECT * FROM `registras` WHERE visible = 1");
			$active_registra = array_shift($active_registra);

			if(!empty($active_registra)) {
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "You cannot insert into registras table unless you deactivate one or more active registra(s).";
				echo '<hr>';
			} else {
				$arrayfiledetails = explode('.', $_FILES['signature']['name']);
				
				$extension = $arrayfiledetails[sizeof($arrayfiledetails)-1];
				
				$_FILES['signature']['name'] = strtolower(
												str_replace(" ", "_", $_POST['full_name'])
												).'_signature.'.$extension;
				
				if($registra->attach_file($_FILES['signature']))
				{			
					$registra->full_name = $_POST['full_name'];
					$registra->year = $_POST['year'];
					$registra->visible = $_POST['visible'];
					$registra->created_at = $current_time;
					$registra->updated_at = $current_time;

					if($registra->save()){
						echo '<h4 class="alert alert-success">Success</h4>';
						echo '<hr>';
						echo "<p>You have successfully added a new record into registras table</p>";
						echo '<hr>';
					}else{
						echo '<h4 class="alert alert-error">Error</h4>';
						echo '<hr>';
						echo "Failed to insert into registras table.";
						echo '<hr>';
					}
				}
			}
			break;
		case 'update_registra':
			$registra = new Registra();
			$id = customDecrypt($_POST['rid']);
			$registra_details = $registra->find_by_id($id);
			
			$registra->id = $registra_details->id;

			if(!empty($registra_details) && !empty($_FILES['signature']['name']))
			{
				$registra->id = $registra_details->id;

				unlink(SITE_ROOT.DS.'registra_signatures'.DS.$registra_details->signature_image);
			}

			$active_registra = $registra->find_by_sql("SELECT * FROM `registras` WHERE visible = 1 AND id != ".$registra->id);

			if(!empty($active_registra)) {
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "You cannot insert into registras table unless you deactivate one or more active registra(s).";
				echo '<hr>';
			} else {
				$arrayfiledetails = explode('.', $_FILES['signature']['name']);
				
				$extension = $arrayfiledetails[sizeof($arrayfiledetails)-1];
				
				$_FILES['signature']['name'] = strtolower(
												str_replace(" ", "_", $_POST['full_name'])
												).'_signature.'.$extension;

				
				if($registra->attach_file($_FILES['signature']))
				{	
					$registra->full_name = $_POST['full_name'];
					$registra->year = $_POST['year'];
					$registra->visible = $_POST['visible'];
					$registra->created_at = $registra_details->created_at;
					$registra->updated_at = $current_time;

					if($registra->save()){
						echo '<h4 class="alert alert-success">Success</h4>';
						echo '<hr>';
						echo "<p>You have successfully added a new record into registras table</p>";
						echo '<hr>';
					}else{
						echo '<h4 class="alert alert-error">Error</h4>';
						echo '<hr>';
						echo "Failed to insert into registras table.";
						echo '<hr>';
					}
				} else {
					echo "file not attached";
					print_r($_FILES);
				}
			}
			break;
		case 'del_registra':
			$registra = new Registra();
			$id = customDecrypt($_POST['rid']);
			$registra_details = $registra->find_by_id($id);
			
			$registra->id = $registra_details->id;

			if(!empty($registra_details) && !empty($_FILES['signature']['name']))
			{
				$registra->id = $registra_details->id;

				unlink(SITE_ROOT.DS.'registra_signatures'.DS.$registra_details->signature_image);
			}

			if($registra->delete()){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "<p>You have successfully deleted a registra record from registras table</p>";
				echo '<hr>';
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Failed to deleted a registra record from registras table.";
				echo '<hr>';
			}
			break;
		
	}
}
?>