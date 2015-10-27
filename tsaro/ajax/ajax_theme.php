<?php
	require_once('../../inc/initialize.php');
	
	if($_FILES['logo_name']['size'] < $_POST['MAX_FILE_SIZE'])
	{
		$theme = new Theme();
		
		$theme->institution_name 				= $_POST['institution_name'];
		$theme->institution_caption 			= $_POST['institution_caption'];
		$theme->institution_text_color 			= $_POST['institution_text_color'];
		$theme->institution_caption_text_color 	= $_POST['institution_caption_text_color'];
		$theme->header_bg_color 				= $_POST['header_bg_color'];
		
		$filename 								= str_replace(' ', '.', $theme->institution_name);
		$extention 								= explode('.', $_FILES['logo_name']['name']);
		$extention 								= "." . $extention[sizeof($extention) - 1];
		$theme->logo_caption 					= $_POST['logo_caption'];
		$theme->site_url 						= $_POST['site_url'];
		$theme->status 							= $_POST['status'];
		$theme->visible 						= $_POST['visible'];

		$target_path = SITE_ROOT .DS. "images" .DS. $filename . $extention;
		
		move_uploaded_file($_FILES['logo_name']['tmp_name'], $target_path);
		$theme->logo_name = $filename . $extention;
		
		if(isset($_POST['theme_id']) && !empty($_POST['theme_id'])){
			$theme->theme_id = $_POST['theme_id'];
		} else {
			$theme_exist_query = "SELECT * from themes WHERE institution_name = '".$_POST['institution_name']."' OR logo_name = '".$target_path."'";
		
			$theme_exist = theme::find_by_sql($theme_exist_query);
			$theme_exist = array_shift($theme_exist);
			
			if($theme_exist) {
				$theme->theme_id = $theme_exist->theme_id;
			}
		}
		
		if($theme->save()) {

			sleep(2);
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo 'The Theme Settings have being save successfully.';
			echo '<hr>';
			
		} else {
			
			sleep(2);
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo 'An error occured while saving theme information.';
			echo '<hr>';
		}
	} else {
		sleep(2);
		echo '<h4 class="alert alert-error">Error</h4>';
		echo '<hr>';
		echo 'Maxium Image size exceeded. Please upload an Image with file size less than '. $_POST['MAX_FILE_SIZE'];
		echo '<hr>';
	}
?>